<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\VodVideoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmissionController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\ProgrammeController as AdminProgrammeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UrgentInfoController as AdminUrgentInfoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HlsProxyController;

Route::get('',[HomeController::class,'index'])->name('home');
Route::get('/actualites',[ActualiteController::class,'index'])->name('actualites.index');
Route::get('/actualites/{slug}',[ActualiteController::class,'show'])->name('actualites.show');

Route::get('/drtv/live', [LiveStreamController::class, 'tv'])->name('live.tv');

Route::get('drtv/vod',[VodVideoController::class, 'index'])->name('vod.index');
Route::get('vod/24{id}3',[VodVideoController::class, 'show'])->name('vod.show');

Route::get('/emissions',[EmissionController::class,'index'])->name('emissions.index');

Route::get('/productions',[ProductionController::class,'index'])->name('productions.index');



Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// download apk 
Route::get('telechargement-apk-drtv', [HomeController::class,'apk'])->name('apk');

Route::get('live-radio', [LiveStreamController::class,'radio'])->name('live.radio');





Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programme.index');
Route::get('/programme/{programme:slug}', [ProgrammeController::class, 'show'])->name('programme.show');

Route::get('/hls-proxy', [HlsProxyController::class, 'handle'])->name('hls.proxy');


// Auth (custom)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('actualites', AdminActualiteController::class)->except(['show']);
    Route::resource('programmes', AdminProgrammeController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('urgent', AdminUrgentInfoController::class)->parameters(['urgent' => 'urgent'])->except(['show']);
    Route::resource('users', AdminUserController::class)->except(['show']);
});
