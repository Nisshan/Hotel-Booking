<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = factory(Room::class,10)->create();
        $imageUrl = 'https://i.picsum.photos/id/237/200/300.jpg';
        foreach ($images as $image){
            $image->addMediaFromUrl($imageUrl)->toMediaCollection('rooms');
        }
        foreach ($images as $image){
            $image->addMediaFromUrl($imageUrl)->toMediaCollection('room-cover');
        }
    }
}
