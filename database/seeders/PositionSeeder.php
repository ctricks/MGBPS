<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('positions')->truncate();

      Position::create([
            'positionname' => 'Staff',],);
      Position::create([
            'positionname' => 'Manager',
      ],);
    }
}
