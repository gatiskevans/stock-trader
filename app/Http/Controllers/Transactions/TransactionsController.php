<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    public function showTransactions(): View
    {
        $transactions = Auth::user()->transactions();

        return view('transactions.transactions', ['transactions' => $transactions]);
    }
}
