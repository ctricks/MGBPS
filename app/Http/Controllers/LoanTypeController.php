<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         //
        $data = LoanType::orderBy('id','DESC')->get();
        return view('admin.loantype.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('admin.loantype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "loantype"=>'required','string','max:255'
        ]);

        $leavetype = LoanType::create([
            'LoanKey'=>$request->loantype . '_' . $request->description,
            'LoanType'=>$request->loantype,
            'Description'=>$request->description,
            'isActive'=>$request->isActive,
        ]);

        return redirect()->route('admin.loantype.index')->with('success','Loan created successfully.');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
