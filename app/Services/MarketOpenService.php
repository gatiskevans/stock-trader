<?php

namespace App\Services;

use DateTimeZone;
use Nette\Utils\DateTime;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\TimeRange;

class MarketOpenService
{
    public function execute(): ?TimeRange
    {
        $marketOpen = OpeningHours::create([
            'monday' => ['16:00-23:00'],
            'tuesday' => ['16:00-23:00'],
            'wednesday' => ['00:00-23:00'],
            'thursday' => ['16:00-23:00'],
            'friday' => ['16:00-23:00'],
            'saturday' => [],
            'sunday' => [],
        ]);

        $currentTime = new DateTime('now');
        $currentTime->setTimezone(new DateTimeZone('Europe/Riga'));

        $range = $marketOpen->currentOpenRange($currentTime);

        if ($range) return $range;
        return null;
    }
}
