<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::redirect('/', '/task')->name('dashboard');
//ESTA PARTE ES PARA AUTENTIFIACION DE USUARIOS PERO SE COMENTA PARA HACER PRUEBAS
//Route::middleware(['auth', 'verified'])->group(function () {
Route::resource('task', TaskController::class);
Route::resource('tag', TagController::class);
Route::resource('category', CategoryController::class);
Route::patch('/task/{task}/status', [TaskController::class, 'updateStatus'])->name('task.updateStatus');


//});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
