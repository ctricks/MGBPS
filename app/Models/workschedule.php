<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workschedule extends Model
{
    use HasFactory;
    protected $table = 'defaultworkschedule';

    protected $fillable = [
        'KeySchedule','StartTime','EndTime','GracePeriodMins','isActive'
    ];
 
}
