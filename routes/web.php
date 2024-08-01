<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'list'])->name('pets.index');
    Route::get('/create', function () {
        return view('pets.create');
    })->name('pets.create');
    Route::get('/store', [PetController::class, 'store']);

    Route::post('/', [PetController::class, 'store'])->name('pets.store');
    Route::get('/{id}', [PetController::class, 'find'])->name('pets.show');
    Route::get('/findByStatus', [PetController::class, 'findByStatus'])->name('pets.findByStatus');
    Route::get('/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/{id}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/{id}', [PetController::class, 'delete'])->name('pets.delete');
});
