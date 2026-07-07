<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\{AuthController,EventController,ParticipantController};

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'resetPassword');
    });

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:sanctum')->group(function () {

        // Authentication
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout', 'logout');
            Route::get('/me', 'me');
        });

        // Events
        Route::controller(EventController::class)->group(function () {
            Route::post('/events', 'store');
            Route::get('/events', 'index');
            Route::get('/events/{event}', 'show');
            Route::put('/events/{event}', 'update');
            Route::delete('/events/{event}', 'destroy');
        });

        // Participants
        Route::controller(ParticipantController::class)->group(function () {
            // Register authenticated user for an event
            Route::post('/events/{event}/register', 'register');

            // List participants of an event
            Route::get('/events/{event}/participants', 'index');

            // Cancel registration (optional but recommended)
            Route::delete('/events/{event}/register', 'destroy');
        });

    });

});