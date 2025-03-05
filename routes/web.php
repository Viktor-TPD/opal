<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::view('/', 'home')
    ->middleware('auth')
    ->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('show.register');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('show.login');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    // php artisan route:list
    // TO SEE THE ROUTES OF CATEGORIES

    Route::controller(ProductController::class)
        ->prefix('products')
        ->name('products.')
        ->group(function () {

            Route::get('/', [ProductController::class, 'index'])
                ->name('index');

            Route::get('/create', [ProductController::class, 'create'])
                ->name('create');

            Route::post('/store', [ProductController::class,  'store'])
                ->name('store');

            Route::get('/{product}', [ProductController::class, 'show'])
                ->name('show');

            Route::get('/{product}/edit', [ProductController::class, 'edit'])
                ->name('edit');

            Route::patch('/{product}', [ProductController::class, 'update'])
                ->name('update');

            Route::delete('/{product}', [ProductController::class, 'destroy'])
                ->name('destroy');
        });
});
