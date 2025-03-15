<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AmenityController extends Controller
{
    /**
     * Display a listing of amenities with optional filtering
     * GET /amenities
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $amenities = Amenity::query()
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('slug', 'like', "%{$request->search}%"))
            ->paginate($request->per_page ?? 15);

        return response()->json($amenities);
    }

    /**
     * Store a newly created amenity
     * POST /amenities
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:amenities'],
            'icon' => ['nullable', 'string'],
            'description' => ['nullable', 'json'],
        ]);

        $amenity = Amenity::create($validated);

        return response()->json($amenity, 201);
    }

    /**
     * Display the specified amenity
     * GET /amenities/{amenity}
     *
     * @param Amenity $amenity
     * @return JsonResponse
     */
    public function show(Amenity $amenity): JsonResponse
    {
        return response()->json($amenity);
    }

    /**
     * Update the specified amenity
     * PUT/PATCH /amenities/{amenity}
     *
     * @param Request $request
     * @param Amenity $amenity
     * @return JsonResponse
     */
    public function update(Request $request, Amenity $amenity): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:amenities,slug,' . $amenity->id],
            'icon' => ['sometimes', 'nullable', 'string'],
            'description' => ['sometimes', 'nullable', 'json'],
        ]);

        $amenity->update($validated);

        return response()->json($amenity);
    }

    /**
     * Remove the specified amenity
     * DELETE /amenities/{amenity}
     *
     * @param Amenity $amenity
     * @return JsonResponse
     */
    public function destroy(Amenity $amenity): JsonResponse
    {
        $amenity->delete();

        return response()->json(null, 204);
    }

    /**
     * Get amenity metadata without content
     * HEAD /amenities/{amenity}
     *
     * @param Amenity $amenity
     * @return JsonResponse
     */
    public function head(Amenity $amenity): JsonResponse
    {
        return response()->json(null)
            ->header('X-Amenity-Id', $amenity->id)
            ->header('X-Created-At', $amenity->created_at->toISOString());
    }
}
