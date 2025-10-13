<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MyDataImport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $now = Carbon::now()->format('F');
        $defaultCutoff = Cutoff::where('Month','=',$now)->where('status','=','OPEN')->get();
        $data = DB::select($this->SummaryPayslipQuery(''));
        if($defaultCutoff->count() > 0)
        {
            $data = DB::select($this->SummaryPayslipQuery("and    cu.Month = '" . $defaultCutoff[0]->Month . "'"));
        }else
        {
            $data = DB::select($this->SummaryPayslipQuery("and    cu.status = 'OPEN'"));
        }
        return view('payroll.payslip.index',compact('defaultCutoff','data'));
    }
    public function SummaryPayslipQuery($criteria)
    {
        return "select 
                p.id,
                p.EmployeeCode as employee_code,
                e.lastname + ',' + e.firstname + ' ' + e.middlename as 'EmployeeName',
                p.NetAmount,
                cu.Month,
                cu.id as 'CutoffID',
                cu.StartDate,cu.EndDate,
                u.Name as 'PreparedBy',
                ua.Name as 'ApprovedBy',
                p.ApprovedDate,
                p.PreparedDate,
                concat(p.BasicPay,'/day') as 'BasicPay',
                p.TotalWorkingDays * p.BasicPay as 'BasicPayAmount',
                p.TotalWorkingDays,
				p.RegularOTHours,
				p.RegularOTPay,
                p.Status,
                p.TotalEarnings,
                p.TotalDeductions,
                p.NetAmount
                from payroll p 
                left join employees e on e.employeenumber = p.EmployeeCode 
                left join users u on u.id = p.PreparedBy               
                left join users ua on ua.id = p.ApprovedBy
                left join cutoff cu on cu.id = p.Cutoff_id
                where p.Status = 'Approved' " . $criteria;


    }
    public function getpaysliplist(Request $request)
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
            // if($request->employeecode != "")
            // {
            //     $criteria = "and
            //             dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'".
            //             "and dtr.employee_code = '" . $request->employeecode. "'";
            // }else
            // {
            //     $criteria = "and
            //             dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'";
            // }
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $criteria = '';
            
            $data = DB::select($this->SummaryPayslipQuery($criteria));
        }
        return view('payroll.payslip.index',compact('data','cutOFF','ProcessStatus'));
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
        
        $payrollKey = $request->empcode.'_'.$request->cutoffid;

        $payroll = Payroll::updateOrCreate([
            'PayrollKey' =>$payrollKey,],[
            'EmployeeCode'=>$request->empcode,
            'Cutoff_id'=>$request->cutoffid,
            'PreparedDate' => Carbon::now()->timezone('Asia/Manila'),
            'PreparedBy'=>Auth::id(),
        ]);

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
   
    public function downloadFileTemplate($empcode,$cutoff)
    {
        $filename = "Payslip.xls";
        $path = storage_path("app/public/template/{$filename}");
        
        $data = DB::select($this->SummaryPayslipQuery(' and cu.id = '.$cutoff.' and e.employeenumber='.$empcode));
        //dd($data);
        $cutoffDates = $data[0]->StartDate." to ".$data[0]->EndDate;
        $employee = "(".$data[0]->employee_code.") ".$data[0]->EmployeeName;
        $newFilename = "Payslip_".$empcode."_".$cutoffDates.".xlsx";

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            // Modify data (e.g., update cell A1)
            $sheet->setCellValue('C4', $employee);
            $sheet->setCellValue('C5', $cutoffDates);
            $sheet->SetCellValue('C9',$data[0]->BasicPay);
            $sheet->SetCellValue('C10',$data[0]->RegularOTHours == 0 ? '':number_format($data[0]->RegularOTHours,2));
            $sheet->SetCellValue('E9',number_format($data[0]->BasicPayAmount,2));
            $sheet->SetCellValue('E10',$data[0]->RegularOTPay == 0 ? '':number_format($data[0]->RegularOTPay,2));
            $sheet->SetCellValue('C37',number_format($data[0]->TotalEarnings,2));
            $sheet->SetCellValue('E37',number_format($data[0]->TotalDeductions,2));
            $sheet->SetCellValue('G37',number_format($data[0]->NetAmount,2));
            $sheet->SetCellValue('I30',$employee);
            $sheet->SetCellValue('I19',number_format($data[0]->NetAmount,2));
            // Add new data (e.g., add a new row)
            

            // Save the modified file to a new location
            $dlFilename = storage_path("app/public/{$newFilename}");
            
            $writer = new Xlsx($spreadsheet);
            
            $writer->save($dlFilename);
            
            return response()->download($dlFilename, $newFilename, [
            'Content-Type' => 'application/text',
            ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to download the file.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
