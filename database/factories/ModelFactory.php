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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence(mt_rand(3, 5)),
        'dob'   => $faker->date('Y-m-d'),
        'phone' => $faker->phoneNumber,
        'gender' => $faker->randomElement(['male','female']),
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Date::class, function(Faker\Generator $faker) {

    $users = App\User::all()->lists('id')->toArray();

   return [
       'description'    => $faker->sentence(mt_rand(3, 5)),
       'time'           => $faker->unixTime(),
       'location_name'  => $faker->randomElement(['Home','Park','Builder']),
       'state'          => $faker->randomElement(['active','pending','completed']),
       'owner_id'       => $faker->randomElement($users)
   ];
});
