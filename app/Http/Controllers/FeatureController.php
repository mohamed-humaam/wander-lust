<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FeatureController extends Controller
{
    /**
     * Display a listing of features with optional filtering
     * GET /features
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $features = Feature::all(); // Fetch all categories without filters

        if ($features->isEmpty()) {
            return response()->json(['message' => 'No features found'], 404);
        }

        return response()->json($features);
    }

    /**
     * Store a newly created feature
     * POST /features
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string'],
            'description' => ['nullable', 'json'],
            'parent_id' => ['nullable', 'exists:features,id'],
        ]);

        $feature = Feature::create($validated);

        return response()->json($feature, 201);
    }

    /**
     * Display the specified feature
     * GET /features/{feature}
     *
     * @param Feature $feature
     * @return JsonResponse
     */
    public function show(Feature $feature): JsonResponse
    {
        return response()->json($feature);
    }

    /**
     * Update the specified feature
     * PUT/PATCH /features/{feature}
     *
     * @param Request $request
     * @param Feature $feature
     * @return JsonResponse
     */
    public function update(Request $request, Feature $feature): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'icon' => ['sometimes', 'string'],
            'description' => ['sometimes', 'nullable', 'json'],
            'parent_id' => ['sometimes', 'nullable', 'exists:features,id'],
        ]);

        $feature->update($validated);

        return response()->json($feature);
    }

    /**
     * Remove the specified feature
     * DELETE /features/{feature}
     *
     * @param Feature $feature
     * @return JsonResponse
     */
    public function destroy(Feature $feature): JsonResponse
    {
        $feature->delete();

        return response()->json(null, 204);
    }

    /**
     * Get feature metadata without content
     * HEAD /features/{feature}
     *
     * @param Feature $feature
     * @return JsonResponse
     */
    public function head(Feature $feature): JsonResponse
    {
        return response()->json(null)
            ->header('X-Feature-Id', $feature->id)
            ->header('X-Created-At', $feature->created_at->toISOString());
    }
}
