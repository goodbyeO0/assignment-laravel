<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $hall_seed = [
            ['lecture_hall_name' => 'Hall A', 'lecture_hall_place' => 'Fakulti Sains Komputer dan Matematik'],
            ['lecture_hall_name' => 'Hall B', 'lecture_hall_place' => 'Fakulti Perdagangan dan Perakaunan'],
            ['lecture_hall_name' => 'Hall C', 'lecture_hall_place' => 'Fakulti Sains Sosial dan Kemanusiaan'],
            ['lecture_hall_name' => 'Hall D', 'lecture_hall_place' => 'Fakulti Kejuruteraan'],
            ['lecture_hall_name' => 'Hall E', 'lecture_hall_place' => 'Fakulti Perubatan'],
        ];

        foreach ($hall_seed as $hall) {
            Hall::firstOrCreate($hall);
        }
    }
}
