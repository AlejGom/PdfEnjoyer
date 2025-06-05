<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbaranWebController;

/* Route::get('/', function () {return view('index');}); */
Route::get('/', [AlbaranWebController::class, 'index']);

Route::get('albaran/{id}', [AlbaranWebController::class, 'show']);

Route::get('añadirAlbaran', [AlbaranWebController::class, 'create']);


