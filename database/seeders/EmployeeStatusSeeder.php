<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeStatus;
use Illuminate\Support\Facades\DB;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('employee_status')->truncate();

      EmployeeStatus::create([
            'employeestatus' => 'Regular',],);
      EmployeeStatus::create([
            'employeestatus' => 'Terminated',
      ],);
    }
}
