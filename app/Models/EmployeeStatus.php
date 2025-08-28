<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeStatus extends Model
{

    protected $table = 'employee_status';

    protected $fillable = [
        'employeestatus','Description','isActive'
    ];
    

}
