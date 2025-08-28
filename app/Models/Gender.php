<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends Model
{

    protected $table = 'gender';

    protected $fillable = [
        'gender','isActive'
    ];
    

}
