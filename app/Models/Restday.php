<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restday extends Model
{

    protected $table = 'restday';

    protected $fillable = [
        'EmployeeCodeKey','employee_id','RestDay','Remarks','isActive'
    ];
    

}
