<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationSetting extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'logo_path',
        'search_enabled',
    ];

    protected $casts = [
        'search_enabled' => 'boolean',
    ];

    public static function getActive()
    {
        return static::firstOrCreate([], [
            'search_enabled' => true
        ]);
    }
}
