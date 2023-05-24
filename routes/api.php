<?php

use App\Http\Controllers\DroneController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('post', PostController::class);
    Route::post('/logout',[AuthenticationController::class, 'logout']);
});

// account routes
Route::post('/login',[AuthenticationController::class, 'login']);
Route::post('/register',[AuthenticationController::class, 'register']);

//drones routes
Route::get('/drones' , [DroneController::class,'index']);
Route::get('/drones/{codename}' , [DroneController::class,'getDroneBy']);
Route::get('/drones/{codename}/{location}' , [DroneController::class,'showDroneLocation']);
Route::post('/drones' , [DroneController::class,'store']);

// maps routes
Route::get('/maps' , [MapController::class,'index']);
Route::post('/maps' , [MapController::class,'store']);

// farms routes
Route::get('/farms' , [FarmController::class,'index']);
Route::post('/farms' , [FarmController::class,'store']);