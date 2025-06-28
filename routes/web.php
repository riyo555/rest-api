<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Redirect root ke login jika belum login
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return view('dashboard');
});

// Routes yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/mahasiswa', function () {
        return view('mahasiswa');
    })->name('mahasiswa');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});