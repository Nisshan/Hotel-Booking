<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(ImageGallerySeeder::class);
         $this->call(TestimonialSeeder::class);
         $this->call(RoomSeeder::class);
         $this->call(PlaceSeeder::class);
         $this->call(AbilitiesSeeder::class);
         $this->call(ServiceSeeder::class);
         $this->call(BookRoomSeeder::class);

    }
}
