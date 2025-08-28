<?php

namespace App\Http\Controllers;

use App\Models\EmployeeStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = EmployeeStatus::orderBy('id','DESC')->get();
        return view('admin.employeestatus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.employeestatus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "employeestatus"=>'required','string','max:255'
        ]);

        $employeestatus = EmployeeStatus::create([
            'employeestatus'=>$request->employeestatus,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('admin.employeestatus.index')->with('success','Employee Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeStatus $employeestatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $employeestatus = EmployeeStatus::where('id',decrypt($id))->first();
        return view('admin.employeestatus.edit',compact('employeestatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,EmployeeStatus $employeestatus)
    {
        //
        $request->validate([
            "employeestatus"=>'required','string','max:255',
            "Description"=>'string','max:255',
            "isActive"=>'required','integer',
        ]);
        $employeestatus = EmployeeStatus::find($request->id);
        $employeestatus->employeestatus = $request->employeestatus;
        $employeestatus->Description = $request->description;
        $employeestatus->isActive = $request->isActive;
        $employeestatus->save();
        return redirect()->route('admin.employeestatus.index')->with('Success','Employee Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        EmployeeStatus::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Employee Status deleted successfully.');
    }
}
