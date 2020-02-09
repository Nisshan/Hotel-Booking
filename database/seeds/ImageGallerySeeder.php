<?php

use Faker\Factory as Faker;
use App\ImageGallery;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ImageGallerySeeder extends Seeder implements HasMedia
{
    use HasMediaTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $images = factory(ImageGallery::class,10)->create();
        $faker = Faker::create();
        $imageUrl = 'https://i.picsum.photos/id/237/200/300.jpg';
       foreach ($images as $image){
           $name = $faker->name;
           $image->addMediaFromUrl($imageUrl)->usingName($name)->toMediaCollection('gallery');
       }
    }
}
