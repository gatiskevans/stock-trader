<?php

namespace App\Services;

use App\Convert\Convert;
use App\Events\StockPurchasedEvent;
use App\Repositories\StocksRepositories\StocksRepository;
use App\Repositories\TransactionsRepositories\TransactionsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BuyStocksService
{
    private StocksRepository $stocksRepository;
    private TransactionsRepository $transactionsRepository;

    public function __construct(StocksRepository $stocksRepository, TransactionsRepository $transactionsRepository)
    {
        $this->stocksRepository = $stocksRepository;
        $this->transactionsRepository = $transactionsRepository;
    }

    public function execute(string $ticker, string $amount): RedirectResponse
    {
        $companyData = $this->stocksRepository->companyProfile($ticker);
        $quoteData = $this->stocksRepository->quoteData($ticker);

        $user = Auth::user();

        $price = Convert::DollarsToCents($quoteData->getCurrentPrice());
        $totalAmount = $amount * $price;

        $range = (new MarketOpenService())->execute();

        if (!isset($range)) {
            return redirect()->back()->withErrors([
                '_errors' => "Market is closed. You cannot purchase any stocks."
            ]);
        }

        if ($user->cash < $totalAmount) {
            return redirect()->back()->withErrors(['_error' => "Not Enough Money"]);
        }

        $this->transactionsRepository->save(
            $user,
            $companyData->getTicker(),
            $amount,
            $totalAmount,
            'Purchased'
        );

        $stockData = $this->stocksRepository->getOne($user->id, $companyData->getTicker(), $price);
        $this->stocksRepository->save($user, $companyData, $amount, $totalAmount, $price, $stockData);

        $amount > 1 ? $response = "stocks" : $response = "stock";

        $total = number_format($totalAmount / 100, 2);
        session()->flash('message', "Purchase Successful. You bought $amount {$companyData->getTicker()} $response for $total USD");
        StockPurchasedEvent::dispatch($user, $ticker, $amount, $quoteData->getCurrentPrice(), $total);

        return redirect()->back();
    }
}
