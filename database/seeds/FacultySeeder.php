<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory; // Added for course name generation

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('faculties')->truncate();
        DB::table('courses')->truncate();
        $faculties = [
            'ICT' => [
                'Computer Science',
                'Software Engineering',
                'Database Management Systems',
                'Computer Networks',
                'Operating Systems',
                'Artificial Intelligence',
                'Cybersecurity',
                'Web Development',
                'Human-Computer Interaction (HCI)',
                'Computer Graphics',
                'Data Science',
            ],
            'Arts and Humanities' => [
                'Introduction to Literature',
                'History of Western Civilization',
                'Philosophy of Mind and Language',
            ],
            'Science' => [
                'General Biology',
                'Chemistry: Principles and Applications',
                'Calculus for the Life Sciences',
            ],
            'Social Sciences' => [
                'Introduction to Psychology',
                'Principles of Sociology',
                'Introduction to Political Science',
            ],
            'Engineering' => [
                'Introduction to Computer Science',
                'Engineering Mechanics: Statics',
                'Electrical Circuits',
            ],
            'Business' => [
                'Principles of Management',
                'Financial Accounting',
                'Marketing Principles',
            ],
            'Education' => [
                'Foundations of Education',
                'Curriculum Development and Instruction',
                'Educational Psychology',
            ],
            'Law' => [
                'Introduction to Law',
                'Constitutional Law',
                'Criminal Law',
            ],
            'Medicine' => [
                'Human Anatomy',
                'Physiology',
                'Biochemistry',
            ],
            'Pharmacy' => [
                'Pharmaceutical Chemistry',
                'Pharmacology',
                'Pharmaceutics',
            ],
            'Public Health' => [
                'Introduction to Public Health',
                'Epidemiology',
                'Biostatistics',
            ],
        ];

        foreach ($faculties as $facultyName => $courses) {
            $facultyId = DB::table('faculties')->insertGetId([
                'faculty' => $facultyName,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $courseData = [];
            foreach ($courses as $course) {
                $courseData[] = [
                    'faculty_id' => $facultyId,
                    'course' => $course,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            DB::table('courses')->insert($courseData);
        }
    }
}
