<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

// Configure Guzzle client to ignore SSL verification
app()->singleton('api.client', function () {
    return new Client([
        'verify' => false, // Disables SSL certificate verification
    ]);
});

/**
 * API Routes
 *
 * This file contains the API routes for the application.
 * All routes are prefixed with `/api` and should follow RESTful standards.
 */

// Test route to check if the API is running
Route::get('/ping', function () {
    return response()->json(['message' => 'API Fadaboe']);
});

/**
 * User API Endpoints
 * Base URL: {baseURL}/api/users
 */
Route::apiResource('users', UserController::class);
Route::match(['head'], 'users/{user}', [UserController::class, 'head']);

/**
 * Location API Endpoints
 * Base URL: {baseURL}/api/locations
 */
Route::apiResource('locations', LocationController::class);
Route::match(['head'], 'locations/{location}', [LocationController::class, 'head']);

/**
 * Category API Endpoints
 * Base URL: {baseURL}/api/categories
 */
Route::apiResource('categories', CategoryController::class);
Route::match(['head'], 'categories/{category}', [CategoryController::class, 'head']);

/**
 * Package API Endpoints
 * Base URL: {baseURL}/api/packages
 */
Route::apiResource('packages', PackageController::class);
Route::match(['head'], 'packages/{package}', [PackageController::class, 'head']);

/**
 * Amenity API Endpoints
 * Base URL: {baseURL}/api/amenities
 */
Route::apiResource('amenities', AmenityController::class);
Route::match(['head'], 'amenities/{amenity}', [AmenityController::class, 'head']);

/**
 * Room API Endpoints
 * Base URL: {baseURL}/api/rooms
 */
Route::apiResource('rooms', RoomController::class);
Route::match(['head'], 'rooms/{room}', [RoomController::class, 'head']);

/**
 * Activity API Endpoints
 * Base URL: {baseURL}/api/activities
 */
Route::apiResource('activities', ActivityController::class);
Route::match(['head'], 'activities/{activity}', [ActivityController::class, 'head']);

/**
 * Feature API Endpoints
 * Base URL: {baseURL}/api/features
 */
Route::apiResource('features', FeatureController::class);
Route::match(['head'], 'features/{feature}', [FeatureController::class, 'head']);
