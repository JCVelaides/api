<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FincaController;

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



Route::group([
    'prefix'=>'auth'
],function () {
    Route::get('index', [FincaController::class, 'index']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('crear-finca', [FincaController::class, 'crearFinca']);
    Route::put('editar-finca/{id}', [FincaController::class, 'editarFinca']);
    Route::put('delete/{id}', [FincaController::class, 'destroy']);
});
