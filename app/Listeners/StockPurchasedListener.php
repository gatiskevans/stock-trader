<?php

namespace App\Listeners;

use App\Mail\PurchasedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class StockPurchasedListener implements ShouldQueue
{
    public function handle($event): void
    {
        Mail::to($event->getUser()->email)
            ->send(
                new PurchasedMail(
                    $event->getTicker(),
                    $event->getAmount(),
                    $event->getCurrentPrice(),
                    $event->getTotal()
                ));
    }
}
