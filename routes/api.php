<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    
Route::get('/contactos', [ContactoController::class, 'obtenercontactos'])->middleware('auth:sanctum');
//solo prueba
Route::get('/contactos/general',[ContactoController::class, 'obtener']);

Route::get('/contactos/{id}',[ContactoController::class, 'obtenerContactoPorId'])->middleware('auth:sanctum');

Route::post('/contactos',[ContactoController::class, 'agregarContatos'])->middleware('auth:sanctum');;

Route::patch('/contactos/{id}',[ContactoController::class, 'modificarContatos'])->middleware('auth:sanctum');;

Route::delete('/contactos/{id}',[ContactoController::class, 'eliminarContatos'])->middleware('auth:sanctum');;
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
Route::post('/login/usuario',[AuthController::class,'login'])->middleware();
});



