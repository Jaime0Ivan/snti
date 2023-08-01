<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MensajeController;   

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('categories', CategoryController::class)->names('admin.categories');

Route::resource('posts', PostController::class)->names('admin.posts');

Route::resource('mensajes', MensajeController::class)->names('admin.mensajes');

Route::delete('/admin/images/{image}', [PostController::class, 'destroyImage'])->name('admin.images.destroy');

/* Route::resource('mensajes', MensajeController::class)->names('admin.images'); */