<?php

namespace Database\Seeders;

use App\BookRoom;
use Illuminate\Database\Seeder;

/**
 * Class BookRoomSeeder
 */
class BookRoomSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        BookRoom::factory()->count(10)->create();
    }
}
