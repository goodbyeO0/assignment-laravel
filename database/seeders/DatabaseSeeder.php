<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DaySeeder::class,
            SubjectSeeder::class,
            HallSeeder::class,
            GroupSeeder::class
        ]);
    }
}
