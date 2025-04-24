<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', function () {
    return view('packages.index');
});

Route::get('/packages/category/{slug}', function ($slug) {
    return view('packages.category', compact('slug'));
});

Route::get('/stays', function () {
    return view('stays.index');
});

Route::get('/stays/category/{slug}', function ($slug) {
    return view('stays.category', compact('slug'));
});

Route::get('/contact-us', function () {
    return view('contact-us');
});
