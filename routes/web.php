<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\StaysController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Contact routes
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit');

// Packages routes
Route::get('/packages', function () {
    return view('packages.index');
})->name('packages.index');

Route::get('/packages/category/{slug}', function ($slug) {
    return view('packages.category', compact('slug'));
})->name('packages.category');

// Stays routes
Route::prefix('stays')->group(function () {
    Route::get('/', [StaysController::class, 'index'])
        ->name('stays.index');

    Route::get('/category/{slug}', [StaysController::class, 'category'])
        ->name('stays.category');

    Route::get('/{slug}', [StaysController::class, 'location'])
        ->name('stays.location');

    Route::get('/room/{id}', [StaysController::class, 'room'])
        ->name('stays.room');
});
