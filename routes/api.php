<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContratoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/saludo', [ContratoController::class, 'mostrarSaludo']);

Route::post('/albaranes', [ContratoController::class,'store']);

Route::get('/contratos/{id}', [ContratoController::class,'show']);

Route::get('/contratos', [ContratoController::class,'showAll']);

