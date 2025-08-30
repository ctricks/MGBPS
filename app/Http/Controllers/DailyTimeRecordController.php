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

        $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        
        if(isset($cutOFF))
        {
            $this->createcufoff();
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }

        $data = DB::select(
            "Select 
                dtr.id,dtr.employee_code,
                concat(emp.lastname,',',emp.firstname, ' ' , Left(emp.middlename,1)) as Employee,
                dtr.date,DATENAME(WEEKDAY,dtr.date) as day,
                CONVERT(Varchar(5),dtr.in_1,108) as in_1,
                CONVERT(Varchar(5),dtr.out_1,108) as out_1,
                CONVERT(Varchar(5),dtr.in_2,108) as in_2,
                CONVERT(Varchar(5),dtr.out_2,108) as out_2,
                CONVERT(Varchar(5),dtr.in_3,108) as in_3,
                CONVERT(Varchar(5),dtr.out_3,108) as out_3
            from 
                daily_time_records dtr left join employees emp on dtr.employee_code = emp.employeenumber
            where 
                dtr.date between '". $firstDayOfMonth ."' and '" . $lastDayOfMonth ."'
                order by 
                    emp.lastname,dtr.employee_code,dtr.date desc"
        );

        // if($RawAttendanceData->count() == 0)
        // {
        //     $data = $RawAttendanceData;
        // }else{
        // $data = $RawAttendanceData->toQuery()->paginate(10);
        // }00
        //dd(count($RawAttendanceData));


        return view('attendance.raw.index',compact('data','cutOFF'));
    }
    public function getEmployeeDTRData($empnum)
    {
        $cutoffData = Cutoff::where('id',$empnum)->get();

        if($cutoffData[0] != null)
        {
            $data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            ->select('employee_code')
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