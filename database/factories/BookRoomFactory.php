<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookRoom;
use App\Room;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(BookRoom::class, function (Faker $faker) {
    return [
        'from' => Carbon::now('+05:45'),
        'to' => Carbon::now('+05:45')->addDay(),
        'email' => $faker->safeEmail,
        'number' => $faker->phoneNumber,
        'name' => $faker->name,
        'address' => $faker->address,
        'room_id' => Room::all()->random()->id,
        'status' => rand(0,1)
    ];
});
