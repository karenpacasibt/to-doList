<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RUTAS DE CATEGORIES
Route::get("/category", [CategoryController::class,"index"]);
Route::get("/category/{id}", [CategoryController::class,"show"]);
Route::post("/category", [CategoryController::class,"store"]);
Route::put("/category/{id}", [CategoryController::class,"update"]);
Route::delete("/category/{id}", [CategoryController::class,"destroy"]);

//RUTAS DE TASK 
Route::get("/task", [TaskController::class,"index"]);
Route::get("/task/{id}", [TaskController::class,"show"]);
Route::post("/task", [TaskController::class,"store"]);
Route::put("/task/{id}", [TaskController::class,"update"]);
Route::delete( "/task/{id}",[TaskController::class,"destroy"]);