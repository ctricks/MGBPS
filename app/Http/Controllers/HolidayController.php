<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$data = Holiday::orderBy('Date','ASC')->get();
        $data = DB::select(
            "select h.id, h.year,h.HolidayName,h.Date,h.HolidayType,h.isActive,
                c.name as 'CreatedBy',h.created_at as 'CreatedDate',u.name as 'UpdatedBy',h.UpdatedDate from holiday h
                left join users c on h.CreatedBy = c.id
                left join users u on h.UpdatedBy = u.id
                where year = year(CURRENT_TIMESTAMP)"
        );

        return view('attendance.holiday.index', compact('data'));
    }
 public function import(Request $request)
    {
        $file = $request->file('file');
        // Get the file extension
        $extension = $file->getClientOriginalExtension();
   
        if($extension != 'xls')
            return back()->with('error', 'Data Imported Failed!\n'.'Invalid DTR File-invalid extension. Please check or download the template first');    

        try{

        // Get the uploaded file
        $file = $request->file('file');

        // Step 1: Extract the headers
        $headings = (new HeadingRowImport)->toArray($file);

        // Step 2: Read the entire file to check for additional rows
        $rows = Excel::toArray(null, $file);
        dd($rows);
        //Validate if the excel file is for DTR Process
        if($rows[0][0] == null || $rows[0][0][0] != 'Event')
            return back()->with('error', 'Data Imported Failed!\n'.'Invalid DTR File. Please check or download the template first');           
        // Check if the Employee Start in Row 7 as per given Template
        if($rows[0][6] == null)
            return back()->with('error', 'Data Imported Failed!\n'.'The employee must start in Row 7.');

        // Check if there are no rows beyond the header
        if (count($rows[0]) <= 1) {
            // return response()->json([
            //     'message' => 'The file contains only the header row.',
            //     'headers' => $headings[0][0], // Return the headers for reference
            // ]);
            return back()->with('error', 'Data Imported Failed!\n'.'The file contains only the header row.');
        }
        
        $import = new RawAttendanceImport();

            Excel::import($import, $request->file('file'));

            return back()->with('success', 'Data Imported Successfully!');
            
            }catch(\Exception $e)
            {
                return back()->with('error', 'Data Imported Failed!'.$e->getMessage());
            }
    }
    public function downloadFileTemplate()
    {
        $filename = "HolidayTemplate.xls";
        $path = storage_path("app/public/template/{$filename}");

        try {
            
            return response()->download($path, $filename, [
            'Content-Type' => 'application/text',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to download the file.',
                'details' => $e->getMessage(),
            ], 500);
        }
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
