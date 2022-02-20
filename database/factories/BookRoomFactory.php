<?php

namespace Database\Factories;

use App\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\BookRoom;

class BookRoomFactory extends Factory
{
    protected $model = BookRoom::class;

    public function definition()
    {
        return [
            'from' => Carbon::now('+05:45'),
            'to' => Carbon::now('+05:45')->addDay(),
            'email' => $this->faker->safeEmail,
            'number' => $this->faker->phoneNumber,
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'room_id' => Room::all()->random()->id,
            'status' => rand(0, 1)
        ];
    }
}
