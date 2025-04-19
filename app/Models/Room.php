<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'icon', 'images', 'description', 'price_per_night', 'size', 'capacity', 'parent_id'];
    protected $casts = [
        'description' => 'array',
        'images' => 'array',
        'size' => 'decimal:2',
        'capacity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Room::class, 'parent_id');
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'room_pivots');
    }

    public function roomLinks(): HasMany
    {
        return $this->hasMany(RoomLink::class);
    }

    public function getCategories()
    {
        return $this->roomLinks->map(function ($link) {
            return $link->category;
        })->unique('id');
    }

    public function getLocations()
    {
        return $this->roomLinks->map(function ($link) {
            return $link->location;
        })->unique('id');
    }
}
