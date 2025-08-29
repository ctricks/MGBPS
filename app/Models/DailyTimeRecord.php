<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTimeRecord extends Model
{
    use HasFactory;

     protected $table = 'daily_time_records';
    
    protected $fillable = [
        'employee_code','date','in_1','out_1','in_2','out_2','in_3','out_3'
    ];
}
