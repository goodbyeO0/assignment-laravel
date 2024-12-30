<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['day_name' => 'Monday'],
            ['day_name' => 'Tuesday'],
            ['day_name' => 'Wednesday'],
            ['day_name' => 'Thursday'],
            ['day_name' => 'Friday'],
            ['day_name' => 'Saturday'],
            ['day_name' => 'Sunday']
        ];

        foreach ($days as $day) {
            Day::firstOrCreate($day);
        }
    }
}
