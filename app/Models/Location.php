<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'images',
        'gallery',
        'location',
        'description',
        'google_location',
    ];

    protected $casts = [
        'images' => 'array',
        'gallery' => 'array',
        'location' => 'array',
        'description' => 'array',
        'google_location' => 'array',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'amenity_link_pivots');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_link_pivots');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_type_link_pivots');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_link_pivots');
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'feature_link_pivots');
    }
}
