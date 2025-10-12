<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{

    protected $table = 'payroll';

    protected $fillable = [
        'PayrollKey','EmployeeCode','Cutoff_id','TotalWorkingDays',
            'TotalWorkingHours','RegularOTHours','BasicPay','RegularOTPay',
            'SundayRestDayOT','SRDOTExceedingHours','LegalOT','LOTExceedingHours',
            'SpecialNonWorkingOT','SPNWExceedinHours','DayOffLegalOT','DOLOExceedingHours',
            'DayOffSpecialOT','DOSOExceedingHours','NightDiff','AllowanceTaxable',
            'AllowanceECola','OthersTaxable','OtherNonTaxable2','OtherNonTaxable3',
            'Adjustment','Others','Absences','HalfDay','Lates','Undertime','SSS','PHILHEALTH',
            'HDMF','TAX','SSSLoans','HDMFLoans','OtherLoans','Status','PreparedBy','PreparedDate',
            'ApprovedBy','ApprovedDate','TotalEarnings','TotalDeductions','NetAmount'
    ];
    
            

}
