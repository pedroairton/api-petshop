<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServicoController;
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
// exibe pet por id
Route::get('/pet/{pet}', [PetController::class, 'getPet'])->name('get-pet');
//servicos
Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos');
// num de servicos
Route::get('/count/servicos', [ServicoController::class, 'quantServicos'])->name('quantServicos');
// exibe agenda
Route::get('/agendamento', [AgendamentoController::class, 'index'])->name('pages.agendamento');
// exibe agenda de um pet
Route::get('/agendamento/{pet}', [AgendamentoController::class, 'petAgenda'])->name('pet-agenda');
// agendar
Route::post('/agendamento', [AgendamentoController::class, 'agendar'])->name('agendamento');
