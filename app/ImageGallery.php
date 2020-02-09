<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class ImageGallery extends Model implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaConversions(Media $media = null )
    {
        $this->addMediaConversion('thumb')
            ->width('300')
            ->height('200');
    }

}
