<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PackageController extends Controller
{
    /**
     * Display a listing of packages with optional filtering
     * GET /packages
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // External API call (even if SSL cert is self-signed or missing)
            $response = Http::withOptions([
                'verify' => false, // <-- Ignore SSL errors
            ])->get('https://admin.wanderlustadventuresmv.com/api/packages');

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created package
     * POST /packages
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:packages'],
            'images' => ['nullable', 'json'],
            'gallery' => ['nullable', 'json'],
            'category_id' => ['required', 'exists:categories,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'description' => ['nullable', 'json'],
            'price' => ['numeric'],
            'duration' => ['nullable', 'integer'],
        ]);

        $package = Package::create($validated);

        return response()->json($package, 201);
    }

    /**
     * Display the specified package
     * GET /packages/{package}
     *
     * @param Package $package
     * @return JsonResponse
     */
    public function show(Package $package): JsonResponse
    {
        return response()->json($package);
    }

    /**
     * Update the specified package
     * PUT/PATCH /packages/{package}
     *
     * @param Request $request
     * @param Package $package
     * @return JsonResponse
     */
    public function update(Request $request, Package $package): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:packages,slug,' . $package->id],
            'images' => ['sometimes', 'nullable', 'json'],
            'gallery' => ['sometimes', 'nullable', 'json'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'location_id' => ['sometimes', 'exists:locations,id'],
            'description' => ['sometimes', 'nullable', 'json'],
            'price' => ['sometimes', 'numeric'],
            'duration' => ['sometimes', 'nullable', 'integer'],
        ]);

        $package->update($validated);

        return response()->json($package);
    }

    /**
     * Remove the specified package
     * DELETE /packages/{package}
     *
     * @param Package $package
     * @return JsonResponse
     */
    public function destroy(Package $package): JsonResponse
    {
        $package->delete();

        return response()->json(null, 204);
    }

    /**
     * Get package metadata without content
     * HEAD /packages/{package}
     *
     * @param Package $package
     * @return JsonResponse
     */
    public function head(Package $package): JsonResponse
    {
        return response()->json(null)
            ->header('X-Package-Id', $package->id)
            ->header('X-Created-At', $package->created_at->toISOString());
    }
}
