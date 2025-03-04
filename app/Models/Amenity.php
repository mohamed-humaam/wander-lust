<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'icon',
        'description',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'amenity_link_pivots');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'amenity_link_pivots');
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'amenity_link_pivots');
    }
}
