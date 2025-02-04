<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AplicacionController;

Route::get('/test', function () {
    return response()->json(['message' => 'Ruta API funcionando']);
});

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas para gestión de vacantes
    Route::get('/vacantes', [VacanteController::class, 'index']); // Listar vacantes
    Route::get('/vacantes/{id}', [VacanteController::class, 'show']); // Ver vacante específica
    Route::post('/vacantes', [VacanteController::class, 'store']); // Crear vacante
    Route::put('/vacantes/{id}', [VacanteController::class, 'update']); // Editar vacante
    Route::delete('/vacantes/{id}', [VacanteController::class, 'destroy']); // Eliminar vacante

    // Rutas para aplicaciones a vacantes
    Route::post('/vacantes/{vacante_id}/aplicar', [AplicacionController::class, 'store']); // Aplicar a vacante
    Route::put('/aplicaciones/{id}', [AplicacionController::class, 'update']); // Modificar estado de aplicación
    Route::get('/mis-aplicaciones', [AplicacionController::class, 'misAplicaciones']); // Ver aplicaciones del candidato
    Route::get('/vacantes/{vacante_id}/aplicaciones', [AplicacionController::class, 'aplicacionesPorVacante']); // Ver aplicaciones de una vacante
});