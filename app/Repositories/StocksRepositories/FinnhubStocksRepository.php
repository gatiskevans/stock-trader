<?php

namespace App\Repositories\StocksRepositories;

use App\Convert\Convert;
use App\Models\Companies\CompanyProfile;
use App\Models\QuoteData;
use App\Models\Stock;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;

class FinnhubStocksRepository implements StocksRepository
{
    private Client $client;
    private string $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env("FINNHUB_API");
    }

    public function fetchData(string $query)
    {
        if(Cache::has('company.name.' . $query)){
            return Cache::get('company.name.' . $query);
        }

        $url = "https://finnhub.io/api/v1/search?q=".$query."&token=". $this->apiKey;
        $result = $this->client->request('GET', $url);
        $data = json_decode($result->getBody(), true);

        Cache::put('company.name.' . $query, $data['result'][0], now()->addMinutes(15));

        return $data['result'][0];
    }

    public function companyProfile(string $symbol): CompanyProfile
    {
        if(Cache::has('company.profile.' . $symbol)){
            return new CompanyProfile(Cache::get('company.profile.' . $symbol));
        }

        $url = "https://finnhub.io/api/v1/stock/profile2?symbol=".$symbol."&token=".$this->apiKey;
        $result = $this->client->request('GET', $url);

        $companyArray = json_decode($result->getBody(), true);

        Cache::put('company.profile.' . $symbol, $companyArray, now()->addMinutes(15));

        return new CompanyProfile($companyArray);
    }

    public function quoteData(string $symbol): QuoteData
    {
        if(Cache::has('company.quote.' . $symbol)){
            return new QuoteData(Cache::get('company.quote.' . $symbol));
        }

        $url = "https://finnhub.io/api/v1/quote?symbol=".$symbol."&token=".$this->apiKey;
        $result = $this->client->request('GET', $url);


        $quoteArray = json_decode($result->getBody(), true);

        Cache::put('company.quote.' . $symbol, $quoteArray, now()->addMinutes(15));

        return new QuoteData($quoteArray);
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
