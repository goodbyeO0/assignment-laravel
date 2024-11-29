<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day; // Add this line to import the Day model

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create(['day_name' => 'Monday']);
        Day::create(['day_name' => 'Tuesday']);
        Day::create(['day_name' => 'Wednesday']);
        Day::create(['day_name' => 'Thursday']);
        Day::create(['day_name' => 'Friday']);
        Day::create(['day_name' => 'Saturday']);
        Day::create(['day_name' => 'Sunday']);

        foreach ($day_seed as $day_seed)
        {
            Day::firstOrCreate($day_seed);
        }
    }
}
