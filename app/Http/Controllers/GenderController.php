<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = gender::orderBy('id','DESC')->get();
        return view('admin.gender.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.gender.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "gender"=>'required','string','max:255'
        ]);

        $gender = Gender::create([
            'gender'=>$request->gender
        ]);

        return redirect()->route('admin.gender.index')->with('success','Gender created successfully.');
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
        $gender = Gender::where('id',decrypt($id))->first();
        return view('admin.gender.edit',compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Gender $gender)
    {
        //
        $request->validate([
            "gender"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        
        $gender = Gender::find($request->id);
        $gender->gender = $request->gender;
        $gender->isActive = $request->isActive;
        $gender->save();
        return redirect()->route('admin.gender.index')->with('Success','Gender updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Gender::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Gender deleted successfully.');
    }
}
