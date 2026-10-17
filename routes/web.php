<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockMovementController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalProducts' => DB::table('products')->count(),
            'totalCategories' => DB::table('categories')->count(),
            'totalSuppliers' => DB::table('suppliers')->count(),
            'lowStock' => DB::table('products')
                ->whereColumn('stock', '<=', 'minimum_stock')
                ->count(),
        ]);
    })->name('dashboard');

    Route::resource('products', ProductController::class)
        ->except(['show']);

    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    Route::resource('suppliers', SupplierController::class)
        ->except(['show']);

    Route::get('/stock', [StockMovementController::class, 'index'])
        ->name('stock.index');

    Route::get('/stock/create', [StockMovementController::class, 'create'])
        ->name('stock.create');

    Route::post('/stock', [StockMovementController::class, 'store'])
        ->name('stock.store');
});
