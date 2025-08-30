<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SummaryAttendance extends Model
{

    protected $table = 'raw_attendance';

    protected $fillable = [
        'AttendanceDate','EmployeeNumber','TimeIn','TimeOut','Source','Status','isActive'
    ];
    

}
