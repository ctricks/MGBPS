<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{

    // protected $table = 'employees';

    protected $fillable = [
        'employeenumber','lastname','firstname','middlename','Address','Telephone',
        'birthday','civil_status_id','gender_id','position_id','department_id','employee_status_id',
    ];
    

}
