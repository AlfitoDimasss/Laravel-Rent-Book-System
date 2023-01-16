<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/books');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('only_admin');
    Route::get('/profile', [UserController::class, 'profile'])->middleware('only_user');

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/book-add', [BookController::class, 'create']);
    Route::post('/book-add', [BookController::class, 'store']);
    Route::get('/book-edit/{slug}', [BookController::class, 'edit']);
    Route::put('/book-edit/{slug}', [BookController::class, 'update']);
    Route::delete('/book-delete/{slug}', [BookController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category-add', [CategoryController::class, 'create']);
    Route::post('/category-add', [CategoryController::class, 'store']);
    Route::get('/category-edit/{slug}', [CategoryController::class, 'edit']);
    Route::put('/category-edit/{slug}', [CategoryController::class, 'update']);
    Route::delete('/category-delete/{slug}', [CategoryController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/rent-logs', [RentLogController::class, 'index']);
});
