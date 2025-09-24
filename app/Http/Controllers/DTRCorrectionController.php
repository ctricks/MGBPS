<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\DTRCorrection;
use App\Models\DailyTimeRecord;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DTRCorrectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $criteria = "where
                    dc.date between DATEFROMPARTS(YEAR(getdate()), MONTH(getdate()), 1) and 
                    EOMONTH(DATEFROMPARTS(YEAR(getdate()), MONTH(getdate()) + 1, 1), -1)";

        $data = DB::select($this->DTRCorrrectionQuery($criteria));
        $monthfilter = 0;
        
        return view('attendance.dtrcorrection.index', compact('data','monthfilter'));
    }
    private function DTRCorrrectionQuery($criteria)
    {
        return "select 
                    dc.id,
                    empB.employeenumber,
                    empB.lastname + ',' + empB.firstname + ' ' + empB.middlename as 'Employee',
                    dc.date,
                    convert(varchar, dc.[IN], 108) as 'IN',
                    convert(varchar, dc.OUT, 108) as 'OUT',
                    dc.DType,
                    dc.Remarks,
                    dc.Status,
                    empC.name as 'CreatedBy',
                    empD.name as 'UpdatedBy',
                    empA.name as 'ApprovedBy',
                    dc.ApprovedDate,
                    dc.created_at
                from 
                    dtrcorrection dc
                left join employees empB on empB.employeenumber = dc.employeecode
                left join users empC on empC.id = dc.CreatedBy
                left join users empA on empA.id = dc.ApprovedBy
                left join users empD on empD.id = dc.UpdatedBy
            " . $criteria;
                
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employee = Employee::orderBy('lastname','ASC')->get();
        return view('attendance.dtrcorrection.create',compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            "empcode"=>'required','string','max:255',
        ]);
try {
        $Sdate = Carbon::parse($request->StartDate)->format('M d, Y');
        // $Edate = Carbon::parse($request->EndDate)->format('M d, Y');
        $startTime = $request->time_in;
        $endTime = $request->time_out;

        $result = $startTime > $endTime;

        if($result)
            return redirect()->route('attendance.dtrcorrection.edit')->with('failed','DTR Correction creation failed - Unable to save your entry. Please check Time.');
            
        $dtrcorrection = DTRCorrection::create([
            'dtrcorrectionkey' =>$request->empcode.':'.$request->StartDate,
            'employeecode'=>$request->empcode,
            'date'=>$request->StartDate,
            'IN'=>$request->time_in,
            'OUT'=>$request->time_out,
            'DType'=>'WD-COR',
            'WorkingHours'=>'-1',
            'Remarks'=>$request->description,
            'Status'=>'For Approval',
            'CreatedBy'=>Auth::id(),
        ]);

        return redirect()->route('attendance.dtrcorrection.index')->with('success','DTR Correction created successfully.');
    } catch (\Exception $e) {
        return redirect()->route('attendance.dtrcorrection.index')->with('failed',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $data = DTRCorrection::where('id',decrypt($id))->first();
         $employee = Employee::where('employeenumber',$data->employeecode)->get();
         $employeename = "";
         if($employee->count() == 1)
            $employeename = $employee[0]->lastname. ',' . $employee[0]->firstname . ' ' . $employee[0]->middlename;

        return view('attendance.dtrcorrection.edit',compact('data','employeename'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "StartDate"=>'required','date',
            "time_in"=>'required','time',
            "time_out"=>'required','time',
        ]);
        

        $dtrcor = DTRCorrection::find($request->id);
        $dtrcor->date = $request->StartDate;
        $dtrcor->Remarks = $request->description;
        $dtrcor->IN = $request->time_in;
        $dtrcor->OUT = $request->time_out;
        $dtrcor->UpdatedBy = Auth::id();
        $dtrcor->save();
        return redirect()->route('attendance.dtrcorrection.index')->with('success','DTR Correction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $dtrcor = DTRCorrection::where('id',decrypt($id))->get();
    
        DTRCorrection::where('id',decrypt($id))->delete();
        $deletedby = Auth::id();
        $TimeIn = Carbon::parse($dtrcor[0]->IN)->toTimeString();
        $TimeOut = Carbon::parse($dtrcor[0]->OUT)->toTimeString();
        $remarks = 'Deleted: ID='.$dtrcor[0]->id . ",Deleted By:" . $deletedby . ",IN=".$TimeIn.',OUT='.$TimeOut;
    
        $dtr = DailyTimeRecord::where('employee_code',$dtrcor[0]->employeecode)
                                ->where('date',$dtrcor[0]->date)
                                ->update(['reference'=>$remarks,'in_1'=>NULL,'out_1'=>NULL,'in_2'=>NULL,'out_2'=>NULL,'in_3'=>NULL,'out_3'=>NULL,
                                'WorkingHours'=>0,'Final_IN'=>NULL,'Final_OUT'=>NULL,'DType'=>'WDCOR']);

        // return redirect()->back()->with('success','DTR Correction deleted successfully.');
        $data = DB::select($this->DTRCorrrectionQuery(''));
        $monthfilter = 0;
        return view('attendance.dtrcorrection.index', compact('data','monthfilter'));
    }
    public function approve(Request $request,$id)
    {
        $dtrcor = DTRCorrection::find(decrypt($id));
        $dtrcor->status = "Approved";
        $dtrcor->ApprovedBy =$request->user()->id;
        $dtrcor->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $dtrcor->save();
        
        $dtr = DailyTimeRecord::where('employee_code',$dtrcor->employeecode)
                                ->where('date',$dtrcor->date)
                                ->update(['reference'=>'DTRCorrectionID:'.$dtrcor->id,'in_1'=>$dtrcor->IN,'out_1'=>$dtrcor->OUT,'DType'=>'WDCOR']);

        // return redirect()->back()->with('success','DTR Correction Approved successfully.');
        $data = DB::select($this->DTRCorrrectionQuery(''));
        $monthfilter = $request->monthfilter;
        return view('attendance.dtrcorrection.index', compact('data','monthfilter'));
    }
    public function decline(Request $request,$id)
    {
        $dtrcor = DTRCorrection::find(decrypt($id));
        $dtrcor->status = "Declined";
        $dtrcor->ApprovedBy =$request->user()->id;
        $dtrcor->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $dtrcor->save();
        // return redirect()->back()->with('success','DTR Correction Declined successfully.');
        $criteria = "where
                    dc.date between DATEFROMPARTS(YEAR(getdate()), ". $request->monthfilter .", 1) and 
                    EOMONTH(DATEFROMPARTS(YEAR(getdate()), ". $request->monthfilter ." + 1, 1), -1)";

        $data = DB::select($this->DTRCorrrectionQuery(''));
        $monthfilter = $request->monthfilter;
        return view('attendance.dtrcorrection.index', compact('data','monthfilter'));
    }
    public function getdtrcorrection(Request $request)
    {
        
        $criteria = "where
                    dc.date between DATEFROMPARTS(YEAR(getdate()), ". $request->monthfilter .", 1) and 
                    EOMONTH(DATEFROMPARTS(YEAR(getdate()), ". $request->monthfilter ." + 1, 1), -1)";

        $data = DB::select($this->DTRCorrrectionQuery($criteria));
        $monthfilter = $request->monthfilter;
        return view('attendance.dtrcorrection.index', compact('data','monthfilter'));
    }
    public function viewdtrcorrection($dtrnumber)
    {
        $dtrnum = decrypt($dtrnumber);
        $criteria = "where
                    dc.id = ". $dtrnum;

        $data = DB::select($this->DTRCorrrectionQuery($criteria));
        
        if($data == null)
            return redirect()->back()->with('failed','Invalid DTR Correction details');

        return view('attendance.dtrcorrection.view', compact('data'));
    }
}
