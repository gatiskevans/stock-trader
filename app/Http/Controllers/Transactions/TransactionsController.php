<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    public function showTransactions(): View
    {
        $transactions = Transaction::where('user_id', auth()->user()->id);

        return view('transactions.transactions', ['transactions' => $transactions]);
    }
}
