<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $table="overtime";

    protected $fillable = [
        'OvertimeKey','EmployeeCode','OTDate','ActualIN','ActualOUT','ActualOTHours','OTHoursApproved','FiledOTHours',
        'Remarks','OverTimeTypeID','CreatedBy','ApprovedBy','Status','Multiplier','HourlyRate','OTPay'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function overtimetype()
    {
        return $this->belongsTo(OvertimeType::class);
    }
}