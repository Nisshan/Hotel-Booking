<?php

namespace Database\Seeders;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
               'name' => 'Admin',
               'email' => 'superadmin@hotel.com',
               'email_verified_at' => Carbon::now(),
               'type' => 1,
               'password' => bcrypt('super@dmin'),
           ],
            [
                'name' => 'Operator',
                'email' => 'admin@hotel.com',
                'email_verified_at' => Carbon::now(),
                'type' => 1,
                'password' => bcrypt('h0tel@dmin'),
            ],
        ]);
        User::factory()->count(10)->create();
    }
}
