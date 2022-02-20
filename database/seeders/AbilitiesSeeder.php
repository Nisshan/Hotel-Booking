<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\Bouncer;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abilities')->insert([
            [
                'name' => 'create_user',
                'title' => 'Create User',
                'sort-name' => 'user'
            ],
            [
                'name' => 'edit_user',
                'title' => 'Edit User',
                'sort-name' => 'user'
            ],
            [
                'name' => 'view_user',
                'title' => 'View User',
                'sort-name' => 'user'
            ],
            [
                'name' => 'delete_user',
                'title' => 'Delete User',
                'sort-name' => 'user'
            ],
            [
                'name' => 'create_role',
                'title' => 'Create Role',
                'sort-name' => 'role'
            ],
            [
                'name' => 'edit_role',
                'title' => 'Edit Role',
                'sort-name' => 'role'
            ],
            [
                'name' => 'view_role',
                'title' => 'View Role',
                'sort-name' => 'role'
            ],
            [
                'name' => 'delete_role',
                'title' => 'Delete Role',
                'sort-name' => 'role'
            ],
            [
                'name' => 'create_testimony',
                'title' => 'Create Testimony',
                'sort-name' => 'testimony'
            ],
            [
                'name' => 'edit_testimony',
                'title' => 'Edit Testimony',
                'sort-name' => 'testimony'
            ],
            [
                'name' => 'view_testimony',
                'title' => 'View Testimony',
                'sort-name' => 'testimony'
            ],
            [
                'name' => 'delete_testimony',
                'title' => 'Delete Testimony',
                'sort-name' => 'testimony'
            ],
            [
                'name' => 'create_room',
                'title' => 'Create Room',
                'sort-name' => 'room'
            ],
            [
                'name' => 'edit_room',
                'title' => 'Edit Room',
                'sort-name' => 'room'
            ],
            [
                'name' => 'view_room',
                'title' => 'View Room',
                'sort-name' => 'room'
            ],
            [
                'name' => 'delete_room',
                'title' => 'Delete Room',
                'sort-name' => 'room'
            ],
            [
                'name' => 'create_place',
                'title' => 'Create Place',
                'sort-name' => 'place'
            ],
            [
                'name' => 'edit_place',
                'title' => 'Edit Place',
                'sort-name' => 'place'
            ],
            [
                'name' => 'view_place',
                'title' => 'View Place',
                'sort-name' => 'place'
            ],
            [
                'name' => 'delete_place',
                'title' => 'Delete Place',
                'sort-name' => 'place'
            ],
            [
                'name' => 'create_service',
                'title' => 'Create Service',
                'sort-name' => 'service'
            ],
            [
                'name' => 'edit_service',
                'title' => 'Edit Service',
                'sort-name' => 'service'
            ],
            [
                'name' => 'view_service',
                'title' => 'View Service',
                'sort-name' => 'service'
            ],
            [
                'name' => 'delete_service',
                'title' => 'Delete Service',
                'sort-name' => 'service'
            ],

        ]);

       DB::table('roles')->insert([
           'name' =>'Admin',
           'title' => 'Administrator'
       ]);
        $bouncer = Bouncer::create();
        $user = User::find(1);
        $user->assign('Admin');
        $bouncer->allow('Admin')->everything();


    }
}
