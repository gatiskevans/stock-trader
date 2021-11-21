<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    public function showTransactions(): View
    {
        $transactions = Auth::user()->transactions()->orderBy('created_at', 'DESC')->paginate(15);

        return view('transactions.transactions', ['transactions' => $transactions]);
    }
}
