<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\DeductionDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $now = Carbon::now()->format('F');
        $defaultCutoff = Cutoff::where('Month','=',$now)->where('status','=','OPEN')->get();
        $data = DB::select($this->SummaryPayrollQuery(''));
        if($defaultCutoff->count() > 0)
        {
            $data = DB::select($this->SummaryPayrollQuery("and    cu.Month = '" . $defaultCutoff[0]->Month . "'"));
        }else
        {
            $data = DB::select($this->SummaryPayrollQuery("and    cu.status = 'OPEN'"));
        }
        return view('payroll.summary.index',compact('defaultCutoff','data'));
    }
    public function getemployeelist(Request $request)
    {
        $cutoffData = Cutoff::where('id',$request->cutoff)->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $currentMonthName = Carbon::now()->format('F');

        $cutOFF = CutOff::where('Month','=',$currentMonthName)->get();
        
        $ProcessStatus = "Not Process";

        if(isset($cutOFF))
        {
            $this->createcufoff('');
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }

        if($cutoffData[0] != null)
        {
            if($request->employeecode != "")
            {
                $criteria = "and
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'".
                        "and dtr.employee_code = '" . $request->employeecode. "'";
            }else
            {
                $criteria = "and
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'";
            }
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::select($this->SummaryPayrollQuery($criteria));
        }
        return view('payroll.summary.index',compact('data','cutOFF','ProcessStatus'));
    }
    public function createcufoff($monthName)
    {
        try{
            $currentMonthName = Carbon::now()->format('F');
            $firstDayOfMonth = Carbon::now()->startOfMonth();
            $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
            $firstCutoff = $firstDayOfMonth->addDays(14);
            
            if($monthName != '')
            {
                $currentMonthName = $monthName;
                $firstDayOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->firstOfMonth();
                $startOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->startOfMonth()->toDateTimeString();
                $firstCutoff = $firstDayOfMonth->addDays(14);
            }

            Cutoff::updateOrCreate(
                [
                    'CutoffKey'=>$currentMonthName . "-" . $firstDayOfMonth->format('Y-d-m'),
                    'Month'=>$currentMonthName,
                    'StartDate'=>$startOfMonth,
                    'EndDate'=>$firstCutoff,
                ],
            );
            $secondCOStartDay = $firstCutoff->addDays(1);
            $lastDayOfMonth = Carbon::now()->lastOfMonth();

            if($monthName != '')
            {
                $secondCOStartDay = $firstCutoff;
                $lastDayOfMonth = Carbon::createFromFormat('F Y', $monthName.' '.Carbon::now()->year)->lastOfMonth();
            }

            Cutoff::updateOrCreate(
                [
                    'CutoffKey'=>$currentMonthName . "-" . $secondCOStartDay->format('Y-d-m'),
                    'Month'=>$currentMonthName,
                    'StartDate'=>$secondCOStartDay,
                    'EndDate'=>$lastDayOfMonth,
                ],
            );
        }catch(Exception $e)
        {
            return back()->with('error', 'Cut-off creation failed! '. $e->getMessage());
        }
    }
    public function payrollQuery($cutoff,$empcode)
    {
        return $Query = "
            Select
                cu.Month,
                cu.id as 'cutoffid',
                cu.StartDate,cu.EndDate,
                dtr.employee_code as 'Employee_Code',
                CAST((s.WorkHours / 8) as DECIMAL(9,2)) as 'WorkingDays',
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                emp.DailyRate,
                CAST(s.WorkHours * ( emp.DailyRate  / 8) as DECIMAL(9,2)) as 'BasicPay',
                (s.Absent / 8) as 'Absent',
                CAST((s.Absent / 8 ) * emp.DailyRate as DECIMAL(9,2)) as 'AbsentPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'REGOT')),0) as 'RegularOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'REGOT')),0) as 'RegularOTPay',
                0 as 'HalfdayHrs',
				0.00 as 'HalfdayPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RDOT')),0) as 'SundayOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RDOT')),0) as 'SundayOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHOLOT')),0) as 'LegalOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHOLOT')),0) as 'LegalOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SNWHOLOT')),0) as 'SplNWOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SNWHOLOT')),0) as 'SplNWOTPay',
                isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SHRDOT')),0) as 'SplRDOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'SHRDOT')),0) as 'SplRDOTPay',
                 isnull((select sum(o.OTHoursApproved) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHRDOT')),0) as 'LGRDOTHrs',
                isnull((select sum(o.OTPay) from overtime o where o.OTDate between cu.StartDate and cu.EndDate and o.EmployeeCode = dtr.employee_code and o.Status = 'Approved' and OverTimeTypeID = (select id from overtimetype where OverTimeType = 'RHRDOT')),0) as 'LGRDOTPay',
                0 as 'ExceedingHrs',
                0 as 'SRDOTExceedingHours',
                0 as 'LOTExceedingHours',
                0 as 'SPNWExceedinHours',
                0 as 'DOLOExceedingHours',
                0 as 'DOSOExceedingHours',
                0.00 as 'ExceedingHrsPay',
                0.00 as 'NightDiff',
                0 as 'HalfDay',
                (case when (select sum(d.Late) as 'Late' from daily_time_records d 
left join cutoff c on d.date between cu.StartDate and cu.EndDate
where d.employee_code = emp.employeenumber and lower(cu.Month) = cu.Month) >= 0.5 then (select sum(d.Late) as 'Late' from daily_time_records d 
left join cutoff c on d.date between cu.StartDate and cu.EndDate
where d.employee_code = emp.employeenumber and c.id = cu.id) else 0 end) as 'LateHrs',
                 ((emp.DailyRate / 8)  *  (case when (select sum(d.Late) as 'Late' from daily_time_records d 
left join cutoff c on d.date between cu.StartDate and cu.EndDate
where d.employee_code = emp.employeenumber and lower(cu.Month) = cu.Month) >= 0.5 then (select sum(d.Late) as 'Late' from daily_time_records d 
left join cutoff c on d.date between cu.StartDate and cu.EndDate
where d.employee_code = emp.employeenumber and c.id = cu.id) else 0 end)) as 'LatePay',
                0.00 as 'HalfdayPay',
                0.00 as 'UndertimeHrs',
                0.00 as 'Undertime',
                0.00 as 'SSS',
                0.00 as 'PHILHEALTH',
                CAST(s.WorkHours * ( emp.DailyRate  / 8) as DECIMAL(9,2))
                as 'TotalEarnings',
                isnull(d.Amount,0.00) as 'HDMF',
                0.00 as 'TaxPay',
                isnull((select SUM(d.Amount) as 'LoanAmount' from deduction_details d
                left join loan l on l.id = d.LoanReference
                left join loantype lt on lt.id = l.Loantype
                left join cutoff c on d.LoanDate between cu.StartDate and cu.EndDate
                where l.Status = 'Approved' and lt.LoanType = 'SSS' 
				and l.EmployeeID = emp.id and c.id = cu.id),0.00) as 'SSSLoans',
                isnull((select SUM(d.Amount) as 'LoanAmount' from deduction_details d
                left join loan l on l.id = d.LoanReference
                left join loantype lt on lt.id = l.Loantype
                left join cutoff c on d.LoanDate between cu.StartDate and cu.EndDate
                where l.Status = 'Approved' and lt.LoanType = 'HDMF' 
				and l.EmployeeID = emp.id and c.id = cu.id),0.00) as 'HDMFLoans',
                isnull((select SUM(d.Amount) as 'LoanAmount' from deduction_details d
                left join loan l on l.id = d.LoanReference
                left join loantype lt on lt.id = l.Loantype
                left join cutoff c on d.LoanDate between cu.StartDate and cu.EndDate
                where l.Status = 'Approved' and lt.LoanType = 'COMPANY' 
				and l.EmployeeID = emp.id and c.id = cu.id),0.00) as 'OtherLoans'
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
				left join payroll p on p.employeecode = emp.employeenumber  
				left join users u on u.id = p.PreparedBy 
                left join users a on a.id = p.ApprovedBy
                left join summary_attendance s on s.employeecode = emp.employeenumber and s.StartDateCutoff = cu.StartDate and s.EndDateCutoff = cu.EndDate
                left join autodeduction d on d.employeecode = dtr.employee_code and d.deductionname = 'HDMF' and d.AD_Date =  cu.EndDate
                where [date] between cu.StartDate and cu.EndDate
                and
				cu.id = ". $cutoff ." 
                and 
                dtr.employee_code = ". $empcode ."
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,emp.id,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename,
                    emp.DailyRate,s.WorkHours,s.Absent,d.Amount,emp.employeenumber
                order by emp.lastname desc";
    }
    public function getemployeesummary($cutoff,$empcode)
    {
        $cutoffData = Cutoff::where('id',$cutoff)->get();
        $cutoffDataSelected = "";
        if($cutoffData->count() > 0)
        {
            $cutoffDataSelected = $cutoffData[0]->StartDate ." to " . $cutoffData[0]->EndDate;
        }
        $PayrollQuery = $this->payrollQuery($cutoff,$empcode);
            
        $data = DB::select($PayrollQuery); 

        return view('payroll.summary.view',compact('data','cutoffDataSelected','cutoff'));
    }
    public function SummaryPayrollQuery($Criteria)
    {
        return "
            SELECT
                pay.id, 
                cu.Month,
                --Concat (cu.StartDate, ' to ' ,cu.EndDate) as 'cutoffid',
                cu.id as 'cutoffid',
                cu.StartDate,cu.EndDate,
                dtr.employee_code,
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                u.name as 'PreparedBy',pay.PreparedDate,
                a.name as 'ApprovedBy',pay.ApprovedDate,
                case when pay.Status is null then 'For Processing'
                else pay.Status end as 'Status'
            FROM 
                daily_time_records dtr
            left join employees emp on dtr.employee_code = emp.employeenumber
            left join cutoff cu on dtr.cutoff = cu.id 
            left join payroll pay on pay.EmployeeCode = emp.employeenumber and pay.Cutoff_id = cu.id
            left join users u on u.id = pay.PreparedBy 
            left join users a on a.id = pay.ApprovedBy
            where 
                [date] between cu.StartDate and cu.EndDate
                " . $Criteria . "
            group by 
                pay.id,cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename,
pay.Status,u.name,a.name,pay.PreparedDate,pay.ApprovedDate
            order by 
                emp.lastname desc
        ";
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
        $cutoff = $request->cutoffid;
        $empcode = $request->empcode;

        $PayrollQuery = $this->payrollQuery($cutoff,$empcode);
            
        $data = DB::select($PayrollQuery);
//dd($data);
        $payrollKey = $request->empcode.'_'.$request->cutoffid;

        $payroll = Payroll::updateOrCreate([
            'PayrollKey' =>$payrollKey,],[
            'EmployeeCode'=>$request->empcode,
            'Cutoff_id'=>$request->cutoffid,
            'TotalWorkingDays'=>$data[0]->WorkingDays,
            'TotalWorkingHours'=>$data[0]->WorkingDays * 8,
            'RegularOTHours'=>$data[0]->RegularOTHrs,
            'BasicPay'=>$data[0]->DailyRate,
            'RegularOTPay'=>$data[0]->RegularOTPay,
            'SundayRestDayOT'=>$data[0]->SundayOTPay,
            'SRDOTExceedingHours'=>$data[0]->SRDOTExceedingHours,
            'LegalOT'=>$data[0]->LegalOTPay,
            'LOTExceedingHours'=>$data[0]->LOTExceedingHours,
            'SpecialNonWorkingOT'=>$data[0]->SplNWOTHrs,
            'SPNWExceedinHours'=>$data[0]->SPNWExceedinHours,
            'DayOffLegalOT'=>$data[0]->LGRDOTPay,
            'DOLOExceedingHours'=>$data[0]->DOLOExceedingHours,
            'DayOffSpecialOT'=>$data[0]->SplRDOTPay,
            'DOSOExceedingHours'=>$data[0]->DOSOExceedingHours,
            'NightDiff'=>$data[0]->NightDiff,
            'AllowanceTaxable'=>$request->AllowansTax,
            'AllowanceECola'=>$request->AllowanceECola,
            'OthersTaxable'=>$request->OthersTaxable,
            'OthersTaxable2'=>$request->OthersTaxable2,
            'OthersTaxable3'=>$request->OthersTaxable3,
            'Adjustment'=>$request->Adjustment,
            'Others'=>$request->Others,
            'Absences'=>$request->Absents,
            'HalfDay'=>$data[0]->HalfdayPay,
            'Lates'=>$data[0]->LatePay,
            'Undertime'=>$data[0]->Undertime,
            'SSS'=>$data[0]->SSS,
            'PHILHEALTH'=>$data[0]->PHILHEALTH,
            'HDMF'=>$data[0]->HDMF,
            'TAX'=>$data[0]->TaxPay,
            'SSSLoans'=>$data[0]->SSSLoans,
            'HDMFLoans'=>$data[0]->HDMFLoans,
            'OtherLoans'=>$data[0]->OtherLoans,
            'TotalEarnings'=>$request->TotalEarnings,
            'TotalDeductions'=>$request->TotalDeduction,
            'NetAmount'=>$request->NetAmount,
            'PreparedDate' => Carbon::now()->timezone('Asia/Manila'),
            'PreparedBy'=>Auth::id(),
        ]);

        $payrollID = Payroll::where('PayrollKey','=',$payrollKey)->get();
        
        if($payrollID->count() > 0)
        {
        $updateLoans = "update deduction_details set
                        ProcessedDate = CURRENT_TIMESTAMP, PaymentReference = ".$payrollID[0]->id."
                        where id in (
                        select d.id from deduction_details d
                        left join loan l on l.id = d.LoanReference
                        left join loantype lt on lt.id = l.Loantype
                        left join cutoff cu on d.LoanDate between cu.StartDate and cu.EndDate
                        where cu.id = ".$payrollID[0]->Cutoff_id." and l.Status = 'APPROVED' and lt.LoanType = 'SSS')";
        
            DB::update($updateLoans);
        }
        return redirect()->back()->with('success','Payroll created successfully. [Awaiting for approval]');
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
        Payroll::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Payroll deleted successfully.');
    }
    public function approve(Request $request,$id)
    {
        
        $payroll = Payroll::find(decrypt($id));
        $payroll->status = "Approved";
        $payroll->ApprovedBy =$request->user()->id;
        $payroll->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $payroll->save();

        $updateLoanPayment = DeductionDetails::where('PaymentReference',decrypt($id))->get();

        if($updateLoanPayment->count() > 0)
        {
            $updateLoanPayment->DateDeducted = Carbon::now()->timezone('Asia/Manila');
            $updateLoanPayment->ProcessedBy = $request->user()->id;
            $updateLoanPayment->save();
        }

        return redirect()->back()->with('success','Payroll Approved successfully.');
    }
    public function decline(Request $request,$id)
    {
        $payroll = Payroll::find(decrypt($id));
        $payroll->status = "Declined";
        $payroll->ApprovedBy =$request->user()->id;
        $payroll->ApprovedDate = Carbon::now()->timezone('Asia/Manila');
        $payroll->save();

        return redirect()->back()->with('success','Payroll Declined successfully.');
    }
}
