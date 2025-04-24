<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
    public function index()
    {
        // Get featured packages with pagination
        $packages = Package::with(['category', 'location'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('packages.index', compact('packages'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->withCount(['packages'])
            ->firstOrFail();

        // Get paginated packages for this category
        $packages = Package::where('category_id', $category->id)
            ->with(['category', 'location'])
            ->orderBy('name')
            ->paginate(12);

        return view('packages.category', compact('category', 'packages'));
    }

    public function location($slug)
    {
        $location = Location::where('slug', $slug)
            ->with(['packages' => function ($query) {
                $query->with(['category']);
            }])
            ->firstOrFail();

        // Get unique categories for this location's packages
        $categories = $location->packages->map(function ($package) {
            return $package->category;
        })->unique('id');

        return view('packages.location', compact('location', 'packages', 'categories'));
    }
}
