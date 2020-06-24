<?php

use App\Testimonial;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class TestimonialSeeder
 */
class TestimonialSeeder extends Seeder implements HasMedia
{
    use HasMediaTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $testimonies = factory(Testimonial::class,10)->create();
        $imageUrl = 'https://i.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI';
        foreach ($testimonies as $testimony){
            $testimony->addMediaFromUrl($imageUrl)->toMediaCollection('testimony');
        }
    }
}
