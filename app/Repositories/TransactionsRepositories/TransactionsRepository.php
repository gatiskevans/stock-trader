<?php

namespace App\Repositories\TransactionsRepositories;

use Illuminate\Contracts\Auth\Authenticatable;

interface TransactionsRepository
{
    public function save(Authenticatable $user, string $ticker, int $quantity, int $total, string $status): void;
}
