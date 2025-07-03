<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PetController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/add-pet', [PetController::class, 'createPet'])->name('pet.form');
    Route::post('/dashboard/store-pet', [PetController::class, 'storePet'])->name('pet.store');
    Route::get('/dashboard/update-pet-form/{id}', [PetController::class, 'updatePetForm'])->name('pet.update.form');
    Route::put('/dashboard/update-pet/{id}', [PetController::class, 'updatePet'])->name('pet.update');
    Route::delete('/dashboard/delete-pet/{id}', [PetController::class, 'destroyPet'])->name('pet.destroy');

    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
