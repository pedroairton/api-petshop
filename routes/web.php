<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;

Route::get('/', function () {

    // CREATE
    // $post = new Usuario();
    // $post->title = 'Primeiro post';
    // $post->body = 'Lorem texto ipsum';
    // $post->save();

    // $usuario = Usuario::create([
    //     'nome' => 'Cleber',
    //     'endereco' => 'Rua do mal',
    //     'email' => 'cleber@email.com',
    //     'telefone' => '81994791158',
    //     'senha' => '123',
    // ]);

    // READ (GET)
    // $post = Post::find(2);
    // $post = Post::where('title', 'Segundo post')->first();
    // $post = Post::all();

    // UPDATE
    // $post = Post::find(1);
    // $post->title = 'Novo título';
    // $post->save();
        // simulação 
    // $input = [
    //     'title' => 'Titulo input',
    //     'body' => 'Texto input'
    // ];
    // $post = Post::find(1);
    // $post->fill($input);
    // $post->save();

    // DELETE

    // $post = Post::find(3);
    // $post -> delete();

    // dd($post);

    // $user = User::find(1);
    // $user->profile()->create([
    //     'type' => 'pj',
    //     'document_number' => '234802',
    // ]);
    // dd($user);

    return view('pages.index');
})->name('pages.index');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/cadastro', [UserController::class, 'cadastro'])->name('pages.cadastro');
Route::post('/cadastro', [UserController::class, 'store'])->name('pages.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('pages.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function(){
    if(!session('admin')) {
        return redirect()->route('login')->withErrors(['error' => 'Acesso negado']);
    }
    return view('pages.dashboard');
    // retornar view do dashboard aqui
})->name('dashboard');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('pages.usuarios');
Route::get('/usuarios/{usuario}', [UsuarioController::class, 'usuario'])->name('pages.usuario');
Route::post('/usuarios', [UsuarioController::class, 'registerUsuario'])->name('usuarios');
Route::post('/usuarios/{id}', [PetController::class, 'registerPet'])->name('pet');

Route::get('/agendamento', [AgendamentoController::class, 'index'])->name('pages.agendamento');
Route::post('/agendamento', [AgendamentoController::class, 'agendar'])->name('agendamento');
Route::get('/agendamento/{pet}', [AgendamentoController::class, 'petAgenda'])->name('pet-agenda');