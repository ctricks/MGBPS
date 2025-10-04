<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;
use App\Models\OvertimeType;
use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = DB::select("
                    select
                    o.id,
                    ot.OvertimeType,
                    ot.Description,
                    o.EmployeeCode,e.lastname + ',' + e.firstname + ' ' + e.middlename as 'EmployeeName',
                    convert(varchar,o.ActualIN,108) as 'ActualIN', convert(varchar,o.ActualOUT,108) as 'ActualOUT',o.FiledOTHours, o.OTHoursApproved,o.Remarks,o.status,
                    c.name as 'CreatedBy',o.created_at,u.name as 'ApprovedBy',o.updated_at
                    from overtime o
                    left join employees e on o.employeeCode = e.employeenumber
                    left join overtimetype ot on o.OverTimeTypeID = ot.id
                    left join users c on o.CreatedBy = c.id
                    left join users u on o.ApprovedBy = u.id
                ");
        return view('earnings.overtime.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $OvertimeType = OvertimeType::orderBy('id','ASC')->get();
        $employee = Employee::orderBy('id','DESC')->get();
        
        return view('earnings.overtime.create',compact('employee','OvertimeType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "OvertimeType"=>'required','string','max:255',
            "FiledOTHours"=>'required','double','max:50'
        ]);
        
        if($request->OvertimeType == 'Holiday OT')
        {
            $holiday = Holiday::where('date','=',$request->date)->get()->count();
            if($holiday == 0)
            {
                 return redirect()->back()->with('failed','Error: There is no Holiday on this day.');
            }
        }
     
        if($request->ActualOTHours < $request->FiledOTHours)
        {
             return redirect()->back()->with('failed','Error: Filed OT Hours excess to Actual OT Hours');
        }
        $overtimetype = Overtimetype::where('description','=',$request->OvertimeType)->first();
      
        $overtime = Overtime::create([
            'OvertimeKey'=>$request->empcode.'_'.$request->date.'_'.$overtimetype->id,
            'EmployeeCode'=>$request->empcode,
            'ActualIN'=>$request->TimeIN,
            'ActualOUT'=>$request->TimeOUT,
            'ActualOTHours'=>$request->ActualOTHours,
            'OverTimeTypeID'=>$overtimetype->id,
            'OTHoursApproved'=>0,
            'FiledOTHours'=>$request->FiledOTHours,
            'Remarks'=>'OT Filling',
            'OTDate'=>$request->date,
            'Status'=>'For Approval',
            'CreatedBy'=>Auth::id(),
        ]);

        return redirect()->route('earnings.overtime.index')->with('success','Overtime created successfully.');
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
        // $data = DB::select("select 
        //                     o.id,o.EmployeeCode,o.OTDate,o.ActualIN,o.ActualOUT,o.ActualOTHours,o.OTHoursApproved,o.FiledOTHours,
        //                     o.OverTimeTypeID,o.Status,d.Final_IN,d.Final_OUT
        //                     from overtime o
        //                     left join daily_time_records d on d.date = o.OTDate and d.employee_code = o.EmployeeCode
        //                     left join cutoff c on o.OTDate between c.StartDate and c.EndDate where o.id = " .decrypt($id));
        
        $data = Overtime::query()
    // Select the necessary columns, including aliases for the joined tables
    ->select([
        'overtime.id',
        'overtime.EmployeeCode',
        'overtime.OTDate',
        'overtime.ActualIN',
        'overtime.ActualOUT',
        'overtime.ActualOTHours',
        'overtime.OTHoursApproved',
        'overtime.FiledOTHours',
        'overtime.OverTimeTypeID',
        'overtime.Status',
        'd.Final_IN',
        'd.Final_OUT',
        'd.EndTime',
    ])
    // Join daily_time_records on two conditions
    ->leftJoin('daily_time_records as d', function ($join) {
        $join->on('d.date', '=', 'overtime.OTDate')
             ->on('d.employee_code', '=', 'overtime.EmployeeCode');
    })
    // Join cutoff using the BETWEEN logic
    ->leftJoin('cutoff as c', function ($join) {
        $join->on('overtime.OTDate', '>=', 'c.StartDate')
             ->on('overtime.OTDate', '<=', 'c.EndDate');
    })
    ->where('overtime.id',decrypt($id))
    ->first();

        $OvertimeType = OvertimeType::OrderBy('Description','ASC')->get();
        $employee = Employee::OrderBy('Lastname','ASC')->get();
        $overtimetypedesc = OvertimeType::where('id',$data->OverTimeTypeID)->first()->Description;
        
        return view('earnings.overtime.edit',compact('data','OvertimeType','employee','overtimetypedesc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $overtimetype = OvertimeType::where('Description',$request->OvertimeType)->first();
        $overtime = Overtime::find($request->id);
        $overtime->OvertimeKey  = $request->empcode.'_'.$request->date.'_'.$overtimetype->id;
        $overtime->EmployeeCode = $request->empcode;
            $overtime->ActualIN = $request->TimeIN;
            $overtime->ActualOUT= $request->TimeOUT;
            $overtime->ActualOTHours = $request->ActualOTHours;
            $overtime->OverTimeTypeID = $overtimetype->id;
            $overtime->OTHoursApproved = $request->FiledOTHours;

        $overtime->save();
        
        return redirect()->route('earnings.overtime.index')->with('Success','Overtime updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Overtime::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Overtime deleted successfully.');
    }
    public function approve(Request $request,$id)
    {
        $overtime = Overtime::find(decrypt($id));
        $overtime->status = "Approved";
        $overtime->ApprovedBy =$request->user()->id;
        $overtime->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $overtime->save();

        return redirect()->back()->with('success','Overtime Approved successfully.');
    }
    public function decline(Request $request,$id)
    {
        $overtime = Overtime::find(decrypt($id));
        $overtime->status = "Declined";
        $overtime->ApprovedBy =$request->user()->id;
        $overtime->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $overtime->save();

        return redirect()->back()->with('success','Overtime Declined successfully.');
    }
    public function getEmployeeOT(string $employeecode,string $date)
    {
         $data = DB::select("
            select 
                convert(varchar, Final_In, 108) as 'FinalIN',
                convert(varchar, Final_Out, 108) as 'FinalOUT',
                convert(varchar, EndTime, 108) as 'EndTime',
                convert(varchar,CAST(DATEDIFF(MINUTE, EndTime, Final_Out) / 60.0 AS DECIMAL(10, 2)),108) AS ActualOT
            from daily_time_records
            where date = '".$date."' and employee_code = '".$employeecode."'
         ");
        return response()->json($data);
    }
    public function getEmployeeOTByCutoff(string $cutoff,string $employeecode)
    {
        $data = DB::select("
            select 
            d.date as 'Date',
            c.StartDate,
            c.EndDate,
            convert(varchar, Final_In, 108) as 'FinalIN',
            convert(varchar, Final_Out, 108) as 'FinalOUT',
            convert(varchar, EndTime, 108) as 'EndTime',
            convert(varchar,CAST(DATEDIFF(MINUTE, EndTime, Final_Out) / 60.0 AS DECIMAL(10, 2)),108) AS ActualOT
            from daily_time_records d
            left join cutoff c on d.date between c.StartDate and c.EndDate
            where 
            CAST(DATEDIFF(MINUTE, EndTime, Final_Out) / 60.0 AS DECIMAL(10, 2)) > 0.00 and
            d.employee_code = ".$employeecode." and c.id = ".$cutoff 
            );
        return response()->json($data);
    }
}
