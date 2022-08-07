<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CanalController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return ' New Discord 2.0';
});

Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(
    ['middleware' => 'jwt.auth'],
    function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    }
);
Route::group(
    [],
    function() {
        Route::get('/Canal', [CanalController::class, 'getAllCanal']);
        Route::get('/Canal/{id}', [CanalController::class, 'getCanalbyId']);
        Route::get('/Canal/game/{id}', [CanalController::class, 'getCanalbyJuegoId']);
        Route::post('/Canal', [CanalController::class, 'createCanal'])->middleware('jwt.auth');
        Route::put('/Canal/{id}', [CanalController::class, 'updateCanal'])->middleware('jwt.auth');
        Route::delete('/Canal/{id}', [CanalController::class, 'deleteCanal'])->middleware('jwt.auth');
    }
);

Route::group(
    [],
    function() {
        Route::get('/Juegos', [JuegoController::class, 'getAllJuegos']);
        Route::get('/Juegos/{id}', [JuegoController::class, 'getJuegosbyId']);
        Route::post('/Juegos', [JuegoController::class, 'createJuegos'])->middleware('jwt.auth');
        Route::put('/Juegos/{id}', [JuegoController::class, 'updateJuegos'])->middleware('jwt.auth');
        Route::delete('/Juegos/{id}', [JuegoController::class, 'deleteJuegos'])->middleware('jwt.auth');
    }
);

Route::group(
    [],
    function(){
        Route::get('Mensaje', [MensajeController::class, 'getAllMensaje']);
        Route::get('Mensaje/{id}', [MensajeController::class, 'getMensajebyId']);
        Route::post('Mensaje', [MensajeController::class, 'createMensaje'])->middleware('jwt.auth');
        Route::put('Mensaje/{id}', [MensajeController::class, 'updateMensaje'])->middleware('jwt.auth');
        Route::delete('Mensaje/{id}', [MensajeController::class, 'deleteMensaje'])->middleware('jwt.auth');
    }
);