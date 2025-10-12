<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $now = Carbon::now()->format('F');
        $defaultCutoff = Cutoff::where('Month','=',$now)->where('status','=','OPEN')->get();
        $data = DB::select($this->SummaryPayslipQuery(''));
        if($defaultCutoff->count() > 0)
        {
            $data = DB::select($this->SummaryPayslipQuery("and    cu.Month = '" . $defaultCutoff[0]->Month . "'"));
        }else
        {
            $data = DB::select($this->SummaryPayslipQuery("and    cu.status = 'OPEN'"));
        }
        return view('payroll.payslip.index',compact('defaultCutoff','data'));
    }
    public function SummaryPayslipQuery($criteria)
    {
        return "select 
                p.id,
                p.EmployeeCode,
                e.lastname + ',' + e.firstname + ' ' + e.middlename as 'EmployeeName'
                from payroll p 
                left join employees e on e.employeenumber = p.EmployeeCode 
                left join cutoff cu on cu.id = p.Cutoff_id
                where p.Status = 'Approved' " . $criteria;
    }
    public function getpaysliplist(Request $request)
    {
        $cutoffData = Cutoff::where('id',$request->cutoff)->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $currentMonthName = Carbon::now()->format('F');

        $cutOFF = CutOff::where('Month','=',$currentMonthName)->get();
        
        $ProcessStatus = "Not Process";

        if(isset($cutOFF))
        {
            $this->createcufoff('');
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }

        if($cutoffData[0] != null)
        {
            // if($request->employeecode != "")
            // {
            //     $criteria = "and
            //             dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'".
            //             "and dtr.employee_code = '" . $request->employeecode. "'";
            // }else
            // {
            //     $criteria = "and
            //             dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'";
            // }
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $criteria = '';
            
            $data = DB::select($this->SummaryPayslipQuery($criteria));
        }
        return view('payroll.payslip.index',compact('data','cutOFF','ProcessStatus'));
    }
    public function createcufoff($monthName)
    {
        try{
            $currentMonthName = Carbon::now()->format('F');
            $firstDayOfMonth = Carbon::now()->startOfMonth();
            $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
            $firstCutoff = $firstDayOfMonth->addDays(14);
            
            if($monthName != '')
            {
                $currentMonthName = $monthName;
                $firstDayOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->firstOfMonth();
                $startOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->startOfMonth()->toDateTimeString();
                $firstCutoff = $firstDayOfMonth->addDays(14);
            }

            Cutoff::updateOrCreate(
                [
                    'CutoffKey'=>$currentMonthName . "-" . $firstDayOfMonth->format('Y-d-m'),
                    'Month'=>$currentMonthName,
                    'StartDate'=>$startOfMonth,
                    'EndDate'=>$firstCutoff,
                ],
            );
            $secondCOStartDay = $firstCutoff->addDays(1);
            $lastDayOfMonth = Carbon::now()->lastOfMonth();

            if($monthName != '')
            {
                $secondCOStartDay = $firstCutoff;
                $lastDayOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->lastOfMonth();
            }

            Cutoff::updateOrCreate(
                [
                    'CutoffKey'=>$currentMonthName . "-" . $secondCOStartDay->format('Y-d-m'),
                    'Month'=>$currentMonthName,
                    'StartDate'=>$secondCOStartDay,
                    'EndDate'=>$lastDayOfMonth,
                ],
            );
        }catch(Exception $e)
        {
            return back()->with('error', 'Cut-off creation failed! '. $e->getMessage());
        }
    }
    public function getemployeesummary($cutoff,$empcode)
    {
        $cutoffData = Cutoff::where('id',$cutoff)->get();
        $cutoffDataSelected = "";
        if($cutoffData->count() > 0)
        {
            $cutoffDataSelected = $cutoffData[0]->StartDate ." to " . $cutoffData[0]->EndDate;
        }
        $PayrollQuery = $this->payrollQuery($cutoff,$empcode);
            
        $data = DB::select($PayrollQuery); 

        return view('payroll.summary.view',compact('data','cutoffDataSelected','cutoff'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $payrollKey = $request->empcode.'_'.$request->cutoffid;

        $payroll = Payroll::updateOrCreate([
            'PayrollKey' =>$payrollKey,],[
            'EmployeeCode'=>$request->empcode,
            'Cutoff_id'=>$request->cutoffid,
            'PreparedDate' => Carbon::now()->timezone('Asia/Manila'),
            'PreparedBy'=>Auth::id(),
        ]);

        return redirect()->back()->with('success','Payroll created successfully. [Awaiting for approval]');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Payroll::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Payroll deleted successfully.');
    }
    public function approve(Request $request,$id)
    {
        $payroll = Payroll::find(decrypt($id));
        $payroll->status = "Approved";
        $payroll->ApprovedBy =$request->user()->id;
        $payroll->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $payroll->save();

        return redirect()->back()->with('success','Payroll Approved successfully.');
    }
    public function decline(Request $request,$id)
    {
        $payroll = Payroll::find(decrypt($id));
        $payroll->status = "Declined";
        $payroll->ApprovedBy =$request->user()->id;
        $payroll->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $payroll->save();

        return redirect()->back()->with('success','Payroll Declined successfully.');
    }
}
