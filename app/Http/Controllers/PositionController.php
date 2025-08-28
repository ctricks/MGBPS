<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Position::orderBy('id','DESC')->get();
        return view('admin.position.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "position"=>'required','string','max:255'
        ]);

        $position = Position::create([
            'PositionName'=>$request->position,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('admin.position.index')->with('success','Position created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $position = Position::where('id',decrypt($id))->first();
        return view('admin.position.edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Position $position)
    {
        //
        $request->validate([
            "position"=>'required','string','max:255',
            "Description"=>'string','max:255',
            "isActive"=>'required','integer',
        ]);
        $position = Position::find($request->id);
        $position->PositionName = $request->position;
        $position->Description = $request->description;
        $position->isActive = $request->isActive;
        $position->save();
        return redirect()->route('admin.position.index')->with('Success','Position updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Position::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Position deleted successfully.');
    }
}
