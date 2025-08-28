<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{

    protected $table = 'positions';

    protected $fillable = [
        'PositionName','Description','isActive'
    ];
    

}
