<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AmenityPivot extends Model
{
    protected $fillable = [
        'amenity_id', 'package_id'
    ];

    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
