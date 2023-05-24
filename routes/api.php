<?php

use App\Http\Controllers\DroneController;
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

//drones
Route::get('/drones' , [DroneController::class,'index']);
Route::get('/drones/{codename}' , [DroneController::class,'getDroneBy']);
Route::get('/drones/{codename}/{location}' , [DroneController::class,'showDroneLocation']);
Route::post('/drones' , [DroneController::class,'store']);