<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\CutOff;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DailyTimeRecordImport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DailyTimeRecordController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls'
        // ]);
         $file = $request->file('file');

         if($file == null)
         {
            return back()->with('error', 'Daily time records imported failed! File is invalid');    
         }


         $extension = $file->getClientOriginalExtension();
        
         if($extension != "xls" && $extension != "xlsx")
         {
            return back()->with('error', 'Daily time records imported failed! File is invalid');    
         }

        // Import the file using the custom import class
        Excel::import(new DailyTimeRecordImport, $request->file('file'));

        return back()->with('success', 'Daily time records imported successfully!');
    }
    public function index()
    {
        //$data = DailyTimeRecord::orderBy('created_at', 'desc')->get();

        // $data = DB::table('Daily_Time_Records')
        //         ->leftJoin('employees', 'Daily_Time_Records.employee_code', '=', 'employees.employeenumber')
        //         ->select('Daily_Time_Records.*', 'employees.*')
        //         ->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $currentMonthName = Carbon::now()->format('F');
        $ProcessStatus = "Not Process yet"; 
        $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        
        // if(isset($cutOFF))
        // {
        //     $this->createcufoff('');
        //     $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        // }

        $data = DB::select($this->DTRQuery(''));

        // if($RawAttendanceData->count() == 0)
        // {
        //     $data = $RawAttendanceData;
        // }else{
        // $data = $RawAttendanceData->toQuery()->paginate(10);
        // }00
        //dd(count($RawAttendanceData));
        $selectedEmployee='';
        $empcode = $selectedEmployee;
        $dayNow = Carbon::now();
        $LastSearch = $dayNow->setTimezone('Asia/Manila');;
        return view('attendance.raw.index',compact('data','cutOFF','ProcessStatus','selectedEmployee','LastSearch','empcode'));
    }

    public function edit($id)
    {
        //
        $data = DailyTimeRecord::where('id',decrypt($id))->first();
        $employee = Employee::where('employeenumber',$data->employee_code)->first();
        // if($data->in_1 != null)
        // {
        //     $data->in_1 = Carbon::createFromFormat('H:i:s',substr(rtrim($data->in_1,"0"),0,8))->format('h:i:s A');
        // }
        // if($data->in_2 != null)
        // {
        //     $data->in_2 = Carbon::createFromFormat('H:i:s',substr(rtrim($data->in_2,"0"),0,8))->format('h:i:s A');
        // }
            
        
        return view('attendance.raw.edit',compact('data','employee'));
    }

    public function update(Request $request, DailyTimeRecord $dtr)
    {
        //
        // $request->validate([
        //     "civilstatus"=>'required','string','max:255',
        //     "isActive"=>'required','integer',
        // ]);
        try{
        $dtr = DailyTimeRecord::find($request->id);
        $dtr->in_1 = $request->time_in;
        $dtr->out_1 = $request->time_out;
        $dtr->in_2 = $request->time_in2;
        $dtr->out_2 = $request->time_out2;
        $dtr->in_3 = $request->time_in3;
        $dtr->out_3 = $request->time_out3;
     
        $dtr->LastUpdateBy =$request->user()->id;
        $dtr->LastUpdateDate = Carbon::now()->timezone('Asia/Manila');
        //$dtr->isActive = $request->isActive;
        $dtr->save();
        }catch(Exception $ex)
        {
            return redirect()->route('attendance.raw.index')->with('Error',$ex);       
        }
        return redirect()->route('attendance.raw.index')->with('Success','DTR updated successfully');
    }

    public function getCutoffData($monthnum)
    {
        $monthName = Carbon::create()->month($monthnum)->format('F');
        
        // $this->createcufoff($monthName);

         $data = DB::select(
                        "
                        SELECT [id]
                            ,[Month]
                            ,[StartDate]
                            ,[EndDate]
                        FROM [cutoff]
                        where [Month] = '". $monthName ."' and status = 'OPEN';
                        "
                    );
        return response()->json($data);
    }
    public function getemployeelist(Request $request)
    {
        $cutoffData = Cutoff::where('id',$request->cutoff)->get();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->lastOfMonth();
        $currentMonthName = Carbon::now()->format('F');
        $selectedEmployee = "";
        $cutOFF = CutOff::where('Month','=',$currentMonthName)->get();
        
        $ProcessStatus = "Unprocess";

        if(isset($cutOFF))
        {
            // $this->createcufoff('');
            $cutOFF = Cutoff::where('Month','=',$currentMonthName)->get();
        }
        $empcode = explode(':',$request->employeecode);
        $empcode = trim($empcode[1]);

        $employeeProcessed = Employee::where('employeenumber','=',$empcode)->get();
        
        if($cutoffData[0] != null)
        {
            $criteria = "where
                        dtr.date between '". $cutoffData[0]->StartDate ."' and '" . $cutoffData[0]->EndDate ."'
                        and dtr.employee_code = ". $empcode."";
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::select($this->DTRQuery($criteria));
        }

        $CheckedProcess = "Select count(id) as 'RowCount' from daily_time_records where processedby = 1 and " .
                            "date between '". $cutoffData[0]->StartDate ."' and '" . 
                            $cutoffData[0]->EndDate ."'and employee_code = ". $empcode ."";
        
        $processeddata = DB::select($CheckedProcess);
        $processcount = $processeddata[0]->RowCount;

        if($processcount > 0)
            $ProcessStatus = 'Processed';

        $employeecode = $request->employeecode;
        
        if($employeeProcessed->count() > 0)
        {
            $selectedEmployee = $employeeProcessed[0]->lastname . ',' . $employeeProcessed[0]->firstname . ' ' .$employeeProcessed[0]->middlename;
        }
        $LastSearch = Carbon::now();
        

        return view('attendance.raw.index',compact('data','cutOFF','ProcessStatus','employeecode','selectedEmployee','LastSearch','empcode'));
    }
    private function UpdateDTRSummary($criteria)
    {
        return "
            Select
                cu.Month,
                cu.id as 'cutoffid',
                cu.StartDate,cu.EndDate,
                dtr.employee_code,
                emp.lastname + ',' + emp.firstname + ' ' + emp.middlename  as 'EmployeeName',
                CAST(SUM(dtr.WorkingHours) / 8 as DECIMAL(9,2)) as 'WorkingDays',
                SUM(dtr.WorkingHours) as 'WorkingHours',
                SUM(dtr.NightDiffHours) as 'NDHours',
                SUM(dtr.OTHours) as 'OTHours',
                SUM(dtr.Leaves) as 'Leaves',
                SUM(dtr.Absent) as 'Absent',
                SUM(dtr.Late) as 'Late',
                SUM(dtr.Undertime) as 'Undertime',
                ((select count(id) from holiday where date between cu.StartDate and cu.EndDate) * 8) as 'Holiday'
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
				left join payroll p on p.employeecode = emp.employeenumber 
                where [date] between cu.StartDate and cu.EndDate
                " . $Criteria . "
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename
                order by emp.lastname desc
        ";
    }
    private function DTRUpdate($criteria,$cutoff)
    {
        $activeUser = Auth::id();
        return "update 
                        daily_time_records 
                    set 
                        DType = 
                        (Case 
                            when (select count(id) from holiday where date = dtr.date) = 1 then 'HD'
                            when (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') > 0 then 'LD'
                            when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 then 'WD'
                            when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) = 1 then 'RD' 
                        else 
                            '' 
                        end),
                        Final_IN = convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108),
                        Final_OUT = convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108),
                        StartTime = (case when dws.GracePeriodMins > 0 then 
                    convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) 
                    when dws.GracePeriodMins = 0 then
                    convert(varchar,dws.StartTime,108) 
                    else convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) end),
                        EndTime = convert(varchar,dws.EndTime,108),
                        WorkingHours = isnull((case when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
                    convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) >= convert(varchar,dws.EndTime,108)
                    then 8 
                    when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
                    convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) >= convert(varchar,dws.EndTime,108)
                    then 
                    DATEDIFF(HOUR,convert(varchar,dws.EndTime,108),convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108))
                    when dws.GracePeriodMins = 0 or dws.GracePeriodMins is NULL then
                    Case 
                    when convert(varchar,dws.EndTime,108) <=  convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) and
                    convert(varchar,dws.StartTime,108) >= convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108)
                    then
                    8
                    when convert(varchar,dws.StartTime,108) < convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
                    convert(varchar,dws.EndTime,108) <=  convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
                    (DATEDIFF(minute, CAST(COALESCE(dtr.in_3,dtr.in_2,dtr.in_1) as DATETIME),dws.EndTime) / 60.0) - 1
                    when convert(varchar,dws.EndTime,108) > convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
                    DATEDIFF(minute,convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108), CAST(COALESCE(dtr.in_3,dtr.in_2,dtr.in_1) as DATETIME)) / 60.0 * -1
                    end
                    end),0.00),
                        NightDiffHours = 0,
                        OTHours = 0,
                        Leaves = (case when (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') > 0 then
                    8 else 0 end),
                        [Absent] = (case when (ISNULL(convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108),'') = '' or 
                    ISNULL(convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108),'') = '') and
                    (select count(id) from holiday where date = dtr.date) = 0 and 
                    (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 and 
                    (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') = 0 
                    then
                    8 else 0 end),
                        Late = isnull((Case when dws.GracePeriodMins = 0 and Convert(varchar,dws.StartTime,108) < convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) then
                    DateDIFF(MINUTE,convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108),Convert(varchar,dws.StartTime,108)) / 60.0 * -1
                    when dws.GracePeriodMins > 0 and convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) > convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) then
                    DateDIFF(MINUTE,convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108),convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108)) / 60.0
                    when dws.GracePeriodMins > 0 and convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) < convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) then
                    0							
                    end),0.00),
                        Undertime = isnull((case when  dws.EndTime > convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
                    DATEDIFF(HOUR,dws.EndTime,convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108)) / 60.0 * -1 
                    end),'0.00'),
                        CutOff = ".$cutoff.",
                        ProcessedBy = ".$activeUser.",
                        ProcessedDate = CURRENT_TIMESTAMP
                    from daily_time_records dtr left join
                    employees emp on dtr.employee_code = emp.employeenumber
                    left join defaultworkschedule dws on emp.WorkDays = dws.id
                            " . $criteria;
    }
    public function DTRQuery($criteria)
    {
        return "
            select dtr.id,dtr.employee_code,concat(emp.lastname,',',emp.firstname, ' ' , Left(emp.middlename,1)) as Employee,dtr.date,LEFT(Datename(WEEKDAY,dtr.date),3) as 'Day',
                        (Case 
                            when (select count(id) from dtrcorrection where date = dtr.date and status = 'Approved') = 1 then 'WDCOR'
                            when (select count(id) from holiday where date = dtr.date) = 1 then 'HD'
                            when (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') > 0 then 'LD'      
                            when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 and dtr.DType <> 'WDCOR' then 'WD'
                            when (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) = 1 then 'RD' 
                                else dtr.DType end)as RestDay,
                        convert(varchar, dtr.in_1, 108) as 'TimeIN',convert(varchar, dtr.in_2, 108) as 'TimeIN_2',convert(varchar, dtr.in_3, 108) as 'TimeIN_3',
                        convert(varchar, dtr.out_1, 108) as 'TimeOUT',convert(varchar, dtr.out_2, 108) as 'TimeOUT_2',convert(varchar, dtr.out_3, 108) as 'TimeOUT_3',
                        convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) as 'Final_IN',
                        convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) as 'Final_OUT',
                        (case 
                         when dws.GracePeriodMins > 0 then 
							convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) 
						 when dws.GracePeriodMins = 0 then
							convert(varchar,dws.StartTime,108) 
						 else convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) end) as 'StartTime',
                            convert(varchar,dws.EndTime,108) as 'EndTime',
                       (case 
                        when (dtr.DType = 'WDCOR' and (select count(id) from dtrcorrection where date = dtr.date and status = 'Approved') = 1) then 8
                        when (dtr.DType = 'WDCOR' and (select count(id) from dtrcorrection where date = dtr.date and status = 'Approved') = 0) then 0
                        when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
                                convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) >= convert(varchar,dws.EndTime,108)
                                then 8 
                                when convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) > convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
                                convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) >= convert(varchar,dws.EndTime,108)
                                then 
                                    DATEDIFF(HOUR,convert(varchar,dws.EndTime,108),convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108))
                        when dws.GracePeriodMins = 0 or dws.GracePeriodMins is NULL then
                            Case 
							when convert(varchar,dws.EndTime,108) <=  convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) and
								 convert(varchar,dws.StartTime,108) >= convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108)
							then
                                8
							when convert(varchar,dws.StartTime,108) < convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) and
								convert(varchar,dws.EndTime,108) <=  convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
								(DATEDIFF(minute, CAST(COALESCE(dtr.in_3,dtr.in_2,dtr.in_1) as DATETIME),dws.EndTime) / 60.0) - 1
                            when convert(varchar,dws.EndTime,108) > convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
                                DATEDIFF(minute,convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108), CAST(COALESCE(dtr.in_3,dtr.in_2,dtr.in_1) as DATETIME)) / 60.0 * -1
                            end
                        end) as 'WorkingHours',
                        0 as 'NDHours',
                        0 as 'ND8Hours',
                        0 as 'OTHours',
                        case when (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') > 0 then
                        8 else 0 end as 'Leave',
                        0 as 'OT8Hours',
                        case when (ISNULL(convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108),'') = '' or 
								  ISNULL(convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108),'') = '') and 
                                  (select count(id) from holiday where date = dtr.date) = 0 and 
								  (select count(id) from restday where employee_id = emp.id and isActive = 1 and RestDay = Datename(WEEKDAY,dtr.date)) =  0 and 
								  (select count(id) from leaves lvs where EmpCode = emp.id and lvs.isActive = 1 and dtr.date between lvs.StartDate and lvs.EndDate and lvs.Status = 'Approved') = 0 
						then
                        8 else 0 end as 'Absent',
                        Case when dws.GracePeriodMins = 0 and Convert(varchar,dws.StartTime,108) < convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) then
							DateDIFF(MINUTE,convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108),Convert(varchar,dws.StartTime,108)) / 60.0 * -1
						when dws.GracePeriodMins > 0 and convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) > convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) then
							DateDIFF(MINUTE,convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108),convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108)) / 60.0
						when dws.GracePeriodMins > 0 and convert(varchar,COALESCE(dtr.in_3,dtr.in_2,dtr.in_1),108) < convert(varchar,DateADD(MINUTE,dws.GracePeriodMins,dws.StartTime),108) then
						    0							
						end as 'Late',
                        (case when  dws.EndTime > convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108) then
						  DATEDIFF(HOUR,dws.EndTime,convert(varchar,COALESCE(dtr.out_3,dtr.out_2,dtr.out_1),108)) / 60.0 * -1 
						end) as 'Undertime'
                        from daily_time_records dtr left join
                        employees emp on dtr.employee_code = emp.employeenumber
                        left join defaultworkschedule dws on emp.WorkDays = dws.id
            " . $criteria;
    }
    public function getEmployeeDTRData($empnum)
    {
        $cutoffData = Cutoff::where('id',$empnum)
                              ->where('status','OPEN')->get();

        if($cutoffData[0] != null)
        {
            //$data = DailyTimeRecord::whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            $data = DB::table('daily_time_records')
            ->LeftJoin('employees','daily_time_records.employee_code','=','employees.employeenumber')
            ->select('daily_time_records.employee_code','employees.lastname','employees.firstname','employees.middlename')
            ->whereBetween("date",[$cutoffData[0]->StartDate,$cutoffData[0]->EndDate])
            ->distinct()
            ->get();
        }

        return response()->json($data);
    }
    public function createcufoff(Request $request)
    {
        $monthName = Carbon::create()->month($request->monthfilter)->format('F');
     
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
            return back()->with('success', 'Cut-off creation done! ');
        }catch(Exception $e)
        {
            return back()->with('error', 'Cut-off creation failed! '. $e->getMessage());
        }
    }
    public function ProcessPayroll($cutoff,$empcode)
    {
        $CutOFF = Cutoff::find($cutoff);
        $StartDate = ($CutOFF->StartDate);
        $EndDate = ($CutOFF->EndDate);   
        $Criteria = "where 
	dtr.date between '" . $StartDate . "' and '".$EndDate."' and
	dtr.employee_code = '".$empcode."'";

        // $Criteria = "where 
        //     dtr.date between '?' and '?' and
        //     dtr.employee_code = '?'";

        $data = DB::statement($this->DTRUpdate($Criteria,$cutoff));


        $recordFound = DB::select("
                                SELECT count(id) as 'RecordFound'
                                FROM summary_attendance
                                where employeecode = '".$empcode."' and
                                StartDateCutoff = '".$StartDate."' and 
                                EndDateCutoff = '".$EndDate."'"
                            );
                            
        if($recordFound[0]->RecordFound > 0)
        {
            //Append
            DB::statement($this->UpdateQuery($Criteria));
        }else
        {
            //Insert
            DB::statement($this->InsertQuery($Criteria));
        }

        return response()->json($data);
    }
    public function UpdateQuery($criteria)
    {
        return "
                    Update summary_attendance
            set 
                SummaryKey = Grouped.SummaryKey,
                StartDateCutoff = Grouped.StartDate,
                EndDateCutoff = Grouped.EndDate,
                RequiredWorkingHours = 0,
                WorkHours = Grouped.WorkingHours,
                NDHours = Grouped.NDHours,
                OTHours = Grouped.OTHours,
                Absent = Grouped.Absent,
                Late = Grouped.Late,
                Undertime = Grouped.Undertime,
                Holiday = Grouped.Holiday,
                updated_at = CURRENT_TIMESTAMP
            FROM 
                (Select
                Concat(dtr.employee_code,cu.StartDate,cu.EndDate) as 'SummaryKey',
                dtr.employee_code as 'employee_code',
                cu.StartDate as 'StartDate',
                cu.EndDate as 'EndDate', 
                0 as 'RequiredWorkingHours',
                SUM(dtr.WorkingHours) as 'WorkingHours',
                CAST(SUM(dtr.WorkingHours) / 8 as DECIMAL(9,2)) as 'WorkingDays',
                SUM(dtr.NightDiffHours) as 'NDHours',
                SUM(dtr.OTHours) as 'OTHours',
                SUM(dtr.Leaves) as 'Leaves',
                SUM(dtr.Absent) as 'Absent',
                SUM(dtr.Late) as 'Late',
                SUM(dtr.Undertime) as 'Undertime',
                ((select count(id) from holiday where date between cu.StartDate and cu.EndDate) * 8) as 'Holiday'
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
                left join payroll p on p.employeecode = emp.employeenumber 
                --where [date] between cu.StartDate and cu.EndDate 
                ".$criteria."                
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename) as Grouped
                where summary_attendance.employeecode = Grouped.employee_code and 
                summary_attendance.StartDateCutoff = Grouped.StartDate and summary_attendance.EndDateCutoff = Grouped.EndDate
        ";
    }
    public function InsertQuery($criteria)
    {
        return "
        insert into summary_attendance 
            ([SummaryKey],[employeecode],[StartDateCutoff],[EndDateCutoff],[RequiredWorkingHours],[WorkHours]
                ,[NDHours],[ND8Hours],[OTHours],[OT8Hours],[Absent],[Late],[Undertime],[Holiday],[created_at])
            Select
                Concat(dtr.employee_code,cu.StartDate,cu.EndDate) as 'SummaryKey',
                dtr.employee_code,
                cu.StartDate,
                cu.EndDate,
                0 as 'RequiredWorkingHours',
                SUM(dtr.WorkingHours) as 'WorkingHours',
                CAST(SUM(dtr.WorkingHours) / 8 as DECIMAL(9,2)) as 'WorkingDays',
                SUM(dtr.NightDiffHours) as 'NDHours',
                SUM(dtr.OTHours) as 'OTHours',
                SUM(dtr.Leaves) as 'Leaves',
                SUM(dtr.Absent) as 'Absent',
                SUM(dtr.Late) as 'Late',
                SUM(dtr.Undertime) as 'Undertime',
                ((select count(id) from holiday where date between cu.StartDate and cu.EndDate) * 8) as 'Holiday',
                CURRENT_TIMESTAMP
                FROM 
                    daily_time_records dtr
                left join employees emp on dtr.employee_code = emp.employeenumber
                left join cutoff cu on dtr.cutoff = cu.id
                left join payroll p on p.employeecode = emp.employeenumber 
                --where [date] between cu.StartDate and cu.EndDate  
                ". $criteria ."               
                group by 
                    cu.Month,cu.id,cu.StartDate,cu.EndDate,dtr.employee_code,emp.lastname,emp.firstname,emp.middlename
        ";
    }
    public function downloadFileTemplate()
    {
        $filename = "DTRTemplate.xls";
        $path = storage_path("app/public/template/{$filename}");

        try {
            
            return response()->download($path, $filename, [
            'Content-Type' => 'application/text',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to download the file.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}