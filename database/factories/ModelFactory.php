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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username'            => $faker->userName,
        'first_name'          => $faker->firstName,
        'last_name'           => $faker->lastName,
        'email'               => $faker->unique()->safeEmail,
        'description'         => $faker->realText(),
        'personal_website'    => 'http//example.com',
        'twitter_username'    => $faker->userName,
        'github_username'     => $faker->userName,
        'place_of_employment' => $faker->city,
        'job_title'           => $faker->jobTitle,
        'hometown'            => $faker->city,
        'password'            => $password ?: $password = bcrypt('secret'),
        'remember_token'      => str_random(10),
    ];
});
