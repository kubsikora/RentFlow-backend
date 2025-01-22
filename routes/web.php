<?php

use App\Http\Controllers\MessegesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PlacesController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', function () {
    return response()->json(['message' => 'Hello from Laravel API']);
});

Route::get('/user/exist/{login}', [UsersController::class, 'check']);
Route::get('/user/store/{data}', [UsersController::class, 'storeOwner']);
Route::get('/user/login/login={login}&password={password}', [UsersController::class, 'login']);
Route::get('/account/settings/{data}', [UsersController::class, 'AccountDataChange']);
Route::get('/dele/account/id={id}&password={password}', [UsersController::class, 'DeleteAccount']);
Route::get('/account/prepersettings/{id}', [UsersController::class, 'GetAccountData']);
Route::get('/get/owner/flats/id={id}', [PlacesController::class, 'getOwnerFlat']);
Route::get('/get/owner/flats/info/id={id}', [PlacesController::class, 'getFlatData']);
Route::get('/find/user/val={val}', [UsersController::class, 'GetUsers']);
Route::get('/add/flats/id={id}&user={login}&data={data}&rooms={rooms}', [PlacesController::class, 'addToFlat']);
Route::get('/save/flat/user&rooms={room}&to={to}&id={id}', [PlacesController::class, 'editResident']);

Route::get('/counters/get/counters/place_id={place_id}', [CountersController::class, 'getPlaceLastCountersRead']);

Route::get('/get/flats$owner={owner}&id={id}', [PlacesController::class, 'getallflats']);


//messeges 
Route::get('/message/add&messege={messege}&to={to}&level={level}&idPlace=${idPlace}$from=${from}', [MessegesController::class, 'add']);
