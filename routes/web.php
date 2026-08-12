<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Lixeira
    Route::get('/notes/trash', [NoteController::class, 'trash'])->name('notes.trash');

    Route::patch('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');

    Route::delete('/notes/{id}/force-delete', [NoteController::class, 'forceDelete'])->name('notes.forceDelete');

    // CRUD das notas
    Route::resource('notes', NoteController::class);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
