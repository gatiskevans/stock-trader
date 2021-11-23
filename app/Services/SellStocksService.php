<?php

namespace App\Services;

use App\Events\StockSoldEvent;
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

    public function execute(string $stock, int $price, int $amount): ?RedirectResponse
    {
        $companyData = $this->stocksRepository->companyProfile($stock);
        $quoteData = $this->stocksRepository->quoteData($stock);

        $user = Auth::user();

        $range = (new MarketOpenService())->execute();

        if (!isset($range)) {
            return redirect()->back()->withErrors([
                '_errors' => "Market is closed. You cannot sell any stocks."
            ]);
        }

        $totalAmount = $amount * $quoteData->getCurrentPrice() * 100;

        $userStocks = $this->stocksRepository->getOne($user->id, $stock, $price);

        if ($userStocks->quantity < $amount) {
            return redirect()->back()->withErrors([
                '_errors' => "You don't have enough stocks"
            ]);
        }

        $userStocks->update(['quantity' => $userStocks->quantity -= $amount]);
        if ($userStocks->quantity == 0) {
            $userStocks->delete();
        }

        $user->update([
            'cash' => $user->cash += $totalAmount,
            'profit' => $user->profit = ($quoteData->getCurrentPrice() * 100 - $userStocks->stock_price) * $amount + $user->profit
        ]);

        $this->transactionsRepository->save(
            $user,
            $companyData->getTicker(),
            $amount,
            $totalAmount,
            'Sold'
        );

        $amount > 1 ? $response = "stocks" : $response = "stock";
        $total = number_format($totalAmount / 100, 2);
        session()->flash('message', "You sold $amount $stock $response for $total USD");
        StockSoldEvent::dispatch($user, $stock, $amount, $quoteData->getCurrentPrice(), $total);

        return $this->stocksRepository->getOne($user->id, $stock, $price) ? redirect()->back() : null;
    }
}
