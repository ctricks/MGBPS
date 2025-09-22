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
            'description' =>'Regular OT'
      ],);
      OvertimeType::create([
            'overtimetype' => 'HOLOT',
            'description' =>'Holiday OT'
      ],);
    }
}
