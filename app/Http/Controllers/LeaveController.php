<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
   public function index()
    {
        //
        //$data = Leave::orderBy('id','DESC')->get();
        $data = DB::raw(
            "select  
                l.id,l.EmpCode,e.lastname + ',' + e.firstname as 'EmployeeName',l.LeaveType,lt.Description,l.StartDate,l.EndDate,l.ApprovedDate,
                u.name as 'ApprovedBy',l.Status
            from 
                leaves l
            left join employees e on l.EmpCode = e.employeenumber
            left join leave_type lt on l.LeaveType = lt.LeaveType 
            left join users u on l.ApprovedBy = u.id
            order by 
                id desc;"
        );
    
        return view('attendance.leave.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $LeaveType = LeaveType::orderBy('id','DESC')->get();
        $employee = Employee::orderBy('id','DESC')->get();
        
        return view('attendance.leave.create',compact('LeaveType','employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "leavetype"=>'required','string','max:255'
        ]);

        $leavetype = LeaveType::create([
            'LeaveType'=>$request->leavetype,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('attendance.leave.index')->with('success','Leave created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Leave::where('id',decrypt($id))->first();
        
        return view('attendance.leave.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Leave $leave)
    {
        //
        $request->validate([
            "LeaveType"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        

        $leave = Leave::find($request->id);
        $leave->leavetype = $request->LeaveType;
        $leave->description = $request->Description;
        $leave->isActive = $request->isActive;
        $leave->save();
        return redirect()->route('attendance.leave.index')->with('Success','Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Leave::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Leave deleted successfully.');
    }
}
