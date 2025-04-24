<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RUTAS DE CATEGORIES
Route::get("/category", [CategoryController::class,"index"]);
Route::get("/category/{id}", [CategoryController::class,"show"]);
Route::post("/category", [CategoryController::class,"store"]);
Route::put("/category/{id}", [CategoryController::class,"update"]);
Route::delete("/category/{id}", [CategoryController::class,"destroy"]);

