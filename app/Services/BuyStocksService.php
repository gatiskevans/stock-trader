<?php

namespace App\Services;

use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\TransactionsRepositories\MySQLTransactionsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BuyStocksService
{
    private FinnhubStocksRepository $stocksRepository;
    private MySQLTransactionsRepository $transactionsRepository;

    public function __construct(FinnhubStocksRepository $stocksRepository, MySQLTransactionsRepository $transactionsRepository)
    {
        $this->stocksRepository = $stocksRepository;
        $this->transactionsRepository = $transactionsRepository;
    }

    public function execute(string $ticker, string $amount): RedirectResponse
    {
        $companyData = $this->stocksRepository->companyProfile($ticker);
        $quoteData = $this->stocksRepository->quoteData($ticker);

        $user = Auth::user();

        $totalAmount = $amount * $quoteData->getCurrentPrice() * 100;

        $range = (new MarketOpenService())->execute();

        if(!isset($range)){
            return redirect()->back()->withErrors([
                '_errors' => "Stock market works only from 16:00 - 23:00 on working days"
            ]);
        }

        if($user->cash < $totalAmount){
            return redirect()->back()->withErrors(['_error' => "Not Enough Money"]);
        }

        $this->transactionsRepository->save(
            $user,
            $companyData->getTicker(),
            $amount,
            $totalAmount,
            'Purchased'
        );

        $stockData = $this->stocksRepository->getOne($user->id, $companyData->getTicker());
        $this->stocksRepository->save($user, $companyData, $amount, $totalAmount, $stockData);

        return redirect()->back();
    }
}
