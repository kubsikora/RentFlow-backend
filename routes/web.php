<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', function () {
    return response()->json(['message' => 'Hello from Laravel API']);
});

Route::get('/user/exist/{login}', [UsersController::class, 'check']);
Route::get('/user/store/{data}', [UsersController::class, 'storeOwner']);
Route::get('/user/login/login={login}&password={password}', [UsersController::class, 'login']);
