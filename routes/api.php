<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

// exibe usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('pages.usuarios');
// exibe usuario por id
Route::get('/usuarios/{usuario}', [UsuarioController::class, 'usuario'])->name('pages.usuario');
// filtro busca usuario
Route::get('/busca-user', [UsuarioController::class, 'buscaUser'])->name('buscaUser');
// num de usuarios
Route::get('/count/usuarios', [UsuarioController::class, 'quantUser'])->name('quantUser');
// cadastrar usuario
Route::post('/usuarios', [UsuarioController::class, 'registerUsuario'])->name('usuarios');
// cadastrar pet
Route::post('/usuarios/{id}', [PetController::class, 'registerPet'])->name('pet');
// num de pet
Route::get('/count/pet', [PetController::class, 'quantPet'])->name('quantPet');
