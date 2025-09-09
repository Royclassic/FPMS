<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $roles = [
            [
                'name' => 'coordinator',
                'display_name' => 'Project Coordinator',
                'description' => 'Admin is allowed to manage everything of the app.',
                'created_at' => '2019-12-10 05:49:11',
                'updated_at' => '2019-12-10 05:49:11',
            ],
            [
                'name' => 'supervisor',
                'display_name' => 'Project Supervisor',
                'description' => 'Supervisor are assigned to students.',
                'created_at' => '2019-12-10 05:49:11',
                'updated_at' => '2019-12-10 05:49:11',
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'University students.',
                'created_at' => '2019-12-10 05:49:11',
                'updated_at' => '2019-12-10 05:49:11',
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
