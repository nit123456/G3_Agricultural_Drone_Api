<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Models\Instruction;
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
    Route::post('/logout',[AuthenticationController::class, 'logout']);

    Route::get('/drones' , [DroneController::class,'index']);
    Route::post('/drone' , [DroneController::class,'store']);
    Route::get('/drone/{id}', [DroneController::class, 'droneByID']);
    Route::put('/drone/{id}', [DroneController::class, 'updateDrone']);
    Route::get('/drones/{codename}' , [DroneController::class,'getDroneBy']);
    Route::get('/drones/{codename}/{location}' , [DroneController::class,'showDroneLocation']);

    Route::get('/maps' , [MapController::class,'index']);
    Route::post('/map' , [MapController::class,'store']);

    Route::get('/farms' , [FarmController::class,'index']);
    Route::post('/farm' , [FarmController::class,'store']);

    Route::post('/user', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);

    Route::get('/plans', [PlanController::class, 'index']);
    Route::post('/plans/plan', [PlanController::class, 'store']);

    Route::put('/instruction/{id}', [InstructionController::class, 'update']);
    Route::post('/instruction', [InstructionController::class, 'store']);

    Route::get('/locations', [LocationController::class, 'index']);
    Route::post('/location', [LocationController::class, 'store']);
});

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);



// farms routes








