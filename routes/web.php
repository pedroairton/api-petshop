<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;

Route::get('/', function () {
    return view('pages.index');
})->name('pages.index');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/cadastro', [UserController::class, 'cadastro'])->name('pages.cadastro');
Route::post('/cadastro', [UserController::class, 'store'])->name('pages.store');

// exibe view de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');


Route::get('/dashboard', function(){
    if(!session('admin')) {
        return redirect()->route('login')->withErrors(['error' => 'Acesso negado']);
    }
    return view('pages.dashboard');
    // retornar view do dashboard aqui
})->name('dashboard');

Route::get('/rota', [UserController::class, 'view'])->name('rota');