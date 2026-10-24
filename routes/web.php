<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\controllers\UsuarioController;

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

//------------------------------------------------------------------------------------------------------------------------------------------

    Route::middleware('permission:ver usuarios')->group(function () {   
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    });
    Route::middleware('permission:crear usuarios')->group(function () { 
        Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    });
    Route::middleware('permission:editar usuarios')->group(function () {    
        Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    });
    Route::middleware('permission:eliminar usuarios')->group(function () {
        Route::delete('usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });
//------------------------------------------------------------------------------------------------------------------------------------------
});

require __DIR__.'/auth.php';
