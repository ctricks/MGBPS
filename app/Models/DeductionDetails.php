<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'DeductionKey', 'DeductionDate','Deduction','DeductionType',
        'Amount', 'AmountPaid','DateDeducted','LoanReference','PayReference',
        'ProcessedBy', 'ProcessedDate','LoanDate'
    ];

}
