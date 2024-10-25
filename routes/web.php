<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    Log::info('Trasa /test została wywołana');
    return response()->json(['message' => 'Hello from Laravel API']);
});
