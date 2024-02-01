<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Serviço

Route::post('service', [ServicoController::class, 'servico']);

Route::get('service/find/{id}', [ServicoController::class, 'servicoId']);

Route::post('service/name', [ServicoController::class, 'servicoNome']);

Route::post('service/description', [ServicoController::class, 'servicoDescricao']);

Route::get('service/all', [ServicoController::class, 'servicoRetornar']);

Route::delete('service/delete/{id}', [ServicoController::class, 'servicoExcluir']);

Route::put('service/update', [ServicoController::class, 'servicoUpdate']);




//Cliente

Route::post('client', [ClienteController::class, 'cliente']);

Route::get('client/find/{id}', [ClienteController::class, 'clienteId']);

Route::post('client/name', [ClienteController::class, 'clienteNome']);

Route::post('client/cpf', [ClienteController::class, 'clienteCpf']);

Route::post('client/cellphone', [ClienteController::class, 'clienteCelular']);

Route::post('client/email', [ClienteController::class, 'clienteEmail']);

Route::get('client/all', [ClienteController::class, 'clienteRetornar']);

Route::delete('client/delete/{id}', [ClienteController::class, 'clienteExcluir']);

Route::put('client/update', [ClienteController::class, 'clienteUpdate']);

Route::post('client/restore', [ClienteController::class, 'clienteRestaurar']);




//Profissional

Route::post('professional', [ProfissionalController::class, 'profissional']);

Route::get('professional/find/{id}', [ProfissionalController::class, 'profissionalId']);

Route::post('professional/name', [ProfissionalController::class, 'profissionalNome']);

Route::post('professional/cpf', [ProfissionalController::class, 'profissionalCpf']);

Route::post('professional/cellphone', [ProfissionalController::class, 'profissionalCelular']);

Route::post('professional/email', [ProfissionalController::class, 'profissionalEmail']);

Route::get('professional/all', [ProfissionalController::class, 'profissionalRetornar']);

Route::delete('professional/delete/{id}', [ProfissionalController::class, 'profissionalExcluir']);

Route::put('professional/update', [ProfissionalController::class, 'profissionalUpdate']);

Route::post('professional/restore', [ProfissionalController::class, 'profissionalRestaurar']);




//Agenda

Route::post('schedule', [AgendaController::class, 'agenda']);

Route::get('schedule/all', [AgendaController::class, 'agendaRetornar']);

Route::delete('schedule/delete/{id}', [AgendaController::class, 'agendaExcluir']);

Route::put('schedule/update', [AgendaController::class, 'agendaUpdate']);

Route::post('schedule/time', [AgendaController::class, 'agendaTimeProfissional']);

Route::post('schedule/find', [AgendaController::class, 'agendaFind']);

Route::post('schedule/date', [AgendaController::class, 'agendaFindData']);

Route::get('schedule/find/{id}', [AgendaController::class, 'agendaId']);

Route::post('schedule/find/time/professional', [AgendaController::class, 'agendaFindTimeProfissional']);



//Pagamento

Route::post('payment', [PagamentoController::class, 'pagamento']);

Route::put('payment/update', [PagamentoController::class, 'pagamentoUpdate']);

Route::get('payment/all', [PagamentoController::class, 'pagamentoRetornar']);

Route::get('payment/all/active', [PagamentoController::class, 'pagamentoRetornarAtivos']);

Route::get('payment/all/inactive', [PagamentoController::class, 'pagamentoRetornarInativos']);

Route::post('payment/name', [PagamentoController::class, 'pagamentoNome']);

Route::delete('payment/delete/{id}', [PagamentoController::class, 'pagamentoExcluir']);

//------------------------------------------- PROFISSIONAL -------------------------------------------//

//Cliente--Profissional

Route::post('professional/client', [ClienteController::class, 'cliente']);

//Agenda--Profissional

Route::post('professional/schedule/time', [AgendaController::class, 'agendaTimeProfissional']);


//------------------------------------------- ADMNISTRADOR -------------------------------------------//

Route::post('adm', [AdministradorController::class, 'administrador']);

Route::post('adm/cpf', [AdministradorController::class, 'administradorCpf']);

Route::put('adm/update', [AdministradorController::class, 'administradorUpdate']);

Route::delete('adm/delete/{id}', [AdministradorController::class, 'administradorExcluir']);

Route::get('adm/all', [AdministradorController::class, 'administradorRetornar']);

Route::post('adm/restore', [AdministradorController::class, 'administradorRestaurar']);

//Serviço--ADMNISTRADOR

Route::post('adm/service', [ServicoController::class, 'servico']);

Route::get('adm/service/find/{id}', [ServicoController::class, 'servicoId']);

Route::post('adm/service/name', [ServicoController::class, 'servicoNome']);

Route::post('adm/service/description', [ServicoController::class, 'servicoDescricao']);

Route::get('adm/service/all', [ServicoController::class, 'servicoRetornar']);

Route::delete('adm/service/delete/{id}', [ServicoController::class, 'servicoExcluir']);

Route::put('adm/service/update', [ServicoController::class, 'servicoUpdate']);




//Cliente--ADMNISTRADOR

Route::post('adm/client', [ClienteController::class, 'cliente']);

Route::get('adm/client/find/{id}', [ClienteController::class, 'clienteId']);

Route::post('adm/client/name', [ClienteController::class, 'clienteNome']);

Route::post('adm/client/cpf', [ClienteController::class, 'clienteCpf']);

Route::post('adm/client/cellphone', [ClienteController::class, 'clienteCelular']);

Route::post('adm/client/email', [ClienteController::class, 'clienteEmail']);

Route::get('adm/client/all', [ClienteController::class, 'clienteRetornar']);

Route::delete('adm/client/delete/{id}', [ClienteController::class, 'clienteExcluir']);

Route::put('adm/client/update', [ClienteController::class, 'clienteUpdate']);

Route::post('adm/client/restore', [ClienteController::class, 'clienteRestaurar']);




//Profissional--ADMNISTRADOR

Route::post('adm/professional', [ProfissionalController::class, 'profissional']);

Route::get('adm/professional/find/{id}', [ProfissionalController::class, 'profissionalId']);

Route::post('adm/professional/name', [ProfissionalController::class, 'profissionalNome']);

Route::post('adm/professional/cpf', [ProfissionalController::class, 'profissionalCpf']);

Route::post('adm/professional/cellphone', [ProfissionalController::class, 'profissionalCelular']);

Route::post('adm/professional/email', [ProfissionalController::class, 'profissionalEmail']);

Route::get('adm/professional/all', [ProfissionalController::class, 'profissionalRetornar']);

Route::delete('adm/professional/delete/{id}', [ProfissionalController::class, 'profissionalExcluir']);

Route::put('adm/professional/update', [ProfissionalController::class, 'profissionalUpdate']);

Route::post('adm/professional/restore', [ProfissionalController::class, 'profissionalRestaurar']);




//Agenda--ADMNISTRADOR

Route::post('adm/schedule', [AgendaController::class, 'agenda']);

Route::get('adm/schedule/all', [AgendaController::class, 'agendaRetornar']);

Route::delete('adm/schedule/delete/{id}', [AgendaController::class, 'agendaExcluir']);

Route::put('adm/schedule/update', [AgendaController::class, 'agendaUpdate']);

Route::post('adm/schedule/time', [AgendaController::class, 'agendaTimeProfissional']);

Route::post('adm/schedule/find', [AgendaController::class, 'agendaFind']);

Route::post('adm/schedule/date', [AgendaController::class, 'agendaFindData']);

Route::get('adm/schedule/find/{id}', [AgendaController::class, 'agendaId']);

Route::post('adm/schedule/find/time/professional', [AgendaController::class, 'agendaFindTimeProfissional']);




//Pagamento--ADMNISTRADOR

Route::post('adm/payment', [PagamentoController::class, 'pagamento']);

Route::put('adm/payment/update', [PagamentoController::class, 'pagamentoUpdate']);

Route::get('adm/payment/all', [PagamentoController::class, 'pagamentoRetornar']);

Route::post('adm/payment/name', [PagamentoController::class, 'pagamentoNome']);

Route::delete('adm/payment/delete/{id}', [PagamentoController::class, 'pagamentoExcluir']);