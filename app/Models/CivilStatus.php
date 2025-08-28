<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CivilStatus extends Model
{

    protected $table = 'civil_status';

    protected $fillable = [
        'civilstatus','isActive'
    ];
    

}
