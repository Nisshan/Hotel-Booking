<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use App\User;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['Single Room', 'Double Room', 'Triple Room','Common Room']),
        'description' => $faker->sentence,
        'facilities' => $faker->sentence,
        'user_id' => User::all()->random()->id,
        'price' => rand(800,2500),
        'capacity' => rand(2,6),
        'room_no' => $faker->unique()->numberBetween(1,10),
        'slug' => $faker->slug
    ];
});
