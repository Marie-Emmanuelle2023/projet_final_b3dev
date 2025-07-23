<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoordinateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('coordinateurs', CoordinateurController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('classes', ClasseController::class)->parameters(['classes' => 'classe']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('coordinateurs', CoordinateurController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('coordinateurs', CoordinateurController::class);
});



Route::get('/test-users', function () {
    return 'Ça fonctionne 🎉';
});



require __DIR__.'/auth.php';
