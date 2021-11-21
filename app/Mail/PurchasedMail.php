<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $ticker;
    private int $quantity;
    private float $currentPrice;
    private float $total;

    public function __construct(string $ticker, int $quantity, float $currentPrice, float $total)
    {
        $this->ticker = $ticker;
        $this->quantity = $quantity;
        $this->currentPrice = $currentPrice;
        $this->total = $total;
    }

    public function build(): PurchasedMail
    {
        return $this->with([
            'ticker' => $this->ticker,
            'quantity' => $this->quantity,
            'price' => $this->currentPrice,
            'total' => $this->total
        ])->view('mail.purchased-mail');
    }
}
