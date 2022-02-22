<?php

namespace App;

use Database\Factories\ImageGalleryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\ImageGallery
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $photo_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static ImageGalleryFactory factory(...$parameters)
 * @method static Builder|ImageGallery newModelQuery()
 * @method static Builder|ImageGallery newQuery()
 * @method static Builder|ImageGallery query()
 * @method static Builder|ImageGallery whereCreatedAt($value)
 * @method static Builder|ImageGallery whereDescription($value)
 * @method static Builder|ImageGallery whereId($value)
 * @method static Builder|ImageGallery wherePhotoBy($value)
 * @method static Builder|ImageGallery whereTitle($value)
 * @method static Builder|ImageGallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImageGallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
}
