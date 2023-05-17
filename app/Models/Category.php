<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'categories_id';
    protected $guarded = [];

    public function rooms() :HasMany 
    {
        return $this->hasMany(Room::class, 'categories_id', 'categories_id');
    } 

    public function hotels() :BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
