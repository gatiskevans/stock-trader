<?php

use App\Http\Controllers\Funds\FundsController;
use App\Http\Controllers\Stocks\StocksController;
use App\Http\Controllers\Transactions\TransactionsController;
use App\Models\Stock;
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

Route::get('/transactions', [TransactionsController::class, 'showTransactions'])
    ->middleware(['auth', 'verified'])
    ->name('transactions');

Route::post('/buy', [StocksController::class, 'buyStock'])
    ->middleware(['auth', 'verified'])
    ->name('stock.buy');

Route::post('/sell/{stock}/{price}', [StocksController::class, 'sellStock'])
    ->middleware(['auth', 'verified'])
    ->name('stock.sell');

Route::get('/stock/{stock}/{price}', [StocksController::class, 'showStock'])
    ->middleware(['auth', 'verified'])
    ->name('stock.view');

Route::get('/funds', [FundsController::class, 'showFunds'])
    ->middleware(['auth', 'verified'])
    ->name('funds.show');

Route::put('/add/funds', [FundsController::class, 'addFunds'])
    ->middleware(['auth', 'verified'])
    ->name('funds.add');

require __DIR__.'/auth.php';
