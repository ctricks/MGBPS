<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\Employee;
use App\Models\DeductionDetails;
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
        $employee = Employee::where('employee_status_id','=',1)->get();
        $criteria = "";//"where l.LoanDate between '".$firstDayOfMonth."' and '".$lastDayOfMonth."'";
        
        $data = DB::select($this->LoanQuery($criteria));
      
        return view('deduction.loans.index', compact('data','employee'));
    }
    public function LoanQuery($criteria)
    {
        return "
            SELECT 
                l.id,emp.employeenumber,lt.LoanType,lt.Description,
                l.LoanDate,l.Amount,l.NoOfPayment,l.AmountDeduction,l.SemiMonthlyInterest,
                l.Status,u.name as 'ApprovedBy',l.ApprovedDate,c.name as 'CreatedBy',
                sum(d.AmountPaid) as 'Paid',
				l.Amount - sum(d.AmountPaid) as 'Balances' 
            from loan l
            left join employees emp on emp.id = l.Employeeid
            left join loantype lt on lt.id = l.Loantype
            left join users u on u.id = l.ApprovedBy
            left join users c on c.id = l.CreatedBy 
            left join deduction_details d on d.loanReference = l.id
            " . $criteria . 
            "group by
                l.id,emp.employeenumber,lt.LoanType,lt.Description,
                l.LoanDate,l.Amount,l.NoOfPayment,l.AmountDeduction,l.SemiMonthlyInterest,
                l.Status,u.name,l.ApprovedDate,c.name";
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loanType = LoanType::distinct()->select('LoanType')->where('isActive',1)->get();
        $employee = Employee::orderby('Lastname','ASC')->get();
        
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
        $data = Loan::updateOrCreate([
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

        return redirect()->route('deductions.loans.index')->with('success','Loan saved successfully.');
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
        $loan = Loan::where('id',decrypt($id))->first();
        $loanTypeSelected = LoanType::select('id','LoanType','Description')->where('isActive',1)->where('id',$loan->Loantype)->first();
        
        $employee = Employee::where('id',$loan->EmployeeID)->first();
        $loanType = LoanType::OrderBy('id','ASC')->get();
    

        if($loan->Status <> "For_Approval")
            return redirect()->back()->with('failed','Modification of Loan unsuccessful. [Status must be \'For Approval\']');
        
        
        return view('deduction.loans.edit',compact('loan','employee','loanType','loanTypeSelected'));
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
        $data = Loan::where('id',decrypt($id))->get();
        
        if($data[0]->Status == 'For_Approval')
        {
            Loan::where('id',decrypt($id))->delete();
            return redirect()->back()->with('success','Deleting of Loan successful.');
        }else
        {
            return redirect()->back()->with('failed','Deleting of Loan unsuccessful. [Status must be \'For Approval\']');
        }
        
    }
    public function getLoanDesc(string $loanType)
    {
        
        $data = LoanType::where('LoanType',$loanType)->get();

        return response()->json($data);

    }

    public function getLoans(Request $request)
    {
        $criteria = "where
                    l.loandate between '". $request->startdate ."' and '". $request->enddate ."'";

        $data = DB::select($this->LoanQuery($criteria));
        $employee = Employee::where('employee_status_id','=',1)->get();
        return view('deduction.loans.index', compact('data','employee'));
    }
    public function approve(Request $request,$id)
    {
        $loandet = Loan::find(decrypt($id));

        $loandet->status = "Approved";
        $loandet->ApprovedBy =$request->user()->id;
        $loandet->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $loandet->save();

        $this->createdetails($id);

        $employee = Employee::where('employee_status_id','=',1)->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        // return redirect()->back()->with('success','DTR Correction Approved successfully.');
        $criteria = "where l.LoanDate between '".$firstDayOfMonth."' and '".$lastDayOfMonth."'";
        $data = DB::select($this->LoanQuery($criteria));
        return view('deduction.loans.index', compact('data','employee'));
    }
    public function decline(Request $request,$id)
    {
        $loandet = Loan::find(decrypt($id));
        $loandet->status = "Declined";
        $loandet->ApprovedBy =$request->user()->id;
        $loandet->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $loandet->save();
        $employee = Employee::where('employee_status_id','=',1)->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $criteria = "where l.LoanDate between '".$firstDayOfMonth."' and '".$lastDayOfMonth."'";
        $data = DB::select($this->LoanQuery($criteria));
        return view('deduction.loans.index', compact('data','employee'))->with('success','Declined of Loan successful.');
        
    }
    private function createdetails($id)
    {
         $loandet = Loan::find(decrypt($id));
         $noOfPayment = $loandet->NoOfPayment;
         $loanDate = Carbon::parse($loandet->LoanDate)->format('Y-m-d');
         $DeductionKey = decrypt($id).'_'.$loandet->Loantype.'_'.$loandet->Amount.'_'.$noOfPayment.'_'.$loanDate;
        
         for($a = 1; $a <= $noOfPayment; $a++)
         {
            $data = DeductionDetails::updateOrCreate(
                ['DeductionKey' =>  $DeductionKey],
                ['LoanDate' => $loanDate,
                    'Deduction'=> $loandet->Amount,
                    'DeductionType'=>$loandet->Loantype,
                    'Amount'=>$loandet->AmountDeduction,
                    'LoanReference'=>decrypt($id)]
            );
            $newDate = Carbon::parse($loanDate)->addDays(15); 
            $loanDate =  $newDate;
            $DeductionKey = decrypt($id).'_'.$loandet->Loantype.'_'.$loandet->Amount.'_'.$noOfPayment.'_'.$loanDate;
         }
    }
    public function LoanDetails($id)
    {
        $data = DB::select("
                    select 
                        d.id,d.LoanDate,d.Deduction,l.LoanType,l.Description,d.Amount,
                        (d.Amount - d.AmountPaid) as 'Balances',
                        d.AmountPaid,isNULL(Convert(Varchar,d.DateDeducted),'Not Yet') as DateDeducted,u.name as 'ProcessedBy',
                        isNUll(d.PaymentReference,'-1') as 'Status',
                        d.ProcessedDate,d.updated_at
                    from 
                        deduction_details d
                    left join loantype l on d.DeductionType = l.id
                    left join users u on d.ProcessedBy = u.id
                    where LoanReference = ".decrypt($id));
        
        return view('deduction.loans.view',compact('data'));
    }
}
