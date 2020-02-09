<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            ]
        ]);
        factory(User::class,10)->create();
    }
}
