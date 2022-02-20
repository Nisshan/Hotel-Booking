<?php

namespace Database\Seeders;

use App\ImageGallery;
use Illuminate\Database\Seeder;

class ImageGallerySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $images = ImageGallery::factory()->count(10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($images as $image) {
            $name = substr(md5(rand()), 0, 10);
            $image->addMediaFromUrl($imageUrl)->usingName($name)->toMediaCollection('gallery');
        }
    }
}
