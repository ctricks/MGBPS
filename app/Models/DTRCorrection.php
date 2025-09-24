<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DTRCorrection extends Model
{
    use HasFactory;

    protected $table = 'dtrcorrection';

    protected $fillable = [
            'dtrcorrectionkey',
            'employeecode',
            'date',
            'IN',
            'OUT',
            'DType',
            'Remarks',
            'CreatedBy',
            'ApprovedBy',
            'ApprovedDate',
            'Status',
    ];
}
