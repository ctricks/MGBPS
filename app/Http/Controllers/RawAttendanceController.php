<?php

namespace App\Http\Controllers;

use App\Imports\RawAttendanceImport;
use App\Models\RawAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class RawAttendanceController extends Controller
{
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
        
        //Validate if the excel file is for DTR Process
        if($rows[0][0] == null || $rows[0][0][0] != 'Daily Time Record')
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
        $filename = "RawAttendanceTemplate.xls";
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $RawAttendanceData = RawAttendance::All();

        if($RawAttendanceData->count() == 0)
        {
            $data = $RawAttendanceData;
        }else{
        $data = $RawAttendanceData->toQuery()->paginate(10);
        }
        return view('attendance.raw.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendance.raw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Category::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        Category::create([
            'name'=>$request->name,
            'slug'=>$uniqueSlug,
        ]);
        return redirect()->route('admin.category.index')->with('success','Category created successfully.');
    }

    public function edit($category)
    {
        $data = Category::where('id',decrypt($category))->first();
        return view('admin.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        
        while (Category::where('slug', $uniqueSlug)->where('id', '!=', $request->id)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }

        Category::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => $uniqueSlug,
        ]);
        return redirect()->route('admin.category.index')->with('info','Category updated successfully.');   
    }

    public function destroy($id)
    {
        Category::where('id',decrypt($id))->delete();
        return redirect()->route('admin.category.index')->with('error','Category deleted successfully.');   
    }
}
