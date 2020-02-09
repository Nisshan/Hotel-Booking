<?php

use App\BookRoom;
use Illuminate\Database\Seeder;

/**
 * Class BookRoomSeeder
 */
class BookRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BookRoom::class,10)->create();
    }
}
