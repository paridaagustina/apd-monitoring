<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LaporanApdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Login, Register, Lupa Password, dan Google
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.process');

    // Lupa Password
    Route::get('/forgot-password', [
        ForgotPasswordController::class,
        'showForgotForm',
    ])->name('password.request');

    Route::post('/forgot-password', [
        ForgotPasswordController::class,
        'sendResetLink',
    ])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [
        ForgotPasswordController::class,
        'showResetForm',
    ])->name('password.reset');

    Route::post('/reset-password', [
        ForgotPasswordController::class,
        'resetPassword',
    ])->name('password.update');

    // Login dengan Google
    Route::get('/auth/google', [
        GoogleAuthController::class,
        'redirect',
    ])->name('google.redirect');

    Route::get('/auth/google/callback', [
        GoogleAuthController::class,
        'callback',
    ])->name('google.callback');
});

/*
|--------------------------------------------------------------------------
| Dashboard, Laporan APD, dan Logout
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard berdasarkan role akun
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('users.dashboard');
    })->name('dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })
        ->middleware('can:admin')
        ->name('admin.dashboard');

    // Dashboard Pengguna
    Route::get('/users/dashboard', function () {
        return view('users.dashboard');
    })
        ->middleware('can:pengguna')
        ->name('users.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Laporan APD untuk Pengguna
    |--------------------------------------------------------------------------
    */

    Route::middleware('can:pengguna')->group(function () {

        // Menampilkan form laporan APD
        Route::get('/users/laporan-apd', [
            LaporanApdController::class,
            'create',
        ])->name('users.laporan.create');

        // Menyimpan laporan APD
        Route::post('/users/laporan-apd', [
            LaporanApdController::class,
            'store',
        ])->name('users.laporan.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});