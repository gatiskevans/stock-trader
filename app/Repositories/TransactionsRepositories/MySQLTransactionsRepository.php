<?php

namespace App\Repositories\TransactionsRepositories;

use App\Models\Transaction;
use Illuminate\Contracts\Auth\Authenticatable;

class MySQLTransactionsRepository implements TransactionsRepository
{
    public function save(Authenticatable $user, string $ticker, int $quantity, int $total, string $status): void
    {
        $transaction = new Transaction([
            'stock_name' => $ticker,
            'quantity' => $quantity,
            'total_amount' => $total,
            'status' => $status
        ]);

        $transaction->user()->associate($user);
        $transaction->save();
    }
}
