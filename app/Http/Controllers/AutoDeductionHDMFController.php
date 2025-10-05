<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoDeductionHDMFController extends Controller
{
    //
    public function index()
    {
        //
        //$data = Leave::orderBy('id','DESC')->get();
        $data = DB::select(
            "select 
                a.id,
                a.EmployeeCode,
                e.lastname + ',' + e.firstname + ' ' + e.middlename as 'EmployeeName',
                a.AD_Date as 'DeductionDate',
                cu.StartDate,
                cu.EndDate,
                a.DeductionName,
                a.Amount, 
                a.DateProcess,
                u.Name as 'ProcessedBy'
                from autodeduction a
                left join employees e on a.EmployeeCode = e.employeenumber
                left join cutoff cu on a.AD_Date between cu.StartDate and cu.EndDate
                left join users u on u.id = a.ProcessedBy
                where 
                cu.Status = 'OPEN' and a.DeductionName = 'HDMF'
            order by 
                a.id desc;"
        );
        
        return view('deduction.autodeduction.HDMF.index', compact('data'));
    }
    public function processAutoDeduction()
    {
        $data = DB::insert($this->UpdateHDMF());
    }
    private function UpdateHDMF()
    {
        return "insert into autodeduction(autodeductionkey,EmployeeCode,AD_Date,DeductionName,Amount,PaidAmount,DateProcess,ProcessedBy,Remarks)
                select 
                Concat('HDMF' , '_' , d.employee_code , '_' , cu.EndDate) as 'DeductionKey',
                d.employee_code,
                cu.EndDate,
                'HDMF' as DeductionName,
                200.00 as Amount,
                200.00 as PaidAmount,
                GETDATE() as DateProcess,
                -1 as 'PreparedBy',
                'Auto Deduction for HDMF' as 'Remarks'
                from 
                daily_time_records d
                left join cutoff cu on d.date between cu.StartDate and cu.EndDate and cu.Status = 'OPEN' 
                where 
                datepart(d, cu.EndDate) = 15 and 
                (select count(id) from autodeduction where autodeductionkey = Concat('HDMF' , '_' , d.employee_code , '_' , cu.EndDate)) = 0
                group by 
                d.employee_code,cu.EndDate";
    }
}
