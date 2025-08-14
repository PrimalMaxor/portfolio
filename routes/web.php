<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/projects', [HomeController::class, 'projects'])->name('projects');

Route::get('/cv', [HomeController::class, 'cv'])->name('cv');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard.view');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
