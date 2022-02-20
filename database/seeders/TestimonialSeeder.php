<?php

namespace Database\Seeders;


use App\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Class TestimonialSeeder
 */
class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
       $testimonies = Testimonial::factory()->count(10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($testimonies as $testimony){
            $testimony->addMediaFromUrl($imageUrl)->toMediaCollection('testimony');
        }
    }
}
