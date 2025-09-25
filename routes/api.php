<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromedioDolarController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Promedios mensuales
Route::get('/dolar/promedio-mensual', [PromedioDolarController::class, 'promedioMensual']);
// Histórico de cotizaciones
Route::get('/dolar/historico', [PromedioDolarController::class, 'historico']);