<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Room;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get a few featured packages and rooms
        $featuredPackages = Package::latest()->take(3)->get();
        $featuredRooms = Room::latest()->take(3)->get();

        return view('welcome', compact('featuredPackages', 'featuredRooms'));
    }
}
