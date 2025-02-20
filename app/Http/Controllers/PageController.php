<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of pages with optional filtering
     * GET /pages
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $pages = Page::query()
            ->when($request->search, fn($query) => $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('slug', 'like', "%{$request->search}%"))
            ->when($request->parent_id, fn($query) => $query->where('parent_id', $request->parent_id))
            ->when($request->show_in_nav !== null, fn($query) => $query->where('show_in_nav', $request->boolean('show_in_nav')))
            ->when($request->accessible !== null, fn($query) => $query->where('accessible', $request->boolean('accessible')))
            ->when($request->top_level, fn($query) => $query->topLevel())
            ->when($request->with_children, fn($query) => $query->with('children'))
            ->orderBy('order')
            ->paginate($request->per_page ?? 15);

        return response()->json($pages);
    }

    /**
     * Store a newly created page
     * POST /pages
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:pages'],
            'parent_id' => ['nullable', 'exists:pages,id'],
            'order' => ['nullable', 'integer'],
            'show_in_nav' => ['boolean'],
            'accessible' => ['boolean'],
        ]);

        $page = Page::create($validated);

        return response()->json($page, 201);
    }

    /**
     * Display the specified page with its full path
     * GET /pages/{page}
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function show(Page $page): JsonResponse
    {
        return response()->json([
            ...$page->toArray(),
            'full_path' => $page->full_path,
            'has_children' => $page->hasChildren(),
        ]);
    }

    /**
     * Update the specified page
     * PUT/PATCH /pages/{page}
     *
     * @param Request $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(Request $request, Page $page): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('pages')->ignore($page->id)],
            'parent_id' => ['nullable', 'exists:pages,id'],
            'order' => ['nullable', 'integer'],
            'show_in_nav' => ['boolean'],
            'accessible' => ['boolean'],
        ]);

        $page->update($validated);

        return response()->json($page);
    }

    /**
     * Remove the specified page
     * DELETE /pages/{page}
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        $page->delete();

        return response()->json(null, 204);
    }

    /**
     * Get the navigation tree structure
     * GET /pages/navigation
     *
     * @return JsonResponse
     */
    public function navigation(): JsonResponse
    {
        $tree = Page::getNavigationTree();
        return response()->json($tree);
    }
}
