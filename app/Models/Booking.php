<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    public function hotels(): BelongsTo 
    {
        return $this->belongsTo(Hotel::class);
    }
}
