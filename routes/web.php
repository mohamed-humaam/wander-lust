<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', function () {
    return view('packages.index');
});

Route::get('/packages/category/{slug}', function ($slug) {
    // Logic to load category by slug
    return view('packages.category', compact('slug'));
});

Route::get('/contact-us', function () {
    return view('contact');
});
