<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\DepartmentController;
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
Route::post('register',[MainController::class,'signup']);
Route::post('login',[MainController::class,'login']);
Route::post('logout',[MainController::class,'logout'])->middleware('auth:sanctum');
Route::apiResource('user', UserController::class)->middleware('auth:sanctum');
Route::apiResource('role', RoleController::class)->middleware('auth:sanctum');
Route::apiResource('department', DepartmentController::class)->middleware('auth:sanctum');
