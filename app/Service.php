<?php

namespace App;

use Database\Factories\ServiceFactory;
use Eloquent;
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
 * Class Service
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $status
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static ServiceFactory factory(...$parameters)
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereDescription($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereSlug($value)
 * @method static Builder|Service whereStatus($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @method static Builder|Service whereUserId($value)
 * @mixin Eloquent
 */
class Service extends Model implements HasMedia
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
