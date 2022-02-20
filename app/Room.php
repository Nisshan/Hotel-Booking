<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



/**
 * Class Room
 * @package App
 */
class Room extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }

    /**
     * @return HasMany
     */
    public function booking()
    {
        return $this->hasMany(BookRoom::class,'room_id')->where('status',1);
    }
}
