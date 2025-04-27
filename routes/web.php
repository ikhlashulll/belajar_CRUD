<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TPKController;
use App\Http\Controllers\AuthController;
// use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth:web'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

// TPK routes
Route::middleware(['auth:tpk'])->group(function () {
    Route::get('/tpk/dashboard', function () {
        return view('tpk.dashboard');
    });
});


Route::get('/tpk', [TPKController::class, 'index'])->name('tpk.index');
Route::get('/tpk/create', [TPKController::class, 'create'])->name('tpk.create');
Route::post('/tpk', [TPKController::class, 'store'])->name('tpk.store');
Route::get('/tpk/{tpk}/edit', [TPKController::class, 'edit'])->name('tpk.edit');
Route::put('/tpk/{tpk}', [TPKController::class, 'update'])->name('tpk.update');
Route::delete('/tpk/{tpk}', [TPKController::class, 'destroy'])->name('tpk.destroy');


