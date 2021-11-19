<?php

use App\Http\Controllers\Stocks\StocksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/search', [StocksController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('stock.search');

Route::get('/search/{company}', [StocksController::class, 'showCompany'])
    ->middleware(['auth', 'verified'])
    ->name('company');

Route::get('/stocks', [StocksController::class, 'showStocks'])
    ->middleware(['auth', 'verified'])
    ->name('stocks');

require __DIR__.'/auth.php';
