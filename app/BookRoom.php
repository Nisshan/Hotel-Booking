<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * Class BookRoom
 * @package App
 */
class BookRoom extends Model
{
    use HasFactory;
    /**
     * @return BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
