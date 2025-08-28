<?php

namespace App\Http\Controllers;
use App\Imports\EmployeeImport;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Employee;
use App\Models\CivilStatus;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Department;
use App\Models\EmployeeStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;


class EmployeeController extends Controller
{
    //Display Employee index page
    public function index()
    {
        $data = Employee::orderBy('id','DESC')->get();
        
        return view('admin.employee.index', compact('data'));
    }
    public function create()
    {
        $civilstatus = CivilStatus::where('isActive',1)->get();
        $gender = Gender::where('isActive',1)->get();
        $position = Position::where('isActive',1)->get();
        $department = Department::where('isActive',1)->get();
        $employeestatus = EmployeeStatus::where('isActive',1)->get();
        return view('admin.employee.create',compact('civilstatus','gender','position','department','employeestatus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employeenumber' => 'required', 'string', 'max:255',
            'lastname' => 'required', 'string', 'max:255',
            'firstname' => 'required','string','max:255',
        ]);

        $employee = Employee::create([
            'employeenumber' => $request->employeenumber,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'Address' => $request->address,
            'telephone' => $request->telephone,
            'birthday' => $request->birthday,
            'civil_status_id' => $request->civilstatus,
            'gender_id' => $request->gender,
            'position_id' => $request->position,
            'department_id' => $request->departmentname,
            'employee_status_id'=>$request->employeestatus,
        ]);
        return redirect()->route('admin.employee.index')->with('success','Employee created successfully.');
    }
    public function edit($id)
    {
        $civilstatus = CivilStatus::where('isActive',1)->get();
        $employee = Employee::where('id',decrypt($id))->first();
        $gender = Gender::where('isActive',1)->get();
        $position = Position::where('isActive',1)->get();
        $department = Department::where('isActive',1)->get();
        $employeestatus = EmployeeStatus::where('isActive',1)->get();
        $empBirthDate = Carbon::parse($employee->Birthday)->format('Y-m-d');
        
        return view('admin.employee.edit',compact('civilstatus','employee','gender','position','department','employeestatus','empBirthDate'));
    }
    public function update(Request $request, Employee $employee)
    {
          
        $request->validate([
            'employeenumber' => 'required', 'integer', 'max:255',
            'lastname' => 'required', 'string', 'max:255',
            'firstname' => 'required', 'string', 'max:255',
        ]);  
        
        $employee = Employee::find($request->id);
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->Address = $request->address;
        $employee->Telephone = $request->telephone;
        $employee->Birthday = $request->birthday;
        $employee->civil_status_id = $request->civilstatus;
        $employee->gender_id = $request->gender;
        $employee->position_id = $request->position;
        $employee->department_id = $request->departmentname;
        $employee->employee_status_id = $request->employeestatus;
        
        $employee->save();
        return redirect()->route('admin.employee.index')->with('success','Employee updated successfully.');
    }
    public function destroy($id)
    {
        Employee::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Employee deleted successfully.');
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
    public function downloadFileTemplate()
    {
        $filename = "EmployeeRecordTemplate.xls";
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
}
