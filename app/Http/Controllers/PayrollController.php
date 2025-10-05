<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $now = Carbon::now()->format('F');
        $defaultCutoff = Cutoff::where('Month','=',$now)->where('status','=','OPEN')->get();
        $data = DB::select($this->SummaryPayrollQuery(''));
        if($defaultCutoff->count() > 0)
        {
            $data = DB::select($this->SummaryPayrollQuery("and    cu.Month = '" . $defaultCutoff[0]->Month . "'"));
        }else
        {
            $data = DB::select($this->SummaryPayrollQuery("and    cu.status = 'OPEN'"));
        }
        return view('payroll.summary.index',compact('defaultCutoff','data'));
    }
    public function getemployeelist(Request $request)
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
            if($request->employeecode != "")
            {
                $criteria = "and
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'".
                        "and dtr.employee_code = '" . $request->employeecode. "'";
            }else
            {
                $criteria = "and
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'";
            }
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::select($this->SummaryPayrollQuery($criteria));
        }
        return view('payroll.summary.index',compact('data','cutOFF','ProcessStatus'));
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
        $PayrollQuery = 
            "Select
                cu.Month,
                cu.id as 'cutoffid',
                cu.StartDate,cu.EndDate,
                dtr.employee_code as 'Employee_Code',
                CAST((s.WorkHours / 8) as DECIMAL(9,2)) as 'WorkingDays',
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                emp.DailyRate,
                CAST(s.WorkHours * ( emp.DailyRate  / 8) as DECIMAL(9,2)) as 'BasicPay',
                (s.Absent / 8) as 'Absent',
                CAST((s.Absent / 8 ) * emp.DailyRate as DECIMAL(9,2)) as 'AbsentPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'REGOT')),0) as 'RegularOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'REGOT')),0) as 'RegularOTPay',
                0 as 'HalfdayHrs',
				0.00 as 'HalfdayPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RDOT')),0) as 'SundayOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RDOT')),0) as 'SundayOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHOLOT')),0) as 'LegalOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHOLOT')),0) as 'LegalOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SNWHOLOT')),0) as 'SplNWOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SNWHOLOT')),0) as 'SplNWOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SHRDOT')),0) as 'SplRDOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SHRDOT')),0) as 'SplRDOTPay',
                 isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHRDOT')),0) as 'LGRDOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHRDOT')),0) as 'LGRDOTPay',
                0 as 'ExceedingHrs',
                0.00 as 'ExceedingHrsPay',
                0 as 'LateHrs',
                0.00 as 'LatePay',
                0.00 as 'HalfdayPay',

                CAST(s.WorkHours * ( emp.DailyRate  / 8) as DECIMAL(9,2))
                as 'TotalEarnings',
                isnull(d.Amount,0.00) as 'HDMF'
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
				left join payroll p on p.employeecode = emp.employeenumber  
				left join users u on u.id = p.PreparedBy 
                left join users a on a.id = p.ApprovedBy
                left join summary_attendance s on s.employeecode = emp.employeenumber and s.StartDateCutoff = cu.StartDate and s.EndDateCutoff = cu.EndDate
                left join autodeduction d on d.employeecode = dtr.employee_code and d.deductionname = 'HDMF' and d.AD_Date =  cu.EndDate
                where [date] between cu.StartDate and cu.EndDate
                and
				cu.id = ". $cutoff ." 
                and 
                dtr.employee_code = ". $empcode ."
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename,
                    emp.DailyRate,s.WorkHours,s.Absent,d.Amount
                order by emp.lastname desc";
        
        $data = DB::select($PayrollQuery); 

        return view('payroll.summary.view',compact('data','cutoffDataSelected'));
    }
    public function SummaryPayrollQuery($Criteria)
    {
        return "
            SELECT 
                cu.Month,
                --Concat (cu.StartDate, ' to ' ,cu.EndDate) as 'cutoffid',
                cu.id as 'cutoffid',
                cu.StartDate,cu.EndDate,
                dtr.employee_code,
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                u.name as 'PreparedBy',pay.PreparedDate,
                a.name as 'ApprovedBy',pay.ApprovedDate,
                case when pay.Status is null then 'For Processing'
                else pay.Status end as 'Status'
            FROM 
                daily_time_records dtr
            left join employees emp on dtr.employee_code = emp.employeenumber
            left join cutoff cu on dtr.cutoff = cu.id 
            left join payroll pay on pay.EmployeeCode = emp.employeenumber and pay.Cutoff_id = cu.id
            left join users u on u.id = pay.PreparedBy 
            left join users a on a.id = pay.ApprovedBy
            where 
                [date] between cu.StartDate and cu.EndDate
                " . $Criteria . "
            group by 
                cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename,
pay.Status,u.name,a.name,pay.PreparedDate,pay.ApprovedDate
            order by 
                emp.lastname desc
        ";
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
    }
}
