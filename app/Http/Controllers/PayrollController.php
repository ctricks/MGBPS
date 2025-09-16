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
        $defaultCutoff = Cutoff::where('Month','=',$now)->get();
        $data = DB::select($this->SummaryPayrollQuery(''));
        if($defaultCutoff->count() > 0)
        {
            $data = DB::select($this->SummaryPayrollQuery("and    cu.Month = '" . $defaultCutoff[0]->Month . "'"));
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
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName'
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
				left join payroll p on p.employeecode = emp.employeenumber 
				left join users u on u.id = p.PreparedBy 
                left join users a on a.id = p.ApprovedBy
                where [date] between cu.StartDate and cu.EndDate
                and
				cu.id = ". $cutoff ." 
                and 
                dtr.employee_code = ". $empcode ."
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename
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
