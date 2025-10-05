<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OvertimeType;
use Illuminate\Support\Facades\DB;

class OvertimeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('overtimetype')->truncate();

      OvertimeType::create([
            'overtimetype' => 'REGOT',
            'description' =>'Regular OT',
            'OTMultiplier' => 1.25,
      ],);
      OvertimeType::create([
            'overtimetype' => 'SNWHOLOT',
            'description' =>'Special NW Holiday OT',
            'OTMultiplier' => 1.30
      ],);
      OvertimeType::create([
            'overtimetype' => 'RHOLOT',
            'description' =>'Regular Holiday OT',
            'OTMultiplier' => 2
      ],);
      OvertimeType::create([
            'overtimetype' => 'RDOT',
            'description' =>'RestDay OT',
            'OTMultiplier' => 1.30
      ],);
      OvertimeType::create([
            'overtimetype' => 'RHRDOT',
            'description' =>'Regular Holiday RestDay OT',
            'OTMultiplier' => 1.30
      ],);
      OvertimeType::create([
            'overtimetype' => 'SHRDOT',
            'description' =>'Special Holiday RestDay OT',
            'OTMultiplier' => 1.30
      ],);
    }
}
