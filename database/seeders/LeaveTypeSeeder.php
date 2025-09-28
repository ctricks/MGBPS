<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leave_type')->truncate();

        //
        LeaveType::create([
            'LeaveType' => 'VL',
            'Description' => 'Vacation Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'SL',
            'Description' => 'Sick Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'EL',
            'Description' => 'Emergency Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'HVL',
            'Description' => 'Half Day Vacation Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'HSL',
            'Description' => 'Half Day Sick Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'HEL',
            'Description' => 'Half Day Emergency Leave'
        ],);
        LeaveType::create([
            'LeaveType' => 'LWOP',
            'Description' => 'Leave Without Pay'
        ],);
        LeaveType::create([
            'LeaveType' => 'HDWP',
            'Description' => 'Half Day with Pay'
        ],);
    }
}
