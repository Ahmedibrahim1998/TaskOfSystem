<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PostsController; // Fixed the controller name
use App\Http\Controllers\CommentController;

// Public routes
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    // Public read-only routes
    Route::get('/posts', [PostsController::class, 'index']);       // List all posts
    Route::get('/posts/{post}', [PostsController::class, 'show']); // Show single post
    // Protected post routes
    Route::post('/posts', [PostsController::class, 'store']);
    Route::put('/posts/{post}', [PostsController::class, 'update']);
    Route::delete('/posts/{post}', [PostsController::class, 'destroy']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    // Protected post routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
});