<?php

namespace App\Services;

use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\TransactionsRepositories\MySQLTransactionsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SellStocksService
{
    private FinnhubStocksRepository $stocksRepository;
    private MySQLTransactionsRepository $transactionsRepository;

    public function __construct(FinnhubStocksRepository $stocksRepository, MySQLTransactionsRepository $transactionsRepository)
    {
        $this->stocksRepository = $stocksRepository;
        $this->transactionsRepository = $transactionsRepository;
    }

    public function execute(string $stock, int $amount): RedirectResponse
    {
        $companyData = $this->stocksRepository->companyProfile($stock);
        $quoteData = $this->stocksRepository->quoteData($stock);

        $user = Auth::user();

        $range = (new MarketOpenService())->execute();

        if(!isset($range)){
            return redirect()->back()->withErrors([
                '_errors' => "Stock market works only from 16:00 - 23:00 on working days"
            ]);
        }

        $totalAmount = $amount * $quoteData->getCurrentPrice() * 100;

        $userStocks = $this->stocksRepository->getOne($user->id, $stock);

        if($userStocks->quantity < $amount){
            return redirect()->back()->withErrors([
                '_errors' => "You don't have enough stocks"
            ]);
        }

        $userStocks->update(['quantity' => $userStocks->quantity -= $amount]);
        if($userStocks->quantity == 0) {
            $userStocks->delete();
        }

        $user->update(['cash' => $user->cash += $totalAmount]);

        $this->transactionsRepository->save(
            $user,
            $companyData->getTicker(),
            $amount,
            $totalAmount,
            'Sold'
        );

        return redirect()->back();
    }
}
