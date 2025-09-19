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
                l.id,emp.employeenumber,lt.LoanType,lt.Description,
                l.LoanDate,l.Amount,l.NoOfPayment,l.AmountDeduction,l.SemiMonthlyInterest,
                l.Status,u.name as 'ApprovedBy',l.ApprovedDate,c.name as 'CreatedBy'
            from loan l
            left join employees emp on emp.id = l.Employeeid
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
        $employee = Employee::where('employeenumber',$request->empcode)->get();
        if($employee->count() == 0)
        {
            return redirect()->route('deductions.loans.index')->with('failed','Loan failed.');
        }
        $data = Loan::create([
            'Employeeid'=>$employee[0]->id,
            'LoanType'=>$request->description,
            'LoanDate'=> Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            'Amount'=>(float) str_replace(',', '', number_format($request->loanAmount,2)),
            'NoOfPayment'=>$request->installment,
            'AmountDeduction'=>(float) str_replace(',', '', number_format($request->deductionAmount,2)),
            'SemiMonthlyInterest'=>(float) str_replace(',', '',number_format($SemiInterest,2)),
            'Status'=>strval('For_Approval'),
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
        dd($id);
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
