<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    use HasFactory;

    protected $table = 'payment_types';
    protected $primaryKey = 'payment_type_id';
    protected $guarded = [];
    

// public function payments() :BelongsTo
// {
//     return $this->belongsTo(Payment::class);
// }

public function payments() :HasMany
{
    return $this->hasMany(Payment::class, 'payment_type_id', 'payment_type_id');
}

}
