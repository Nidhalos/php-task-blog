<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page showing all published posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Post resource routes (CRUD operations)
Route::resource('posts', PostController::class);

// Additional routes for bonus features
Route::post('/posts/{post}/toggle', [PostController::class, 'togglePublish'])
    ->name('posts.toggle');

// If you want to add authentication later (optional)
// Route::middleware(['auth'])->group(function () {
//     Route::resource('posts', PostController::class)->except(['index', 'show']);
//     Route::post('/posts/{post}/toggle', [PostController::class, 'togglePublish'])
//         ->name('posts.toggle');
// });

// Route for handling search (optional - can also be handled through index)
Route::get('/posts/search', [PostController::class, 'index'])
    ->name('posts.search');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
