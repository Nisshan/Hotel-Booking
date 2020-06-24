<?php

use App\Service;
use Illuminate\Database\Seeder;

/**
 * Class ServiceSeeder
 */
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = factory(Service::class,10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($services as $service){
            $service->addMediaFromUrl($imageUrl)->toMediaCollection('services');
        }
    }
}
