<?php

namespace App\Models\Companies;

use Finnhub\Model\CompanyProfile2;

class CompanyProfile
{
    private string $country;
    private string $currency;
    private string $logo;
    private string $name;
    private string $phone;
    private string $weburl;
    private string $ticker;
    private string $shareOutstanding;
    private string $exchange;

    public function __construct(CompanyProfile2 $companyData)
    {
        $this->country = $companyData->getCountry();
        $this->currency = $companyData->getCurrency();
        $this->logo = $companyData->getLogo();
        $this->name = $companyData->getName();
        $this->phone = $companyData->getPhone();
        $this->weburl = $companyData->getWeburl();
        $this->ticker = $companyData->getTicker();
        $this->shareOutstanding = $companyData->getShareOutstanding();
        $this->exchange = $companyData->getExchange();
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getWeburl(): string
    {
        return $this->weburl;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getShareOutstanding(): string
    {
        return $this->shareOutstanding;
    }

    public function getExchange(): string
    {
        return $this->exchange;
    }
}
