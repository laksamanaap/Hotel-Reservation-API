<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $guarded = [];


public function rooms() :HasOne 
{
    return $this->hasOne(Room::class, 'rooms_id', 'rooms_id');
}

public function payments_type() :BelongsTo
{
    return $this->belongsTo(PaymentType::class);
}

}
