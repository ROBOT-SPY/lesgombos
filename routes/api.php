<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * API Routes
 * All routes prefixed with /api/v1
 */
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to the dashboard!',
        ]);
    })->name('dashboard');
    /**
     * Global user routes
     */
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    /**
     * Admin-only routes
     */
    Route::middleware('isadmin')->group(function () {
        Route::get('/roles/create', [SettingsController::class, 'createRole'])
            ->name('roles.create');

    });

   
    Route::apiRessource('workers', WorkerController::class);
    Route::apiRessource('locations', LocationController::class);
    Route::apiRessource('activities', ActivityController::class);

});

// Authentication Routes
Route::middleware('guest')->prefix('v1')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('/2fa/verify', [AuthenticatedSessionController::class, 'verifyTwoFactor'])
        ->name('verify.two.factor');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');




