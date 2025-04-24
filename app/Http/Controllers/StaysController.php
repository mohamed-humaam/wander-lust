<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaysController extends Controller
{
    public function index()
    {
        // Get featured locations with pagination
        $locations = Location::with(['roomLinks' => function ($query) {
            $query->with(['category', 'room']);
        }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('stays.index', compact('locations'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->withCount(['roomLinks as locations_count' => function ($query) {
                $query->select(DB::raw('count(distinct location_id)'));
            }])
            ->firstOrFail();

        // Get paginated locations for this category
        $locations = Location::whereHas('roomLinks', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
            ->with(['roomLinks' => function ($query) use ($category) {
                $query->where('category_id', $category->id)
                    ->with(['room', 'category']);
            }])
            ->orderBy('name')
            ->paginate(12);

        return view('stays.category', compact('category', 'locations'));
    }

    public function location($slug)
    {
        $location = Location::where('slug', $slug)
            ->with(['roomLinks' => function ($query) {
                $query->with(['room', 'category']);
            }])
            ->firstOrFail();

        // Get unique rooms for this location
        $rooms = $location->roomLinks->map(function ($link) {
            return $link->room;
        })->unique('id');

        return view('stays.location', compact('location', 'rooms'));
    }

    public function room($id)
    {
        $room = Room::with(['roomLinks' => function ($query) {
            $query->with(['location', 'category']);
        }])
            ->findOrFail($id);

        // Get unique locations and categories for this room
        $locations = $room->roomLinks->map(function ($link) {
            return $link->location;
        })->unique('id');

        $categories = $room->roomLinks->map(function ($link) {
            return $link->category;
        })->unique('id');

        return view('stays.room', compact('room', 'locations', 'categories'));
    }
}
