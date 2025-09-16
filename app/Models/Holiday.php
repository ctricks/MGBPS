<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table = 'Holiday';
    protected $fillable = [
        'HolidayKey','Year','HolidayName','Date','HolidayType','isActive','UpdatedDate','UpdatedBy','CreatedBy']; 

}
