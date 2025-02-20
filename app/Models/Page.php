<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Page extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'order',
        'show_in_nav',
        'accessible',
    ];

    protected $casts = [
        'accessible' => 'boolean',
        'show_in_nav' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get navigation tree structure
     */
    public static function getNavigationTree()
    {
        return static::topLevel()
            ->inNavigation()
            ->with('children')
            ->orderBy('order')
            ->get();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get all children (recursive)
     */
    public function allChildren(): Builder|HasMany
    {
        return $this->children()->with('allChildren');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')
            ->orderBy('order');
    }

    /**
     * Scope for top-level pages
     */
    public function scopeTopLevel(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope for navigation items
     */
    public function scopeInNavigation(Builder $query): Builder
    {
        return $query->where('show_in_nav', true);
    }

    /**
     * Scope for accessible pages
     */
    public function scopeAccessible(Builder $query): Builder
    {
        return $query->where('accessible', true);
    }

    /**
     * Get the full URL path including parents
     */
    public function getFullPathAttribute(): string
    {
        $path = collect($this->parents()->pluck('slug'))
            ->push($this->slug)
            ->filter()
            ->join('/');

        return '/' . $path;
    }

    /**
     * Get all parents (recursive)
     */
    public function parents(): Collection
    {
        $parents = collect();
        $parent = $this->parent;

        while ($parent) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents->reverse();
    }

    /**
     * Check if page has children
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }
}
