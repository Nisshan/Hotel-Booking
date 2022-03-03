<?php

namespace App;

use Database\Factories\TestimonialFactory;
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
 * Class Testimonial
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static TestimonialFactory factory(...$parameters)
 * @method static Builder|Testimonial newModelQuery()
 * @method static Builder|Testimonial newQuery()
 * @method static Builder|Testimonial query()
 * @method static Builder|Testimonial whereCreatedAt($value)
 * @method static Builder|Testimonial whereDescription($value)
 * @method static Builder|Testimonial whereId($value)
 * @method static Builder|Testimonial whereName($value)
 * @method static Builder|Testimonial whereStatus($value)
 * @method static Builder|Testimonial whereUpdatedAt($value)
 * @method static Builder|Testimonial whereUserId($value)
 * @mixin \Eloquent
 */
class Testimonial extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->height(200)
            ->width(200);
    }
}
