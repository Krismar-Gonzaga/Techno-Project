<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KitController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kit Management
    Route::get('/kits', [KitController::class, 'index'])->name('kits.index');
    Route::get('/kits/create', [KitController::class, 'create'])->name('kits.create');
    Route::post('/kits', [KitController::class, 'store'])->name('kits.store');
    Route::get('/kits/generate-code', [KitController::class, 'generateKitCode'])->name('kits.generate-code');
    Route::get('/kits/{id}/upload-results', [KitController::class, 'uploadResults'])->name('kits.upload-results');
    Route::post('/kits/{id}/save-results', [KitController::class, 'saveResults'])->name('kits.save-results');
    Route::post('/kits/{id}/release', [KitController::class, 'releaseResults'])->name('kits.release');
});