<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DailyTimeRecordImport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DailyTimeRecordController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls'
        // ]);
         $file = $request->file('file');

         if($file == null)
         {
            return back()->with('error', 'Daily time records imported failed! File is invalid');    
         }


         $extension = $file->getClientOriginalExtension();
        
         if($extension != "xls" && $extension != "xlsx")
         {
            return back()->with('error', 'Daily time records imported failed! File is invalid');    
         }

        // Import the file using the custom import class
        Excel::import(new DailyTimeRecordImport, $request->file('file'));

        return back()->with('success', 'Daily time records imported successfully!');
    }
    public function index()
    {
        //$data = DailyTimeRecord::orderBy('created_at', 'desc')->get();

        // $data = DB::table('Daily_Time_Records')
        //         ->leftJoin('employees', 'Daily_Time_Records.employee_code', '=', 'employees.employeenumber')
        //         ->select('Daily_Time_Records.*', 'employees.*')
        //         ->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $currentMonthName = Carbon::now()->format('F');
        $ProcessStatus = "Not Process yet"; 
        $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        
        if(isset($cutOFF))
        {
            $this->createcufoff();
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }

        $data = DB::select($this->DTRQuery(''));

        // if($RawAttendanceData->count() == 0)
        // {
        //     $data = $RawAttendanceData;
        // }else{
        // $data = $RawAttendanceData->toQuery()->paginate(10);
        // }00
        //dd(count($RawAttendanceData));

        return view('attendance.raw.index',compact('data','cutOFF','ProcessStatus'));
    }

    public function edit($id)
    {
        //
        $data = DailyTimeRecord::where('id',decrypt($id))->first();
        return view('attendance.raw.edit',compact('data'));
    }

    public function getCutoffData($monthnum)
    {
        $monthName = Carbon::create()->month($monthnum)->format('F');
    
         $data = DB::select(
                        "
                        SELECT [id]
                            ,[Month]
                            ,[StartDate]
                            ,[EndDate]
                        FROM [cutoff]
                        where [Month] = '". $monthName ."';
                        "
                    );
        return response()->json($data);
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
            $this->createcufoff();
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }
        
       

        if($cutoffData[0] != null)
        {
            $criteria = "where
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'
                        and dtr.employee_code = ". $request->employeecode ."";
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::select($this->DTRQuery($criteria));
        }
        return view('attendance.raw.index',compact('data','cutOFF','ProcessStatus'));
    }
    private function DTRQuery($criteria)
    {
        return "
            select dtr.id,dtr.employee_code,concat(emp.lastname,',',emp.firstname, ' ' , Left(emp.middlename,1)) as Employee,dtr.date,LEFT(Datename(WEEKDAY,dtr.date),3) as 'Day',
                        (Case when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 then 'WD'
                                when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) = 1 then 'RD' 
                                else '' end)as RestDay,
                        convert(varchar, dtr.in_1, 108) as 'TimeIN',convert(varchar, dtr.in_2, 108) as 'TimeIN_2',convert(varchar, dtr.in_3, 108) as 'TimeIN_3',
                        convert(varchar, dtr.out_1, 108) as 'TimeOUT',convert(varchar, dtr.out_2, 108) as 'TimeOUT_2',convert(varchar, dtr.out_3, 108) as 'TimeOUT_3',
                        convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108) as 'Final_IN',
                        convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108) as 'Final_OUT',
                        (case when dws.GracePeriodMins > 0 then 
                            convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) else convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108) end) as 'StartTime',
                            convert(varchar,dws.EndTime,108) as 'EndTime',
                                (case when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108) and
                                convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108) >= convert(varchar,dws.EndTime,108)
                                then 8 
                                when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108) and
                                convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108) >= convert(varchar,dws.EndTime,108)
                                then 
                                    DATEDIFF(HOUR,convert(varchar,dws.EndTime,108),convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108))
                        when dws.GracePeriodMins = 0 or dws.GracePeriodMins is NULL then
                            Case when convert(varchar,dws.EndTime,108) <=  convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108) then
                                DATEDIFF(minute,dws.EndTime, CAST(COALESCE(dtr.in_1,dtr.in_2,dtr.in_3) as DATETIME)) / 60 * -1
                            when convert(varchar,dws.EndTime,108) > convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108) then
                                DATEDIFF(minute,convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108), CAST(COALESCE(dtr.in_1,dtr.in_2,dtr.in_3) as DATETIME)) / 60.0 * -1
                            end
                        end) as 'WorkingHours',
                        0 as 'NDHours',
                        0 as 'ND8Hours',
                        0 as 'OTHours',
                        0 as 'OT8Hours',
                        case when (ISNULL(convert(varchar,COALESCE(dtr.in_1,dtr.in_2,dtr.in_3),108),'') = '' or 
								  ISNULL(convert(varchar,COALESCE(dtr.out_1,dtr.out_2,dtr.out_3),108),'') = '') and 
								  (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 then
                        8 else 0 end as 'Absent',
                        0 as 'Late',
                        0 as 'Undertime'
                        from daily_time_records dtr left join
                        employees emp on dtr.employee_code = emp.employeenumber
                        left join defaultworkschedule dws on emp.WorkDays = dws.id
            " . $criteria;
    }
    public function getEmployeeDTRData($empnum)
    {
        $cutoffData = Cutoff::where('id',$empnum)->get();

        if($cutoffData[0] != null)
        {
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::table('daily_time_records')
            ->LeftJoin('employees','daily_time_records.employee_code','=','employees.employeenumber')
            ->select('daily_time_records.employee_code')
            ->whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            ->distinct()
            ->get();
        }

        return response()->json($data);
    }
    public function createcufoff()
    {
        $currentMonthName = Carbon::now()->format('F');
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $firstCutoff = $firstDayOfMonth->addDays(14);
        
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

        Cutoff::updateOrCreate(
            [
                'CutoffKey'=>$currentMonthName . "-" . $secondCOStartDay->format('Y-d-m'),
                'Month'=>$currentMonthName,
                'StartDate'=>$secondCOStartDay,
                'EndDate'=>$lastDayOfMonth,
            ],
        );

    }
}