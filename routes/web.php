<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Public site
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/inquiry', [SiteController::class, 'inquiry'])->middleware('throttle:10,1')->name('inquiry');

// Admin login (route name 'login' Laravel ke auth redirect ke liye zaroori hai)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware(['guest', 'throttle:6,1'])->name('admin.login.submit');

// Admin panel
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.products.index'))->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('products', ProductController::class)->except('show');

    Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
