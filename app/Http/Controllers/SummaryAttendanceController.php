<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cutoff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SummaryAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$data = 
        //Get Current Cut-off as default display
        $now = Carbon::now()->format('F');
        $defaultCutoff = Cutoff::where('Month','=',$now)->get();
        $data = DB::select($this->SummaryAttendanceQuery(""));
        return view('attendance.summary.index',compact('defaultCutoff','data'));
    }
    public function SummaryAttendanceQuery($Criteria)
    {
        return "
            SELECT 
                cu.Month,
                cu.StartDate,cu.EndDate,
                dtr.employee_code,
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                SUM(dtr.WorkingHours) as 'WorkingHours',
                SUM(dtr.NightDiffHours) as 'NDHours',
                SUM(dtr.OTHours) as 'OTHours',
                SUM(dtr.Leaves) as 'Leaves',
                SUM(dtr.Absent) as 'Absent',
                SUM(dtr.Late) as 'Late',
                SUM(dtr.Undertime) as 'Undertime'
                FROM 
                    [PS].[dbo].[daily_time_records] dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id 
                where [date] between cu.StartDate and cu.EndDate
                " . $Criteria . "
                group by 
                    cu.Month,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename
                order by emp.lastname desc
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
