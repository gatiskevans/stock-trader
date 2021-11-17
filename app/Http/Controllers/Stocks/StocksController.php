<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StocksController extends Controller
{
    public function search()
    {
        ddd('asdsad');
    }

    public function showStocks(): View
    {
        return view('stocks.stocks');
    }
}
