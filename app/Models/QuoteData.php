<?php

namespace App\Models;

use Finnhub\Model\Quote;

class QuoteData
{
    private float $currentPrice;
    private float $change;
    private float $percentChange;
    private float $highPrice;
    private float $lowPrice;
    private float $openPrice;
    private float $previousPrice;

    public function __construct(Quote $quoteData)
    {
        $this->currentPrice = $quoteData->getC();
        $this->change = $quoteData->getD();
        $this->percentChange = $quoteData->getDp();
        $this->highPrice = $quoteData->getH();
        $this->lowPrice = $quoteData->getL();
        $this->openPrice = $quoteData->getO();
        $this->previousPrice = $quoteData->getPc();
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
