<?php

namespace App\Models;

class QuoteData
{
    private float $currentPrice;
    private float $change;
    private float $percentChange;
    private float $highPrice;
    private float $lowPrice;
    private float $openPrice;
    private float $previousPrice;

    public function __construct(array $quoteData)
    {
        $this->currentPrice = $quoteData['c'];
        $this->change = $quoteData['d'];
        $this->percentChange = $quoteData['dp'];
        $this->highPrice = $quoteData['h'];
        $this->lowPrice = $quoteData['l'];
        $this->openPrice = $quoteData['o'];
        $this->previousPrice = $quoteData['pc'];
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }

    public function getChange(): float
    {
        return $this->change;
    }

    public function getPercentChange(): float
    {
        return $this->percentChange;
    }

    public function getHighPrice(): float
    {
        return $this->highPrice;
    }

    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }

    public function getOpenPrice(): float
    {
        return $this->openPrice;
    }

    public function getPreviousPrice(): float
    {
        return $this->previousPrice;
    }
}
