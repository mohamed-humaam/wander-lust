<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities with optional filtering
     * GET /activities
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $activities = Activity::query()
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%"))
            ->paginate($request->per_page ?? 15);

        return response()->json($activities);
    }

    /**
     * Store a newly created activity
     * POST /activities
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'description' => ['nullable', 'json'],
            'parent_id' => ['nullable', 'exists:activities,id'],
        ]);

        $activity = Activity::create($validated);

        return response()->json($activity, 201);
    }

    /**
     * Display the specified activity
     * GET /activities/{activity}
     *
     * @param Activity $activity
     * @return JsonResponse
     */
    public function show(Activity $activity): JsonResponse
    {
        return response()->json($activity);
    }

    /**
     * Update the specified activity
     * PUT/PATCH /activities/{activity}
     *
     * @param Request $request
     * @param Activity $activity
     * @return JsonResponse
     */
    public function update(Request $request, Activity $activity): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'icon' => ['sometimes', 'nullable', 'string'],
            'description' => ['sometimes', 'nullable', 'json'],
            'parent_id' => ['sometimes', 'nullable', 'exists:activities,id'],
        ]);

        $activity->update($validated);

        return response()->json($activity);
    }

    /**
     * Remove the specified activity
     * DELETE /activities/{activity}
     *
     * @param Activity $activity
     * @return JsonResponse
     */
    public function destroy(Activity $activity): JsonResponse
    {
        $activity->delete();

        return response()->json(null, 204);
    }

    /**
     * Get activity metadata without content
     * HEAD /activities/{activity}
     *
     * @param Activity $activity
     * @return JsonResponse
     */
    public function head(Activity $activity): JsonResponse
    {
        return response()->json(null)
            ->header('X-Activity-Id', $activity->id)
            ->header('X-Created-At', $activity->created_at->toISOString());
    }
}
