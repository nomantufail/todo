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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('noman143'),
        'remember_token' => '',
    ];
});


$factory->define(App\Task::class, function ($faker) {

    $end_date = \Carbon\Carbon::now()->addDays(rand(1,3))->toDateString();

    return [
        'task' => $faker->realText(100),
        'start_date' => date('Y-m-d'),
        'end_date' => $end_date,
        'user_id' => rand(1,25),
    ];
});

$factory->define(App\Customer::class, function($faker){
    return [
        'name'=>$faker->name,
        'address' => $faker->address,
        'phone' =>$faker->phoneNumber
    ];
});