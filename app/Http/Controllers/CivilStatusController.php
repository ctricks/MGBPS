<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CivilStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = CivilStatus::orderBy('id','DESC')->get();
        return view('admin.civilstatus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.civilstatus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "civilstatus"=>'required','string','max:255'
        ]);

        $civilstatus = CivilStatus::create([
            'civilstatus'=>$request->civilstatus
        ]);

        return redirect()->route('admin.civilstatus.index')->with('success','Civil Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CivilStatus $civilStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $civilstatus = CivilStatus::where('id',decrypt($id))->first();
        return view('admin.civilstatus.edit',compact('civilstatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CivilStatus $civilstatus)
    {
        //
        $request->validate([
            "civilstatus"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        
        $civilstatus = CivilStatus::find($request->id);
        $civilstatus->civilstatus = $request->civilstatus;
        $civilstatus->isActive = $request->isActive;
        $civilstatus->save();
        return redirect()->route('admin.civilstatus.index')->with('Success','Civil Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        CivilStatus::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Civil Status deleted successfully.');
    }
}
