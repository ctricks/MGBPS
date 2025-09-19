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
        $data = LoanType::where('id',decrypt($id))->first();
        return view('admin.loantype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "LoanType"=>'required','string','max:255',
            "Description"=>'required','string','max:255',
            "isActive"=>'required','integer',
        ]);
        
        $loantype = LoanType::find($request->id);
        $loantype->LoanKey = $request->LoanType.'_'.$request->Description;
        $loantype->LoanType = $request->LoanType;
        $loantype->Description = $request->Description;
        $loantype->isActive = $request->isActive;
        $loantype->save();
        return redirect()->route('admin.loantype.index')->with('success','Loan Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        LoanType::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Loan Type deleted successfully.');
    }
}
