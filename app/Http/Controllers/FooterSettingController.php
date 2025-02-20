<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FooterSettingController extends Controller
{
    /**
     * Get the active footer settings
     * GET /footer-settings
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $settings = FooterSetting::getActive();

        return response()->json([
            ...$settings->toArray(),
            'social_links' => $settings->social_links,
            'contact_info' => $settings->contact_info,
            'quick_links' => $settings->show_quick_links ? $settings->quickLinks() : [],
        ]);
    }

    /**
     * Update the footer settings
     * PUT/PATCH /footer-settings
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'footer_logo_path' => ['nullable', 'string', 'max:255'],
            'company_description' => ['nullable', 'string'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'copyright_text' => ['nullable', 'string', 'max:255'],
            'show_newsletter_signup' => ['boolean'],
            'newsletter_title' => ['nullable', 'string', 'max:255'],
            'newsletter_description' => ['nullable', 'string'],
            'quick_links_title' => ['required', 'string', 'max:255'],
            'show_quick_links' => ['boolean'],
            'columns_count' => ['integer', 'min:1', 'max:6'],
            'show_social_icons' => ['boolean'],
            'show_payment_icons' => ['boolean'],
            'accepted_payment_methods' => ['nullable', 'array'],
        ]);

        $settings = FooterSetting::getActive();
        $settings->update($validated);

        return response()->json($settings);
    }
}
