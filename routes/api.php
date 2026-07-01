<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\{AuthController, ParticipantController};

Route::prefix('v1')->group(function () {

    // Public Routes
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
    });

    // Protected Routes
    Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/me', 'me');
    });

    Route::middleware('auth:sanctum')->controller(ParticipantController::class)->group(function () {
        Route::post('/register-participant', 'registerParticipant');
    });

});