<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use Illuminate\Http\Request;
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
            $criteria = "and
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'
                        and dtr.employee_code = ". $request->employeecode ."";
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::select($this->SummaryAttendanceQuery($criteria));
        }
        return view('attendance.summary.index',compact('data','cutOFF','ProcessStatus'));
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
                    daily_time_records dtr
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
