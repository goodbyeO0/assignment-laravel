<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject_seed = [
            ['subject_code' => 'MAT101', 'subject_name' => 'Foundation Mathematics', 'lecturer_name' => 'Sir Abu'],
            ['subject_code' => 'LKT102', 'subject_name' => 'Introduction to Engineering Drawing', 'lecturer_name' => 'Sir Ahmad'],
            ['subject_code' => 'BIO103', 'subject_name' => 'Introduction to Biology', 'lecturer_name' => 'Sir Ali'],
            ['subject_code' => 'PHY104', 'subject_name' => 'Introduction to Physics', 'lecturer_name' => 'Sir Amin'],
            ['subject_code' => 'CHM105', 'subject_name' => 'Introduction to Chemistry', 'lecturer_name' => 'Sir Aziz'],
        ];

        foreach ($subject_seed as $subject) {
            Subject::firstOrCreate($subject);
        }
    }
}
