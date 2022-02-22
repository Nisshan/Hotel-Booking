<?php

namespace App;

use Database\Factories\PlaceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Place
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $travel_description
 * @property int $user_id
 * @property int $status
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static PlaceFactory factory(...$parameters)
 * @method static Builder|Place newModelQuery()
 * @method static Builder|Place newQuery()
 * @method static Builder|Place query()
 * @method static Builder|Place whereCreatedAt($value)
 * @method static Builder|Place whereDescription($value)
 * @method static Builder|Place whereId($value)
 * @method static Builder|Place whereName($value)
 * @method static Builder|Place whereSlug($value)
 * @method static Builder|Place whereStatus($value)
 * @method static Builder|Place whereTravelDescription($value)
 * @method static Builder|Place whereUpdatedAt($value)
 * @method static Builder|Place whereUserId($value)
 * @mixin \Eloquent
 */
class Place extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }
}
