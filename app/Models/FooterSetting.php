<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'footer_logo_path',
        'company_description',
        'company_address',
        'company_email',
        'company_phone',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'copyright_text',
        'show_newsletter_signup',
        'newsletter_title',
        'newsletter_description',
        'quick_links_title',
        'show_quick_links',
        'columns_count',
        'show_social_icons',
        'show_payment_icons',
        'accepted_payment_methods',
    ];

    protected $casts = [
        'show_newsletter_signup' => 'boolean',
        'show_quick_links' => 'boolean',
        'show_social_icons' => 'boolean',
        'show_payment_icons' => 'boolean',
        'accepted_payment_methods' => 'array',
        'columns_count' => 'integer',
    ];

    /**
     * Get social media links as array
     */
    public function getSocialLinksAttribute(): array
    {
        return array_filter([
            'facebook' => $this->facebook_url,
            'instagram' => $this->instagram_url,
            'twitter' => $this->twitter_url,
            'linkedin' => $this->linkedin_url,
            'youtube' => $this->youtube_url,
        ]);
    }

    /**
     * Get contact information as array
     */
    public function getContactInfoAttribute(): array
    {
        return array_filter([
            'address' => $this->company_address,
            'email' => $this->company_email,
            'phone' => $this->company_phone,
        ]);
    }

    /**
     * Get quick links pages
     */
    public function quickLinks()
    {
        return Page::where('show_in_nav', true)
            ->where('accessible', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get the active footer settings
     */
    public static function getActive()
    {
        return static::firstOrCreate([], [
            'quick_links_title' => 'Quick Links',
            'columns_count' => 4,
            'show_social_icons' => true,
            'show_quick_links' => true,
        ]);
    }
}
