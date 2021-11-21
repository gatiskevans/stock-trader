<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockSoldEvent
{
    use Dispatchable, SerializesModels;

    private Authenticatable $user;
    private string $ticker;
    private int $quantity;
    private float $currentPrice;
    private float $total;

    public function __construct(Authenticatable $user, string $ticker, int $quantity, float $currentPrice, float $total)
    {
        $this->user = $user;
        $this->ticker = $ticker;
        $this->quantity = $quantity;
        $this->currentPrice = $currentPrice;
        $this->total = $total;
    }

    public function getUser(): Authenticatable
    {
        return $this->user;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
