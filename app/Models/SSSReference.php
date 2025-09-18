<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSSReference extends Model
{
    use HasFactory;
    protected $table = 'sssreference';
    protected $fillable = [
        'StartRangeComp','EndRangeComp','EC','MPF','MSCTOTAL','EMPLOYERREGSSS','EMPLOYERMPF','EMPLOYEREC','EMPLOYERTOTAL',
        'EMPLOYEEREGSS','EMPLOYEEMPF','EMPLOYEETOTAL','TOTAL','CreatedBy'
    ]; 

}