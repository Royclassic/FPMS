<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

    do {
        $randomNumber = rand(100, 9999); // This will generate a random number between 100 (3 digits) and 9999 (4 digits)
        $admission_staff_no = ['CIT-223-' . $randomNumber . '/2024', 'PF-' . $randomNumber . '/2024'][rand(0, 1)];
    } while (App\User::where('admission_staff_no', $admission_staff_no)->exists());

    do {
        $mobile = '+254713676' . rand(111, 999);
    } while (App\User::where('phone', $mobile)->exists());
    if (App\User::where('admission_staff_no', $admission_staff_no)->exists()) {
        return factory(App\User::class)->make();
    }

    return [
        'admission_staff_no' => $admission_staff_no,
        'phone' => $mobile,
        'faculty_id' => \App\Faculty::all()->random()->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'passrec' => 0,
        'status' => 1,
        'mime' => 'png',
        'remember_token' => str_random(10),
    ];
});
