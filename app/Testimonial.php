<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Testimonial
 * @package App
 */
class Testimonial extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $guarded = [];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->height(200)
            ->width(200);
    }
}
