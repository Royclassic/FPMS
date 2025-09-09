<?php

use     App\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('students')->truncate();
        DB::table('supervisors')->truncate();
        $this->call(FacultySeeder::class);

        $this->call(ThemeSettingsTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(EmailSettingSeeder::class);
        $this->call(OrganisationSettingsTableSeeder::class);
        $user = factory(App\User::class, 30)->create();
        Schema::enableForeignKeyConstraints();
        $user->each(function ($user, $index) {

            if (substr($user->admission_staff_no, 0, 2) == 'PF') {
                if ($index < 10) {
                    $user->roles()->attach(2);
                    $supervisor = new \App\Supervisor();
                    $supervisor->user_id = $user->id;
                    $supervisor->save();
                } else {
                    $user->admission_staff_no = 'CIT-223' . substr($user->admission_staff_no, 2);
                    $user->roles()->attach(3);
                    $courses = \App\Course::where('faculty_id', $user->faculty_id)->get()->random()->id;
                    $user->course_id = $courses;
                    $user->save();
                    $student = new \App\Student();
                    $student->user_id = $user->id;
                    $student->save();
                }
            } else {
                //assign students course in their faculty
                $courses = \App\Course::where('faculty_id', $user->faculty_id)->get()->random()->id;
                $user->course_id = $courses;
                $user->roles()->attach(3);
                $user->save();
                $student = new \App\Student();
                $student->user_id = $user->id;
                $student->save();
            }
        });
    }

}
