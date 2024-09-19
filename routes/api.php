<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticulosApiController;
use App\Http\Controllers\ClientsApiController;
use App\Http\Controllers\PedidosApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors:CorsMiddleware')->get('enviar-clientes', [ClientsApiController::class,'sendData'])->name('send-clients');
Route::middleware('cors:CorsMiddleware')->get('enviar-articulos', [ArticulosApiController::class,'sendData'])->name('send-articles');
Route::middleware('cors:CorsMiddleware')->get('recibir-pedidos', [PedidosApiController::class,'sendData'])->name('send-orders');
