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
// servico por id
Route::get('/servico/{id}', [ServicoController::class, 'servico'])->name('servico');
// cria servico
Route::post('/servico', [ServicoController::class, 'criaServico'])->name('cria-servico');
// num de servicos
Route::get('/count/servicos', [ServicoController::class, 'quantServicos'])->name('quantServicos');
// muda status servico
Route::put('/servico/{id}/status', [ServicoController::class, 'mudaStatus'])->name('status-servico');
// deleta servico
Route::delete('/servico/{id}/delete', [ServicoController::class, 'deleteServico'])->name('delete-servico');
// atualiza servico
Route::put('/servico/atualizar/{id}', [ServicoController::class, 'updateServico'])->name('update-servico');
// exibe agenda
Route::get('/agendamento', [AgendamentoController::class, 'index'])->name('agendamentos');
// exibe agenda de um pet
Route::get('/agendamento/{pet}', [AgendamentoController::class, 'petAgenda'])->name('pet-agenda');
// agendar
Route::post('/agendamento', [AgendamentoController::class, 'agendar'])->name('agendamento');
// concluir agendamento
Route::put('/agendamento/{id}/concluir', [AgendamentoController::class, 'concluir'])->name('conclui-agendamento');
// atualiza agendamento
Route::put('/agendamento/atualizar/{id}', [AgendamentoController::class,'updateAgendamento'])->name('update-agendamento');
// atualiza pet
Route::put('/pet/atualizar/{id}', [PetController::class, 'updatePet'])->name('atualiza-pet');
// atualizar usuario
Route::put('/usuarios/atualizar/{id}', [UsuarioController::class, 'updateUser'])->name('atualiza-user');