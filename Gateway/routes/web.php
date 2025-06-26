<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Get the prefix from config or set a default
$prefix = config('roro.prefix', '');

Route::group(['prefix' => $prefix], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Authentication routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Protected WEB routes (require session-based authentication)
    Route::middleware('session.auth')->group(function () {
        Route::get('/dashboard', function () {
            $user = session('user');
            return view('dashboard', compact('user'));
        })->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/refresh-token', [AuthController::class, 'refreshToken'])->name('refresh-token');
    });
});
