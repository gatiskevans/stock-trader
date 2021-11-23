<?php

namespace App\Convert;

class Convert
{
    public static function DollarsToCents(float $amount): int
    {
        return (int)($amount * 100);
    }

    public static function CentsToDollars(int $amount): string
    {
        return number_format($amount / 100, 2);
    }
}
