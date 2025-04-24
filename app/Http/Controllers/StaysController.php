<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Room;
use Illuminate\Http\Request;

class StaysController extends Controller
{
    public function index()
    {
        $locations = Location::with('roomLinks.category')->get();
        return view('stays.index', compact('locations'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get locations that have rooms linked to this category
        $locations = Location::whereHas('roomLinks', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->with(['roomLinks' => function($query) use ($category) {
            $query->where('category_id', $category->id);
        }, 'roomLinks.category'])->get();

        return view('stays.category', compact('locations', 'category'));
    }

    public function location($slug)
    {
        $location = Location::where('slug', $slug)
            ->with('roomLinks.room')
            ->firstOrFail();

        $rooms = $location->roomLinks->map->room->unique('id');

        return view('stays.location', compact('location', 'rooms'));
    }

    public function room($id)
    {
        $room = Room::with(['roomLinks.location', 'roomLinks.category'])
            ->findOrFail($id);

        $locations = $room->getLocations();
        $categories = $room->getCategories();

        return view('stays.room', compact('room', 'locations', 'categories'));
    }
}
