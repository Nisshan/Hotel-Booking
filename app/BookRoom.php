<?php

namespace App;

use Database\Factories\BookRoomFactory;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class BookRoom
 *
 * @package App
 * @property int $id
 * @property DateTime $from
 * @property DateTime $to
 * @property string $email
 * @property string $number
 * @property string $name
 * @property string $address
 * @property int $room_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Room|null $room
 * @method static BookRoomFactory factory(...$parameters)
 * @method static Builder|BookRoom newModelQuery()
 * @method static Builder|BookRoom newQuery()
 * @method static Builder|BookRoom query()
 * @method static Builder|BookRoom whereAddress($value)
 * @method static Builder|BookRoom whereCreatedAt($value)
 * @method static Builder|BookRoom whereEmail($value)
 * @method static Builder|BookRoom whereFrom($value)
 * @method static Builder|BookRoom whereId($value)
 * @method static Builder|BookRoom whereName($value)
 * @method static Builder|BookRoom whereNumber($value)
 * @method static Builder|BookRoom whereRoomId($value)
 * @method static Builder|BookRoom whereStatus($value)
 * @method static Builder|BookRoom whereTo($value)
 * @method static Builder|BookRoom whereUpdatedAt($value)
 * @mixin Eloquent
 */
class BookRoom extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $casts = [
        'from' => 'datetime',
        'to'   => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
