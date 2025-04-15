<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class,'welcome'])->name('welcome');

// Route::get('/task', [TaskController::class,'index'])->name('task.index');
// Route::get('/task/create',[TaskController::class,'create'])->name('task.create');
// Route::post('/task', [TaskController::class,'store'])->name('task.store');
// Route::get('/task/{id}', [TaskController::class,'show'])->name('task.show');
// Route::get('/task/{id}/edit', [TaskController::class,'edit'])->name('task.edit');
// Route::put('/task/{id}', [TaskController::class,'update'])->name('task.up´date');
// Route::delete('/task/{id}', [TaskController::class,'destroy'])->name('task.destroy');

// TODAS LAS RUTAS ANTERIORES PUEDNE RESUMIRSE EN ESTA 
Route::resource('task', TaskController::class);