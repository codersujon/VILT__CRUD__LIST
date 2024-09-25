<?php

use App\Http\Controllers\TopicController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Topics start
    Route::controller(TopicController::class)->group(function(){
        Route::get('/topics', 'index')->name('topics.index');
        Route::get('/topics/create', 'create')->name('topics.create');
        Route::post('/topics/store', 'store')->name('topics.store');
        Route::get('/topics/{topic}/edit','edit')->name('topics.edit');
        Route::delete('/topics/{topic}', 'destroy')->name('topics.delete');
        Route::post('/topics/update/{topic}', 'update')->name('topics.update');
    });
// End

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
