<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//RUTAS DE TASK 
Route::get("/task", [TaskController::class,"index"]);
Route::get("/task/{id}", [TaskController::class,"show"]);
Route::post("/task", [TaskController::class,"store"]);
Route::put("/task/{id}", [TaskController::class,"update"]);

//RUTAS DE TAGS
Route::get("/tag", [TagController::class,"index"]);
Route::get("/tag/{id}", [TagController::class,"show"]);
Route::post("/tag", [TagController::class,"store"]);
Route::put("/tag/{id}", [TagController::class,"update"]);

//RUTAS DE CATEGORIES
Route::get("/category", [CategoryController::class,"index"]);
Route::get("/category/{id}", [CategoryController::class,"show"]);
Route::post("/category", [CategoryController::class,"store"]);
Route::put("/category/{id}", [CategoryController::class,"update"]);