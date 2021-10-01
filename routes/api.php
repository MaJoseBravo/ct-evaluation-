<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('ListadoPerson', [App\Http\Controllers\PersonController::class, 'index']);
Route::post('IngresarPerson', [App\Http\Controllers\PersonController::class, 'store']);
Route::patch('ActualizarPerson', [App\Http\Controllers\PersonController::class, 'update']);
Route::delete('EliminarPerson', [App\Http\Controllers\PersonController::class, 'destroy']);
