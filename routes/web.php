<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/gioi-thieu', 'pages.about')->name('about');
Route::view('/lien-he', 'pages.contact')->name('contact');

Route::middleware('guest')->group(function (): void {
    Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.store');
    Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/dang-xuat', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/ho-so', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/ho-so', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('owner')->name('owner.')->middleware(['auth', 'role:owner'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
