<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Testimonial;
use App\User;
use Faker\Generator as Faker;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'status' => 1,
        'user_id' => User::all()->random()->id
    ];
});
