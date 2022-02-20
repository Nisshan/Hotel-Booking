<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


/**
 * Class Testimonial
 * @package App
 */
class Testimonial extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaConversions(Media $media = null):void
    {
        $this->addMediaConversion('thumb')
            ->height(200)
            ->width(200);
    }
}
