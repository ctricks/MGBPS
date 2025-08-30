<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CivilStatus;
use Illuminate\Support\Facades\DB;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('civil_status')->truncate();

        //
        CivilStatus::create([
            'civilstatus' => 'Single',
        ],);
        CivilStatus::create([
            'civilstatus' => 'Married',
      ],);
    }
}
