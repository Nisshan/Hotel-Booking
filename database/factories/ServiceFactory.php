<?php

namespace Database\Factories;

use App\Service;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'user_id' => User::all()->random()->id,
            'slug' => $this->faker->slug,
        ];
    }
}
