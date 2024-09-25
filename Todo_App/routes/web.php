<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Auth, Verified Middleware
Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Todos Controller Group
    Route::controller(TodoController::class)->group(function(){
        Route::get('/todos', 'index')->name('todos');
        Route::post('/todos', 'store')->name('todos.store');
        Route::put('/todos/{todo}/update', 'update')->name('todos.update');
        Route::delete('/todos/{todo}', 'destroy')->name('todos.destroy');
    });

});


// Auth Middleware
Route::middleware('auth')->group(function () {
    // Profile Controller Group
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
