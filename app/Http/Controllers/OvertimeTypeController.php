<?php

namespace App\Http\Controllers;

use App\Models\OvertimeType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OvertimeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = OvertimeType::orderBy('id','ASC')->get();
        return view('admin.overtimetype.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.overtimetype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            "overtimetype"=>'required','string','max:255'
        ]);

        $data = OvertimeType::create([
            'OvertimeType'=>$request->overtimetype,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('admin.overtimetype.index')->with('success','Overtime Type created successfully.');
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
        $data = OvertimeType::where('id',decrypt($id))->first();
        return view('admin.overtimetype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "overtimetype"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        
        $overtimetype = OvertimeType::find($request->id);
        $overtimetype->overtimetype = $request->overtimetype;
        $overtimetype->description = $request->Description;
        $overtimetype->isActive = $request->isActive;
        $overtimetype->save();
        return redirect()->route('admin.overtimetype.index')->with('success','Overtime Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        OvertimeType::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Overtime Type deleted successfully.');
    }
}
