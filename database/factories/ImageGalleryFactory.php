<?php

namespace Database\Factories;

use App\ImageGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageGalleryFactory extends Factory
{
    protected $model = ImageGallery::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'photo_by' => $this->faker->name,
        ];
    }
}
