<?php

namespace Database\Factories;

use App\Room;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Single Room', 'Double Room', 'Triple Room','Common Room']),
            'description' => $this->faker->sentence,
            'facilities' => $this->faker->sentence,
            'user_id' => User::all()->random()->id,
            'price' => rand(800, 2500),
            'capacity' => rand(2, 6),
            'room_no' => $this->faker->unique()->numberBetween(1, 10),
            'slug' => $this->faker->slug,
        ];
    }
}
