<?php

use App\Http\Controllers\Api\AdditionalServiceController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\KidController;
use App\Http\Controllers\Api\KidServiceController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicesDataController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('services/get_locations/{service}', [ServiceController::class, 'getLocations']);
Route::get('kid_services/add', [KidController::class, 'create']);
Route::get('kid_services/add/search/{kid}/{service_type}', [KidController::class, 'search']);
Route::get('kid_services/add/report/{service}/{date_from}/{date_to}', [KidServiceController::class, 'report']);

Route::apiResource('additional_services', AdditionalServiceController::class);
Route::apiResource('cards', CardController::class);
Route::apiResource('equips', EquipController::class);
Route::apiResource('kids', KidController::class);
Route::apiResource('kid_services',KidServiceController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('data', ServicesDataController::class);
Route::apiResource('navbars', NavbarController::class);
