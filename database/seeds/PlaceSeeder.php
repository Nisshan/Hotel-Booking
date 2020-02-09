<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = factory(Place::class,10)->create();
        $imageUrl = 'https://i.picsum.photos/id/237/200/300.jpg';
        foreach ($places as $place){
            $place->addMediaFromUrl($imageUrl)->toMediaCollection('places');
        }
        foreach ($places as $place){
            $place->addMediaFromUrl($imageUrl)->toMediaCollection('place-cover');
        }
    }
}
