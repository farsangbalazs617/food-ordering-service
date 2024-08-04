<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/who-am-i', [AuthController::class, 'whoAmI']);

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
Route::get('/restaurants/{id}/menu', [RestaurantController::class, 'menu']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/restaurants/{id}/orders', [OrderController::class, 'restaurantOrders']);
Route::patch('/orders/{id}', [OrderController::class, 'update']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
