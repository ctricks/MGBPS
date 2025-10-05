<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autodeduction extends Model
{
    use HasFactory;

    protected $table = 'autodeduction';

    protected $fillable = [
       'autodeductionkey','EmployeeCode','AD_Date','DeductionName','Amount','PaidAmount','DateProcess','ProcessedBy','Remarks'
    ];
}
