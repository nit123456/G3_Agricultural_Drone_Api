<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Models\Drone;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    //demo routes
    Route::get('/drones', [DroneController::class, 'index']);
    Route::get('/drones/{codename}', [DroneController::class, 'getDroneByCodeName']);
    Route::get('/drones/{codename}/{location}', [DroneController::class, 'showDroneLocation']);
    Route::get('/maps', [FarmController::class, 'getImage']);
    Route::get('/maps/{map}/{farm_id}', [FarmController::class, 'getImageBy']);
    Route::post('/plans/plan', [PlanController::class, 'store']);
    Route::put('/drones/{codeName}', [DroneController::class, 'runModel']);
    Route::delete('/maps/{map}/{farm_id}', [FarmController::class, 'deleteImageBy']);
<<<<<<< HEAD
    // drones routes
    Route::post('/drones', [DroneController::class, 'store']);
    // maps
    Route::post('/maps', [MapController::class, 'store']);
    Route::put('/maps/{id}', [MapController::class, 'update']);
    Route::delete('/maps/{id}', [MapController::class, 'destroy']);
    // farms routes
    Route::get('/farms', [FarmController::class, 'index']);
    Route::post('/farms', [FarmController::class, 'store']);
    Route::put('/farms/{id}', [FarmController::class, 'update']);
    Route::delete('/farms/{id}', [FarmController::class, 'delete']);
    Route::get('/maps/{map}/{farm_id}', [FarmController::class, 'getImageBy']);
    Route::put('/maps/{map}/farm_id', [FarmController::class, 'setImageBy']);

    // user routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);

    // plan routes
    Route::get('/plans', [PlanController::class, 'index']);
   
    Route::put('/plans/{id}', [PlanController::class, 'update']);
    Route::delete('/plans/{id}', [PlanController::class, 'destroy']);

    // instruction routes
    Route::get('/instructions', [InstructionController::class, 'index']);
    Route::post('/instructions ', [InstructionController::class, 'store']);
=======
    Route::get('/instructions', [InstructionController::class, 'index']);
>>>>>>> 30f52e73f580411c044fadf9f67b807bb5bee8ba
    Route::get('/plans/{codeName}', [InstructionController::class, 'getPlanByCodeName']);
    Route::post('/maps/{map}/{farm_id}', [FarmController::class, 'setImageBy']);
    Route::put('/drone/{id}/', [DroneController::class, 'update']);
});


Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::put('/drones/{codeName}', [DroneController::class, 'updateDrone']);
