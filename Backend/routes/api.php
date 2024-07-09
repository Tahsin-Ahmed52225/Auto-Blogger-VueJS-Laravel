<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get("/health", function () {
    return response()->json(["message" => "API is working fine."]);
});
Route::group(['middleware' => ['cors']], function () {
    #Auth Routes
    Route::post('/login', [AuthController::class, 'login'])->name("login");
    Route::post('/register', [AuthController::class, 'register'])->name("register");
    Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
});

