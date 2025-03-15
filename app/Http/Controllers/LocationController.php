<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    /**
     * Display a listing of locations with optional filtering
     * GET /locations
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $locations = Location::query()
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('slug', 'like', "%{$request->search}%"))
            ->paginate($request->per_page ?? 15);

        return response()->json($locations);
    }

    /**
     * Store a newly created location
     * POST /locations
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:locations'],
            'images' => ['nullable', 'json'],
            'gallery' => ['nullable', 'json'],
            'location' => ['nullable', 'json'],
            'description' => ['nullable', 'json'],
            'google_location' => ['nullable', 'json'],
        ]);

        $location = Location::create($validated);

        return response()->json($location, 201);
    }

    /**
     * Display the specified location
     * GET /locations/{location}
     *
     * @param Location $location
     * @return JsonResponse
     */
    public function show(Location $location): JsonResponse
    {
        return response()->json($location);
    }

    /**
     * Update the specified location
     * PUT/PATCH /locations/{location}
     *
     * @param Request $request
     * @param Location $location
     * @return JsonResponse
     */
    public function update(Request $request, Location $location): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:locations,slug,' . $location->id],
            'images' => ['sometimes', 'nullable', 'json'],
            'gallery' => ['sometimes', 'nullable', 'json'],
            'location' => ['sometimes', 'nullable', 'json'],
            'description' => ['sometimes', 'nullable', 'json'],
            'google_location' => ['sometimes', 'nullable', 'json'],
        ]);

        $location->update($validated);

        return response()->json($location);
    }

    /**
     * Remove the specified location
     * DELETE /locations/{location}
     *
     * @param Location $location
     * @return JsonResponse
     */
    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json(null, 204);
    }

    /**
     * Get location metadata without content
     * HEAD /locations/{location}
     *
     * @param Location $location
     * @return JsonResponse
     */
    public function head(Location $location): JsonResponse
    {
        return response()->json(null)
            ->header('X-Location-Id', $location->id)
            ->header('X-Created-At', $location->created_at->toISOString());
    }
}
