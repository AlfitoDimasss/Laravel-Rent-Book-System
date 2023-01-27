<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

// ANYONE CAN ACCESS
Route::get('/', [PublicController::class, 'index']);
Route::get('/all', [PublicController::class, 'all']);

// ONLY UNAUTHENTICATED USERS CAN ACCESS
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);

    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

// ONLY AUTHENTICATED USERS CAN ACCESS
Route::middleware('auth')->group(function () {
    Route::get('/rent-logs', [RentLogController::class, 'index']);
    Route::get('/rent-log-add', [RentLogController::class, 'create']);
    Route::post('/rent-log-add', [RentLogController::class, 'store']);
    Route::put('/rent-log-borrow/{slug}', [RentLogController::class, 'borrow']);
    Route::put('/rent-log-return/{slug}', [RentLogController::class, 'return']);

    Route::get('/profile', [UserController::class, 'profile'])->middleware('only_user');

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware('only_admin')->group(function () {
        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // BOOKS ROUTE
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/book-add', [BookController::class, 'create']);
        Route::post('/book-add', [BookController::class, 'store']);
        Route::get('/book-edit/{slug}', [BookController::class, 'edit']);
        Route::put('/book-edit/{slug}', [BookController::class, 'update']);
        Route::delete('/book-delete/{slug}', [BookController::class, 'destroy']);

        // CATEGORIES ROUTE
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/category-add', [CategoryController::class, 'create']);
        Route::post('/category-add', [CategoryController::class, 'store']);
        Route::get('/category-edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('/category-edit/{slug}', [CategoryController::class, 'update']);
        Route::delete('/category-delete/{slug}', [CategoryController::class, 'destroy']);

        // USERS ROUTE
        Route::get('/users', [UserController::class, 'index']);
        Route::put('/user-approve/{slug}', [UserController::class, 'approve']);
        Route::put('/user-ban/{slug}', [UserController::class, 'ban']);
        Route::delete('/user-delete/{slug}', [UserController::class, 'destroy']);

        // RENT-LOGS ROUTE
        // Route::get('/rent-logs', [RentLogController::class, 'index']);
    });
});
