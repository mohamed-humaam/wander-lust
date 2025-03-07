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

    protected $fillable = ['name', 'icon', 'description', 'parent_id'];
    protected $casts = ['description' => 'array'];

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
}
