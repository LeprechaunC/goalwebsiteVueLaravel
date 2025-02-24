<?php

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

use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PDFExportController;
use App\Http\Controllers\GoalController;

Route::middleware(['web'])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getUser'])->middleware('auth');
    Route::post('/update', [UserController::class, 'update']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::patch('/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin']);

 

    Route::get('/goals', [GoalController::class, 'index']); // <-- Add this line
    Route::post('/goals', [GoalController::class, 'store']); // Rename create -> store to match GoalController
 

Route::get('/goals', [GoalController::class, 'index']);
Route::post('/goals', [GoalController::class, 'store']);
Route::get('/goals/{id}', [GoalController::class, 'show']); // Fetch a single goal

    
});
