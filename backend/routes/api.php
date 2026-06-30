<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JogoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PalpiteController;

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


Route::get('jogo-teste', [JogoController::class,'teste']);
Route::get('jogos', [JogoController::class,'index']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('palpites', [PalpiteController::class, 'store']);
    Route::get('palpites', [PalpiteController::class, 'index']);
    Route::post('/jogos/{id}/encerrarPartida', [JogoController::class, 'encerrarPartida']);

    Route::get('/ranking', [PalpiteController::class, 'ranking']);
});
