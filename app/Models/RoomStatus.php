<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomStatus extends Model
{
    use HasFactory;

    protected $table = 'room_statuses';
    protected $guarded = [];

    public function rooms(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'rooms_id', 'rooms_id');
    }
}
