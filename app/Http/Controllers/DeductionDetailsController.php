<?php

namespace App\Http\Controllers;

use App\Models\DeductionDetails;
use App\Models\Loan;
use Illuminate\Http\Request;

class DeductionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        return view('deduction.deductiondetails.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = DeductionDetails::where('id',decrypt($id))->first();
        return view('deduction.loansdetails.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Loan::where('id',decrypt($id))->first();
        
        if($data->Status == "For_Approval")
        {
            return view('deduction.loans.edit',compact('data'));
        }else
        {
            return redirect()->back()->with('failed','Cannot edit Loan. {Status must be For Approval}.');
        }
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
