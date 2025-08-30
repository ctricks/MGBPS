<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('departments')->truncate();

      Department::create([
            'departmentname' => 'Human Resources',],);
      Department::create([
            'departmentname' => 'MIS',
      ],);
    }
}
