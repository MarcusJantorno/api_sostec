<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AparelhoController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ContratoEmpresaController;
use App\Http\Controllers\FaturaContratoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clientes', "App\Http\Controllers\ClienteController@index");
Route::post('/clientes', "App\Http\Controllers\ClienteController@store");
Route::put('/clientes/{id}', "App\Http\Controllers\ClienteController@update");

Route::get('/aparelhos', "App\Http\Controllers\AparelhoController@index");
Route::post('/aparelhos', "App\Http\Controllers\AparelhoController@store");
Route::put('/aparelhos/{id}', "App\Http\Controllers\AparelhoController@update");

Route::get('/cartoes', "App\Http\Controllers\CartaoController@index");
Route::post('/cartoes', "App\Http\Controllers\CartaoController@store");
Route::put('/cartoes/{id}', "App\Http\Controllers\CartaoController@update");

Route::get('/contratos', "App\Http\Controllers\ContratoController@index");
Route::post('/contratos', "App\Http\Controllers\ContratoController@store");
Route::put('/contratos/{id}', "App\Http\Controllers\ContratoController@update");

Route::get('/contratosempresa', "App\Http\Controllers\ContratoEmpresaController@index");
Route::post('/contratosempresa', "App\Http\Controllers\ContratoEmpresaController@store");
Route::put('/contratosempresa/{id}', "App\Http\Controllers\ContratoEmpresaController@update");

Route::get('/faturascontrato', "App\Http\Controllers\FaturaContratoController@index");
Route::post('/faturascontrato', "App\Http\Controllers\FaturaContratoController@store");
Route::get('/maxfaturascontrato/{id}', "App\Http\Controllers\FaturaContratoController@maxData");
Route::put('/faturascontrato/{id}', "App\Http\Controllers\FaturaContratoController@update");

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', 'App\Http\Controllers\UserController@user');
    Route::get('logout', 'App\Http\Controllers\UserController@logout');
});
