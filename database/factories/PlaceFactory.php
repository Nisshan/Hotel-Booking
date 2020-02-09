<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Place;
use App\User;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' =>$faker->sentence,
        'travel_description' => $faker->sentence,
        'user_id' => User::all()->random()->id,

    ];
});
