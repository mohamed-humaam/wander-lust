<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'slug', 'images', 'gallery', 'location', 'description', 'google_location'];
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
}
