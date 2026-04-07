<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::put('/user/soft-delete/{user}', [UserController::class, 'softDelete'])->name('user.soft-delete');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
