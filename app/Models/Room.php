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

    protected $fillable = [
        'id',
        'name',
        'icon',
        'description',
        'parent_id',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'room_type_link_pivots');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'room_type_link_pivots');
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'room_type_link_pivots');
    }
}
