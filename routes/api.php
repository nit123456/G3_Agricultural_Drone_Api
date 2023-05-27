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
    Route::get('/instructions', [InstructionController::class, 'index']);
    Route::get('/plans/{codeName}', [InstructionController::class, 'getPlanByCodeName']);
    Route::post('/maps/{map}/{farm_id}', [FarmController::class, 'setImageBy']);
    Route::put('/drone/{id}/', [DroneController::class, 'update']);
});


Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);
