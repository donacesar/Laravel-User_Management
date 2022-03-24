<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$jxZPMg6lIZHjuEfP/Kk0m.JILR6dAw4BpN2lMflmMjGPT/PvXQDbW', // 123
        'role' => 'user',
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Member::class, function(Faker $faker){
    return [
        'name' => $faker->name,
        'workplace' => $faker->company,
        'phone' => $faker->phoneNumber,
        'user_id' => factory(App\User::class)->create()->id,
        'address' => $faker->address,
        'status' => $faker->randomElement(['online', 'busy', 'away']),
        'avatar' => $faker->imageUrl(),
    ];
});
