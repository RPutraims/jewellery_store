<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;

use Illuminate\Support\Facades\Route;

Route::get('/env-test', function () {
    return env('APP_KEY');
});

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Review routes 
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/products/{product}/reviews', [ReviewController::class, 'byProduct'])->name('reviews.byProduct');
Route::get('/reviews/filter', [ReviewController::class, 'byFilter'])->name('reviews.byFilter');

Route::middleware(['auth'])->group(function () {
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{cartKey}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartKey}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');//category/{categoryId}', [ProductController::class, 'byCategory'])->name('products.by-category');

Route::get('/products/category/{id}', [ProductController::class, 'byCategory'])->name('products.byCategory');

Route::resource('products', ProductController::class);

require __DIR__.'/auth.php';
