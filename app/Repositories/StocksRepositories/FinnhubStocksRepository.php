<?php

namespace App\Repositories\StocksRepositories;

use App\Models\Companies\CompanyProfile;
use App\Models\QuoteData;
use App\Models\Stock;
use Finnhub\Api\DefaultApi;
use Finnhub\ApiException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;

class FinnhubStocksRepository implements StocksRepository
{
    private DefaultApi $apiClient;

    public function __construct(DefaultApi $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function fetchData(string $query)
    {
        if (Cache::has('company.name.' . $query)) {
            return Cache::get('company.name.' . $query);
        }

        $data = $this->apiClient->symbolSearch($query);

        Cache::put('company.name.' . $query, $data['result'][0], now()->addMinutes(15));

        return $data['result'][0];
    }

    public function companyProfile(string $symbol): CompanyProfile
    {
        if (Cache::has('company.profile.' . $symbol)) {
            return new CompanyProfile(Cache::get('company.profile.' . $symbol));
        }

        $company = $this->apiClient->companyProfile2($symbol);

        if($company->getName() === null){
            throw new ApiException("You don't have access to this resource!");
        }

        Cache::put('company.profile.' . $symbol, $company, now()->addMinutes(15));

        return new CompanyProfile($company);
    }

    public function quoteData(string $symbol): QuoteData
    {
        if (Cache::has('company.quote.' . $symbol)) {
            return new QuoteData(Cache::get('company.quote.' . $symbol));
        }

        $quote = $this->apiClient->quote($symbol);

        Cache::put('company.quote.' . $symbol, $quote, now()->addMinutes(15));

        return new QuoteData($quote);
    }

    public function getOne(int $userId, string $ticker, float $stockPrice): ?Stock
    {
        return Stock::where([
            'user_id' => $userId,
            'stock' => $ticker,
            'stock_price' => $stockPrice
        ])->first();
    }

    public function save(Authenticatable $user, CompanyProfile $companyProfile, int $amount, int $total, float $stockPrice, ?Stock $stock = null): void
    {
        $user->stocks()->updateOrCreate([
            'user_id' => $user->id,
            'company' => $companyProfile->getName(),
            'stock' => $companyProfile->getTicker(),
            'stock_price' => $stockPrice
        ], [
            'quantity' => isset($stock) ? $stock->quantity + $amount : $amount
        ]);

        $user->update(['cash' => $user->cash -= $total]);
    }
}
