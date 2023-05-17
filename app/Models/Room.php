<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

}
