<?php

namespace App\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockPurchasedEvent
{
    use Dispatchable, SerializesModels;

    private string $ticker;
    private int $amount;
    private float $currentPrice;
    private string $total;
    private Authenticatable $user;

    public function __construct(Authenticatable $user, string $ticker, int $amount, float $currentPrice, string $total)
    {
        $this->ticker = $ticker;
        $this->amount = $amount;
        $this->currentPrice = $currentPrice;
        $this->total = $total;
        $this->user = $user;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }

    public function getTotal(): string
    {
        return $this->total;
    }

    public function getUser(): Authenticatable
    {
        return $this->user;
    }
}
