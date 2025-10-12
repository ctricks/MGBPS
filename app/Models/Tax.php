<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'tax';

     protected $fillable = [
        'PayType','StartRange','EndRange','OverMinimum','AddPercent','AdditionalPay','UploadedBy','UpdatedBy','Year','isActive'
    ];
}
