<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with optional filtering
     * GET /categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::query()
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('slug', 'like', "%{$request->search}%"))
            ->paginate($request->per_page ?? 15);

        return response()->json($categories);
    }

    /**
     * Store a newly created category
     * POST /categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories'],
            'images' => ['nullable', 'json'],
            'description' => ['nullable', 'json'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * Display the specified category
     * GET /categories/{category}
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    /**
     * Update the specified category
     * PUT/PATCH /categories/{category}
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:categories,slug,' . $category->id],
            'images' => ['sometimes', 'nullable', 'json'],
            'description' => ['sometimes', 'nullable', 'json'],
            'parent_id' => ['sometimes', 'nullable', 'exists:categories,id'],
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Remove the specified category
     * DELETE /categories/{category}
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(null, 204);
    }

    /**
     * Get category metadata without content
     * HEAD /categories/{category}
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function head(Category $category): JsonResponse
    {
        return response()->json(null)
            ->header('X-Category-Id', $category->id)
            ->header('X-Created-At', $category->created_at->toISOString());
    }
}
