<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name("home");
Route::post('store', [StudentController::class, 'store'])->name("store");

Route::get('edit/{id}', [StudentController::class, 'edit'])->name("edit");
Route::post('update{id}', [StudentController::class, 'update'])->name("update");

Route::get('delete/{id}', [StudentController::class, 'delete'])->name("delete");
