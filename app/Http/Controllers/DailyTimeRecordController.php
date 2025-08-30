<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DailyTimeRecordImport;
use Illuminate\Support\Facades\DB;

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
        return view('attendance.raw.index',compact('data'));
    }
}