<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OvertimeType extends Model
{

    protected $table = 'overtimetype';

    protected $fillable = [
        'OvertimeType','Description','isActive'
    ];
    
    public function overtime()
    {
        return $this->belongsTo(OvertimeType::class);
    }

}
