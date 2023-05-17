<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $primaryKey = 'hotel_id';
    protected $guarded = [];

    public function categories(): HasMany 
    {
        return $this->hasMany(Category::class, 'hotel_id', 'hotel_id');
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class, 'hotel_id', 'hotel_id');
    }
}
