<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageGallery;
use Faker\Generator as Faker;

$factory->define(ImageGallery::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence,
        'photo_by' => $faker->name,
    ];
});
