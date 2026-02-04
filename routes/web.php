<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DishLikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Protected routes (authentication required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [DishController::class, 'index'])
        ->name('home');

    Route::resource('dish', DishController::class);

    Route::post('/dishes/{dish}/toggle', [DishLikeController::class, 'toggle'])
        ->name('dishes.toggle');
});

/*
|--------------------------------------------------------------------------
| Admin routes (authentication + admin role required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dishes/admin', [DishController::class, 'admin'])
        ->name('dishes.admin');
});
