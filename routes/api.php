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

//RUTAS DE TAGS
Route::get("/tag", [TagController::class,"index"]);
Route::get("/tag/{id}", [TagController::class,"show"]);
Route::post("/tag", [TagController::class,"store"]);
Route::put("/tag/{id}", [TagController::class,"update"]);
Route ::delete("/tag/{id}", [TagController::class,"destroy"]);