<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
     protected $table = 'loan';

     protected $casts = [
                            'LoanDate' => 'datetime',
                        ];

     protected $fillable = [
        'Employeeid','LoanType','LoanDate','Amount','NoOfPayment','AmountDeduction','SemiMonthlyInterest',
        'Status','ApprovedBy','ApprovedDate','CreatedBy','isActive'
    ];
}
