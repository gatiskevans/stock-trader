<?php

namespace App\Listeners;

use App\Mail\SoldMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class StockSoldListener implements ShouldQueue
{
    public function handle($event): void
    {
        Mail::to($event->getUser()->email)
            ->send(
                new SoldMail(
                    $event->getTicker(),
                    $event->getQuantity(),
                    $event->getCurrentPrice(),
                    $event->getTotal()
                ));
    }
}
