<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'slug', 'images', 'description', 'parent_id'];
    protected $casts = ['images' => 'array', 'description' => 'array'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function roomLinks(): BelongsToMany
    {
        return $this->belongsToMany(RoomLink::class, 'room_links');
    }
}
