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
    //drones routes
Route::get('/drones' , [DroneController::class,'index']);
Route::post('/drones' , [DroneController::class,'store']);
Route::get('/drones/{codename}' , [DroneController::class,'getDroneByCodeName']);
Route::get('/drones/{codename}/{location}' , [DroneController::class,'showDroneLocation']);

// maps
Route::get('/maps' , [MapController::class,'index']);
Route::post('/maps' , [MapController::class,'store']);
Route::put('/maps/{id}' , [MapController::class,'update']);
Route::delete('/maps/{id}' , [MapController::class,'destroy']);

// farms routes
Route::get('/farms' , [FarmController::class,'index']);
Route::post('/farms' , [FarmController::class,'store']);
Route::put('/farms/{id}' , [FarmController::class,'update']);
Route::delete('/farms/{id}' , [FarmController::class,'delete']);
Route::get('/maps/{map}/$farm_id' , [FarmController::class,'getImage']);
Route::post('/maps/{map}/$farm_id' , [FarmController::class,'setImageBy']);
Route::put('/maps/{map}/$farm_id' , [FarmController::class,'setImageBy']);
Route::delete('/maps/{map}/$farm_id' , [FarmController::class,'deleteImageBy']);

// user routes
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// plan routes
Route::get('/plans', [PlanController::class, 'index']);
Route::post('/plans/plan', [PlanController::class, 'store']);
Route::put('/plans/{id}', [PlanController::class, 'update']);
Route::delete('/plans/{id}', [PlanController::class, 'destroy']);

// instruction routes
Route::get('/instructions', [InstructionController::class, 'index']);
Route::put('/drones/{instruction}', [InstructionController::class, 'update']);
Route::get('/plans/{codeName}', [InstructionController::class, 'getPlanBy']);

//location routes
Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations', [LocationController::class, 'store']);
Route::put('/locations/{id}', [LocationController::class, 'update']);
Route::delete('/locations/{id}', [LocationController::class, 'destroy']);

});

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);


