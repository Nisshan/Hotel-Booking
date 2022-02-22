<?php

namespace App;

use Database\Factories\RoomFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Room
 *
 * @package App
 * @property int $id
 * @property string $room_no
 * @property string $description
 * @property string $facilities
 * @property string $type
 * @property int $price
 * @property int $capacity
 * @property int $status
 * @property int $user_id
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|BookRoom[] $booking
 * @property-read int|null $booking_count
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static RoomFactory factory(...$parameters)
 * @method static Builder|Room newModelQuery()
 * @method static Builder|Room newQuery()
 * @method static Builder|Room query()
 * @method static Builder|Room whereCapacity($value)
 * @method static Builder|Room whereCreatedAt($value)
 * @method static Builder|Room whereDescription($value)
 * @method static Builder|Room whereFacilities($value)
 * @method static Builder|Room whereId($value)
 * @method static Builder|Room wherePrice($value)
 * @method static Builder|Room whereRoomNo($value)
 * @method static Builder|Room whereSlug($value)
 * @method static Builder|Room whereStatus($value)
 * @method static Builder|Room whereType($value)
 * @method static Builder|Room whereUpdatedAt($value)
 * @method static Builder|Room whereUserId($value)
 * @mixin Eloquent
 */
class Room extends Model implements HasMedia
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

    /**
     * @return HasMany
     */
    public function booking(): HasMany
    {
        return $this->hasMany(BookRoom::class, 'room_id')->where('status', 1);
    }
}
