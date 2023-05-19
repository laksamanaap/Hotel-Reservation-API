<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
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

// Hotel Payment
Route::post('/hotels/payment', [PaymentController::class, 'store']);

Route::get('/hotels/payment', [PaymentController::class, 'index']);

Route::get('/hotels/payment/{payment_type_id}', [PaymentController::class, 'show']);

// Hotel Payment

// Booking API
Route::post('/hotels/booking', [BookingController::class, 'store']);

Route::get('/hotels/booking', [BookingController::class, 'index']);

Route::get('/hotels/booking/{hotel_id}', [BookingController::class, 'bookings']);
// Booking API

// Room API
Route::post('/hotels/rooms', [RoomController::class, 'store']);

Route::get('/hotels/rooms', [RoomController::class, 'index']);
// Room API

// Categories API
Route::post('/hotels/categories', [CategoryController::class, 'store']);

Route::get('/hotels/categories', [CategoryController::class, 'index']);

Route::get('/hotels/categories/{categories_id}', [CategoryController::class, 'rooms']);
// Categories API


// CRUD Hotel Api
Route::post('/hotels', [HotelController::class, 'store']);

Route::put('/hotels/{hotel_id}', [HotelController::class, 'update']);

Route::delete('/hotels/{hotel_id}', [HotelController::class, 'destroy']);

Route::get('/hotels/{hotel_id}', [HotelController::class, 'show']);

Route::get('/hotels', [HotelController::class, 'index']);

Route::get('/hotels/{hotel_id}', [CategoryController::class, 'categories']);

// CRUD Hotel Api


// Auth API
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
// Auth API


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


