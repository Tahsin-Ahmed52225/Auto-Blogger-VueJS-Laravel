<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\{AuthController, RoleController, UserController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get("/health", function () {
    return response()->json(["message" => "API is working fine."]);
});
Route::group(['middleware' => ['cors']], function () {
    # Public routes
    Route::post('/login', [AuthController::class, 'login'])->name("login");
    Route::post('/register', [AuthController::class, 'register'])->name("register");
    # Auth routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        # User Routes
        Route::get('/users', [UserController::class, 'index'])->name("index");
        Route::get('/user/{id}', [UserController::class, 'show'])->name("show");
        Route::post('/user', [UserController::class, 'create'])->name("create");
        Route::put('/user/{id}', [UserController::class, 'edit'])->name("edit");
        Route::delete('/user/{id}', [UserController::class, 'delete'])->name("edit");
        # Role Routes
        Route::get('/roles', [RoleController::class, 'index'])->name("role.index");
        Route::get('/role/{id}', [RoleController::class, 'show'])->name("role.show");
        Route::put('/role/{id}', [RoleController::class, 'edit'])->name("role.edit");
        Route::delete('/role/{id}', [RoleController::class, 'delete'])->name("role.delete");
        # Permisson Routes
        // Route::get('/permissons', [PermissonController::class, 'index'])->name("permisson.index");
        // Route::get('/perisson/{id}', [PermissonController::class, 'show'])->name("permisson.show");
        // Route::put('/permisson/{id}', [PermissonController::class, 'edit'])->name("permisson.edit");
        // Route::delete('/permisson/{id}', [PermissonController::class, 'delete'])->name("permisson.delete");

        # logout route
        Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
    });
});

