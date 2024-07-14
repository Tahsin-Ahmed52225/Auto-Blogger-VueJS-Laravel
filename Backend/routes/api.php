<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\{AuthController,UserController};

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
    Route::group(['middleware' => ['auth:sanctum']], function () {
        # User CRUD
        Route::get('/users', [UserController::class, 'getAllUsers'])->name("getAllUsers");
        Route::get('/user/{id}', [UserController::class, 'getUser'])->name("getUser");
        Route::put('/user', [UserController::class, 'updateUser'])->name("updateUser");
        Route::delete('/user', [UserController::class, 'deleteUser'])->name("deleteUser");
        # Role CRUD


        Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
    });
});

