<?php

use App\Http\Controllers\Api\AdditionalServiceController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\KidController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\NavbarController;
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


Route::apiResource('additional_services', AdditionalServiceController::class);
Route::apiResource('cards', CardController::class);
Route::apiResource('equips', EquipController::class);
Route::apiResource('kids', KidController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('navbars', NavbarController::class);
