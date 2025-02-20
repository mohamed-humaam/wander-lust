<?php

namespace App\Http\Controllers;

use App\Models\NavigationSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NavigationSettingController extends Controller
{
    /**
     * Get the active navigation settings
     * GET /navigation-settings
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $settings = NavigationSetting::getActive();
        return response()->json($settings);
    }

    /**
     * Update the navigation settings
     * PUT/PATCH /navigation-settings
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'logo_path' => ['nullable', 'string', 'max:255'],
            'search_enabled' => ['boolean'],
        ]);

        $settings = NavigationSetting::getActive();
        $settings->update($validated);

        return response()->json($settings);
    }
}
