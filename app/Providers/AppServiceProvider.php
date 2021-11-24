<?php

namespace App\Providers;

use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\StocksRepositories\StocksRepository;
use App\Repositories\TransactionsRepositories\MySQLTransactionsRepository;
use App\Repositories\TransactionsRepositories\TransactionsRepository;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(StocksRepository::class, function () {
            $config = Configuration::getDefaultConfiguration()
                ->setApiKey('token', env("FINNHUB_API"));

            $client = new DefaultApi(
                new Client(),
                $config
            );
            return new FinnhubStocksRepository($client);
        });

        $this->app->bind(TransactionsRepository::class, MySQLTransactionsRepository::class);
    }

    public function boot()
    {
        //
    }
}
