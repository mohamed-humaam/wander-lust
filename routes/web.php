<?php

// routes/web.php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\StaysController;
use Illuminate\Support\Facades\Route;

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/', function () {
    return view('welcome');
});

// Packages routes
Route::get('/packages', function () {
    return view('packages.index');
})->name('packages.index');

Route::get('/packages/category/{slug}', function ($slug) {
    return view('packages.category', compact('slug'));
})->name('packages.category');

// Stays routes
Route::get('/stays', [StaysController::class, 'index'])->name('stays.index');
Route::get('/stays/category/{slug}', [StaysController::class, 'category'])->name('stays.category');
Route::get('/stays/{slug}', [StaysController::class, 'location'])->name('stays.location');
Route::get('/stays/room/{id}', [StaysController::class, 'room'])->name('stays.room');

// Contact route (updated to use name)
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact'); // Changed from 'contact-us' to 'contact' for consistency
