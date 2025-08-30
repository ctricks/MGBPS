<?php

namespace App\Http\Controllers;


use App\Models\Restday;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RestdayController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        $data = DB::table('restday')
    ->join('employees', 'restday.employee_id', '=', 'employees.id') // Inner Join
    ->select('employees.id', 'employees.employeenumber','employees.lastname','employees.firstname','employees.middlename','restday.restday','restday.isActive') // Select specific columns
    ->get();
        return view('attendance.restday.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = Employee::orderBy('lastname','ASC')->get();
        return view('attendance.restday.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Restday::updateOrCreate(
            [
                'EmployeeCodeKey'=>$request->empcode . "-" . $request->Restday,
                'employee_id'=>$request->empcode,
                'RestDay'=>$request->Restday,
                'Remarks'=>$request->Remarks,
            ],
        );
        if($request->id){
            $msg = 'Restday updated successfully.';
        }else{
            $msg = 'Restday created successfully.';
        }
        return redirect()->view('attendance.restday.index')->with('success',$msg);
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
     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

        try{

        // Get the uploaded file
        $file = $request->file('file');

        // Step 1: Extract the headers
        $headings = (new HeadingRowImport)->toArray($file);

        // Step 2: Read the entire file to check for additional rows
        $rows = Excel::toArray(null, $file);

        // Check if there are no rows beyond the header
        if (count($rows[0]) <= 1) {
            // return response()->json([
            //     'message' => 'The file contains only the header row.',
            //     'headers' => $headings[0][0], // Return the headers for reference
            // ]);
            return back()->with('error', 'Data Imported Failed!\n'.'The file contains only the header row.');
        }
        
        $import = new EmployeeImport();

            Excel::import($import, $request->file('file'));

            return back()->with('success', 'Data Imported Successfully!');
            
            }catch(\Exception $e)
            {
                return back()->with('error', 'Data Imported Failed!'.$e->getMessage());
            }
    }
}
