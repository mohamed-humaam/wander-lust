<?php

use App\Http\Controllers\FooterSettingController;
use App\Http\Controllers\NavigationSettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
 * Page API Endpoints
 * Base URL: {baseURL}/api/pages
 */
Route::apiResource('pages', PageController::class);
Route::get('pages/navigation/tree', [PageController::class, 'navigation']);

/**
 * Navigation Settings API Endpoints
 * Base URL: {baseURL}/api/navigation-settings
 */
Route::get('navigation-settings', [NavigationSettingController::class, 'show']);
Route::match(['put', 'patch'], 'navigation-settings', [NavigationSettingController::class, 'update']);

/**
 * Footer Settings API Endpoints
 * Base URL: {baseURL}/api/footer-settings
 */
Route::get('footer-settings', [FooterSettingController::class, 'show']);
Route::match(['put', 'patch'], 'footer-settings', [FooterSettingController::class, 'update']);
