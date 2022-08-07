<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CanalController;
use Illuminate\Http\Request;
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
        Route::get('/Juegos', [GameController::class, 'getAllJuegos']);
        Route::get('/Juegos/{id}', [GameController::class, 'getJuegosbyId']);
        Route::post('/Juegos', [GameController::class, 'createJuegos'])->middleware('jwt.auth');
        Route::put('/Juegos/{id}', [GameController::class, 'updateJuegos'])->middleware('jwt.auth');
        Route::delete('/Juegos/{id}', [GameController::class, 'deleteJuegos'])->middleware('jwt.auth');
    }
);

Route::group(
    [],
    function(){
        Route::get('Mensaje', [MessageController::class, 'getAllMensaje']);
        Route::get('Mensaje/{id}', [MessageController::class, 'getMensajebyId']);
        Route::post('Mensaje', [MessageController::class, 'createMensaje'])->middleware('jwt.auth');
        Route::put('Mensaje/{id}', [MessageController::class, 'updateMensaje'])->middleware('jwt.auth');
        Route::delete('Mensaje/{id}', [MessageController::class, 'deleteMensaje'])->middleware('jwt.auth');
    }
);