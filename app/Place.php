<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



/**
 * Class Place
 * @package App
 */
class Place extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }
}
