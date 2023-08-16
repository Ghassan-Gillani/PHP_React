<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\QueueController;


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




Route::get('/employees',[App\Http\Controllers\EmployeeController::class, 'index']);

Route::post('/save',[App\Http\Controllers\EmployeeController::class, 'store']);

Route::put('/update/{id}',[App\Http\Controllers\EmployeeController::class, 'update']);

Route::delete('/delete/{id}',[App\Http\Controllers\EmployeeController::class, 'destroy']);


Route::post('/add-to-queue', [QueueController::class, 'addToQueue']);
Route::get('/process-queue', [QueueController::class, 'processQueue']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
