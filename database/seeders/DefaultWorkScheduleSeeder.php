<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DefaultWorkSchedule;

class DefaultWorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefaultWorkSchedule::create([
            'KeySchedule'=> 'AM',
            'StartTime' => '07:00',
            'EndTime'=>'16:00',
            'GracePeriodMins'=>30,
            'isActive' => 1,
        ]);
        DefaultWorkSchedule::create([
            'KeySchedule'=>'PM',
            'StartTime' => '19:00:00',
            'EndTime'=>'04:00:00',
            'GracePeriodMins'=>30,
            'isActive' => 1,
        ]);
    }
}
