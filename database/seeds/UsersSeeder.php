<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// For password hashing

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $user = [
            'name' => 'Super Admin',
            'admission_staff_no' => 'admin@example.com',
            'email' => 'admin@example.com',
            'gender' => 'male',
            'image' => null,
            'mime' => 'png',
            'phone' => '0713676655',
            'year' => 2014,
            'passrec' => 1,
            'status' => 1,
            'password' => Hash::make('password'), // Hash the password before inserting
            'remember_token' => '5kPEffYDawUsLTENGNM44JwbNYrUcn3DQorm2dpUUvYCXs86zEpYljGMcVEV',
            'created_at' => null,
            'updated_at' => null,
        ];
        DB::table('users')->insert($user);
        DB::table('role_user')->truncate();
        $admin = \App\User::find(1);
        $admin->roles()->attach(2);
        $users = \App\User::all();
        foreach ($users as $user) {
            $user->roles()->attach(1);

        }

    }
}
