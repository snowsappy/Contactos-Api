<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::preffix('v1')->group(function(){
    
Route::get('/contactos', [ContactoController::class, 'obtenercontactos'])->middleware('auth:sanctum');

Route::get('/contactos/{id}', [ContactoController::class, 'obtenerContactosPorId']);

Route::post('/contactos', [ContactoController::class, 'agregarContatos']);

Route::post('/contactos/{id}', [ContactoController::class, 'modificarContatos']);

Route::delete('/contactos/{id}', [ContactoController::class, 'eliminarContatos']);

Route::post('/usuario', [AuthController::class])->middleware('auth:sanctum');
});
