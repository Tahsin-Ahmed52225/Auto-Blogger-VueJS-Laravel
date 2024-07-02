<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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


Route::get("/health", function () {
    return response()->json(["message" => "API is working fine."]);
});
# Auth routes
Route::post('/login', [AuthController::class, 'login'])->name("login");
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
Route::post('/register', [AuthController::class, 'register'])->name("register");
// Route::group(['middleware' => ['cors']], function () {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/logout', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'login']);
// });
# Post routes
# Category routes


