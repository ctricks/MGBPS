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
                dtr.id,dtr.employee_code,concat(emp.lastname,',',emp.firstname, ' ' , Left(emp.middlename,1)) as Employee,
                dtr.date,DAYNAME(dtr.date) as day,dtr.in_1,dtr.out_1,dtr.in_2,dtr.out_2,dtr.in_3,dtr.out_3
                from daily_time_records dtr left join employees emp on dtr.employee_code = emp.employeenumber
                order by emp.lastname,dtr.employee_code,dtr.date desc;"
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