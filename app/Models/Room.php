<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'rooms_id';
    protected $guarded = [];

    public function categories() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings() :BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function room_statuses() :HasOne
    {
        return $this->hasOne(RoomStatus::class, 'rooms_id', 'rooms_id');
    }
}
