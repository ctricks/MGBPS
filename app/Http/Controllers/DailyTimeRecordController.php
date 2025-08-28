<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DailyTimeRecordImport;

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
        $RawAttendanceData = DailyTimeRecord::All();

        if($RawAttendanceData->count() == 0)
        {
            $data = $RawAttendanceData;
        }else{
        $data = $RawAttendanceData->toQuery()->paginate(10);
        }
        return view('attendance.raw.index',compact('data'));
    }
}