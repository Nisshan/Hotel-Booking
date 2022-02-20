<?php

namespace Database\Factories;

use App\Place;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'description' => $this->faker->sentence,
            'travel_description' => $this->faker->sentence,
            'user_id' => User::all()->random()->id,
            'slug' => $this->faker->slug,
        ];
    }
}
