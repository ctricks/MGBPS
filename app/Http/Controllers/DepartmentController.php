<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Department::orderBy('id','DESC')->get();
        return view('admin.department.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "department"=>'required','string','max:255'
        ]);

        $department = Department::create([
            'DepartmentName'=>$request->department,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('admin.department.index')->with('success','Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $department = Department::where('id',decrypt($id))->first();
        return view('admin.department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Department $department)
    {
        //
        $request->validate([
            "Department"=>'required','string','max:255',
        ]);

        $department = Department::find($request->id);
        $department->DepartmentName = $request->Department;
        $department->Description = $request->description;
        $department->isActive = $request->isActive;
        $department->save();
        return redirect()->route('admin.department.index')->with('Success','Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Department::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Department deleted successfully.');
    }
}
