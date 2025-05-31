<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/products', function () {
    return view('layouts.products');
});

Route::get('/products', function () {
    return view('layouts.products');
});


Route::get('/products', function () {
    return view('layouts.products');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products/category/{id}', [ProductController::class, 'byCategory'])->name('products.byCategory');

require __DIR__.'/auth.php';
