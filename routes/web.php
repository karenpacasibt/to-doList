<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::redirect('/','/task')->name('dashboard');
//ESTA PARTE ES PARA AUTENTIFIACION DE USUARIOS PERO SE COMENATAC PARA HACER PRUEBAS
//Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/task', [TaskController::class,'index'])->name('task.index');
    // Route::get('/task/create',[TaskController::class,'create'])->name('task.create');
    // Route::post('/task', [TaskController::class,'store'])->name('task.store');
    // Route::get('/task/{id}', [TaskController::class,'show'])->name('task.show');
    // Route::get('/task/{id}/edit', [TaskController::class,'edit'])->name('task.edit');
    // Route::put('/task/{id}', [TaskController::class,'update'])->name('task.up´date');
    // Route::delete('/task/{id}', [TaskController::class,'destroy'])->name('task.destroy');

    // TODAS LAS RUTAS ANTERIORES PUEDNE RESUMIRSE EN ESTA 
    Route::resource('task', TaskController::class);
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);

//});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
