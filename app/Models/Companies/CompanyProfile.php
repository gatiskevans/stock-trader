<?php

namespace App\Models\Companies;

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

    public function __construct(array $companyData)
    {
        $this->country = $companyData['country'];
        $this->currency = $companyData['currency'];
        $this->logo = $companyData['logo'];
        $this->name = $companyData['name'];
        $this->phone = $companyData['phone'];
        $this->weburl = $companyData['weburl'];
        $this->ticker = $companyData['ticker'];
        $this->shareOutstanding = $companyData['shareOutstanding'];
        $this->exchange = $companyData['exchange'];
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
