<?php

namespace App\Convert;

class Convert
{
    public static function DollarsToCents(float $amount): int
    {
        return (int) ($amount * 100);
    }
}
