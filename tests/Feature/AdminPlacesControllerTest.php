<?php

use App\Place;
use Database\Seeders\AbilitiesSeeder;
use Database\Seeders\UserTableSeeder;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (){
    $this->seed(UserTableSeeder::class);
    $this->seed(AbilitiesSeeder::class);
});

test('authorized user can view places list', function (){
   login(admin());
   $this->get('/admin/places')
       ->assertStatus(200);
});


test('unauthorized user are redirected to 401', function (){
    login();
    $this->get('/admin/places')
        ->assertStatus(401);
});


test('authorized user can add new place', function (){
    login(admin());
    $this->get('/admin/places/create')
        ->assertStatus(200);
});

test('new places can be stored', function (){
    login(admin());

    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.jpg');

    $attributes = [
        'name' => 'Itahari',
        'slug' => 'itahari',
        'cover' => $file,
        'description' => 'Good place to be',
        'travel_description' => 'Easy bus access',
        'user_id' => auth()->id()
    ];

     $this->post(route('places.store'), $attributes)
         ->assertSessionDoesntHaveErrors()
        ->assertRedirect(route('places.index'));

     expect(Media::count())->toBe(1);
     expect(Place::count())->toBe(1);
     assertDatabaseHas('places', Arr::except($attributes, ['cover']));

});

