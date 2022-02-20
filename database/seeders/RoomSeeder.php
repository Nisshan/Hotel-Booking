<?php

namespace Database\Seeders;

use App\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $images = Room::factory()->count(10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($images as $image) {
            $image->addMediaFromUrl($imageUrl)->toMediaCollection('rooms');
        }
        foreach ($images as $image) {
            $image->addMediaFromUrl($imageUrl)->toMediaCollection('room-cover');
        }
    }
}
