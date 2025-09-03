<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;

class LeaveTypeController extends Controller
{
    //
    public function index()
    {
        //
        $data = LeaveType::orderBy('id','DESC')->get();
        return view('attendance.leavetype.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('attendance.leavetype.create');
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

        return redirect()->route('attendance.leavetype.index')->with('success','Leave created successfully.');
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
        $data = LeaveType::where('id',decrypt($id))->first();
        
        return view('attendance.leavetype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,LeaveType $leavetype)
    {
        //
        $request->validate([
            "LeaveType"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        

        $leavetype = LeaveType::find($request->id);
        $leavetype->leavetype = $request->LeaveType;
        $leavetype->description = $request->Description;
        $leavetype->isActive = $request->isActive;
        $leavetype->save();
        return redirect()->route('attendance.leavetype.index')->with('Success','Leave Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        LeaveType::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Leave Type deleted successfully.');
    }
}
