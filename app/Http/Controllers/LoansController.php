<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $data = DB::select("
            SELECT 
                l.id,l.Employeecode,lt.LoanType,lt.Description,
                l.LoanDate,l.Amount,l.NoOfPayment,l.AmountDeduction,l.SemiMonthlyInterest,
                l.Status,u.name as 'ApprovedBy',l.ApprovedDate,c.name as 'CreatedBy'
            from loan l
            left join employees emp on emp.employeenumber = l.Employeecode
            left join loantype lt on lt.id = l.Loantype
            left join users u on u.id = l.ApprovedBy
            left join users c on c.id = l.CreatedBy
            where LoanDate between '".$firstDayOfMonth."' and '".$lastDayOfMonth."'
        ");
      
        return view('deduction.loans.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loanType = LoanType::distinct()->select('LoanType')->where('isActive',1)->get();
        $employee = Employee::orderby('Lastname','DESC')->get();
        
        return view('deduction.loans.create',compact('loanType','employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            "LoanType"=>'required','string','max:255',
            "description"=>'required','integer',
            "empcode"=>'required',
            "date"=>'required',
        ]);
$SemiInterest = 0;
if($request->SemiInterest != null)
{
    $SemiInterest = $request->SemiInterest;
}
        $data = Loan::create([
            'Employeecode'=>strval($request->empcode),
            'LoanType'=>$request->description,
            'LoanDate'=> Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            'Amount'=>$request->loanAmount,
            'NoOfPayment'=>$request->installment,
            'AmountDeduction'=>$request->deductionAmount,
            'SemiMonthlyInterest'=>$SemiInterest,
            'Status'=>'For_Approval',
            'CreatedBy'=>Auth::id(),
        ]);

        return redirect()->route('deductions.loans.index')->with('success','Loan created successfully.');
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
    public function getLoanDesc(string $loanType)
    {
        
        $data = LoanType::where('LoanType',$loanType)->get();

        return response()->json($data);

    }
   
}
