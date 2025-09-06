<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
   public function index()
    {
        //
        //$data = Leave::orderBy('id','DESC')->get();
        $data = DB::select(
            "select  
                l.id,l.EmpCode,e.lastname + ',' + e.firstname as 'EmployeeName',lt.LeaveType,lt.Description,l.StartDate,l.EndDate,l.ApprovedDate,
                u.name as 'ApprovedBy',l.Status
            from 
                leaves l
            left join employees e on l.EmpCode = e.employeenumber
            left join leave_type lt on l.LeaveType = lt.id 
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
            "leavetype"=>'required','string','max:255',
        ]);

        $Sdate = Carbon::parse($request->StartDate)->format('M d, Y');
        $Edate = Carbon::parse($request->EndDate)->format('M d, Y');
        
        $result = $Sdate > $Edate;

        if($result)
            return redirect()->route('attendance.leave.index')->with('failed','Leave created failed - Unable to save your Leave. Please check Dates.');
            
        $leavetype = Leave::create([
            'LeaveKey' =>$request->leavetype.$request->empcode.$request->StartDate,
            'EmpCode'=>$request->empcode,
            'LeaveType'=>$request->leavetype,
            'Remarks'=>$request->description,
            'StartDate'=>$request->StartDate,
            'EndDate'=>$request->EndDate,
            'Status'=>'For Approval',
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
    public function approve(Request $request,$id)
    {
        $leave = Leave::find(decrypt($id));
        $leave->status = "Approved";
        $leave->ApprovedBy =$request->user()->id;
        $leave->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $leave->save();

        return redirect()->back()->with('success','Leave Approved successfully.');
    }
    public function decline(Request $request,$id)
    {
        $leave = Leave::find(decrypt($id));
        $leave->status = "Declined";
        $leave->ApprovedBy =$request->user()->id;
        $leave->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $leave->save();

        return redirect()->back()->with('success','Leave Declined successfully.');
    }
}
