<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms with optional filtering
     * GET /rooms
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $rooms = Room::all(); // Fetch all categories without filters

        if ($rooms->isEmpty()) {
            return response()->json(['message' => 'No rooms found'], 404);
        }

        return response()->json($rooms);
    }

    /**
     * Store a newly created room
     * POST /rooms
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
            'price' => ['numeric'],
            'capacity' => ['integer'],
            'parent_id' => ['nullable', 'exists:rooms,id'],
        ]);

        $room = Room::create($validated);

        return response()->json($room, 201);
    }

    /**
     * Display the specified room
     * GET /rooms/{room}
     *
     * @param Room $room
     * @return JsonResponse
     */
    public function show(Room $room): JsonResponse
    {
        return response()->json($room);
    }

    /**
     * Update the specified room
     * PUT/PATCH /rooms/{room}
     *
     * @param Request $request
     * @param Room $room
     * @return JsonResponse
     */
    public function update(Request $request, Room $room): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'icon' => ['sometimes', 'nullable', 'string'],
            'description' => ['sometimes', 'nullable', 'json'],
            'price' => ['sometimes', 'numeric'],
            'capacity' => ['sometimes', 'integer'],
            'parent_id' => ['sometimes', 'nullable', 'exists:rooms,id'],
        ]);

        $room->update($validated);

        return response()->json($room);
    }

    /**
     * Remove the specified room
     * DELETE /rooms/{room}
     *
     * @param Room $room
     * @return JsonResponse
     */
    public function destroy(Room $room): JsonResponse
    {
        $room->delete();

        return response()->json(null, 204);
    }

    /**
     * Get room metadata without content
     * HEAD /rooms/{room}
     *
     * @param Room $room
     * @return JsonResponse
     */
    public function head(Room $room): JsonResponse
    {
        return response()->json(null)
            ->header('X-Room-Id', $room->id)
            ->header('X-Created-At', $room->created_at->toISOString());
    }
}
