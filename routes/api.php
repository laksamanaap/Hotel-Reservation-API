<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CategoryController;

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


// Room API

Route::post('/hotels/rooms', [RoomController::class, 'store']);

Route::get('/hotels/rooms', [RoomController::class, 'index']);

// Room API

// Categories API

Route::post('/hotels/categories', [CategoryController::class, 'store']);

Route::get('/hotels/categories', [CategoryController::class, 'index']);

Route::get('/hotels/categories/{id}', [CategoryController::class, 'room']);

// Categories API


// CRUD Api
Route::post('/hotels', [HotelController::class, 'store']);

Route::put('/hotels/{id}', [HotelController::class, 'update']);

Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);

Route::get('/hotels/{id}', [HotelController::class, 'show']);

Route::get('/hotels', [HotelController::class, 'index']);
// CRUD Api


// Auth API
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
// Auth API


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


