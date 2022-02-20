<?php
namespace Database\Factories;


use App\Testimonial;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'status' => 1,
            'user_id' => User::all()->random()->id
        ];
    }


}
