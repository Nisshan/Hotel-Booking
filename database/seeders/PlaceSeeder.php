<?php

namespace Database\Seeders;
use App\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $places = Place::factory()->count(10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($places as $place){
            $place->addMediaFromUrl($imageUrl)->toMediaCollection('places');
        }
        foreach ($places as $place){
            $place->addMediaFromUrl($imageUrl)->toMediaCollection('place-cover');
        }
    }
}
