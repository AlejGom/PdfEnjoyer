<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbaranController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/saludo', [AlbaranController::class, 'mostrarSaludo']);

Route::get('/contratos', [AlbaranController::class,'index']);

Route::get('/contratos/{id}', [AlbaranController::class,'show']);

Route::post('/CrearAlbaran', [AlbaranController::class,'store']);


