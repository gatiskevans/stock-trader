<?php

namespace App\Http\Controllers\Stocks;

use App\Convert\Convert;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyStocksRequest;
use App\Http\Requests\SellStocksRequest;
use App\Http\Requests\StocksRequest;
use App\Models\Stock;
use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\StocksRepositories\StocksRepository;
use App\Services\BuyStocksService;
use App\Services\SanitizeInputService;
use App\Services\SellStocksService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(FinnhubStocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function search(StocksRequest $request, SanitizeInputService $sanitizeInput): RedirectResponse
    {
        $request->validate($request->rules());

        try {
            $search = $sanitizeInput->execute($request->get('search'));
            $company = $this->stocksRepository->fetchData($search);
        } catch (Throwable $exception) {
            report($exception);
            return redirect()->back();
        }

        return redirect()->route('company', $company['displaySymbol']);
    }

    public function showCompany(string $companySymbol): View
    {
        $companyData = $this->stocksRepository->companyProfile($companySymbol);
        $quoteData = $this->stocksRepository->quoteData($companySymbol);

        return view('companies.company', [
            'company' => $companyData,
            'quote' => $quoteData
        ]);
    }

    public function showStock(string $stock, int $price): View
    {
        $quoteData = $this->stocksRepository->quoteData($stock);
        $stock = Stock::where([
            'stock' => $stock,
            'stock_price' => $price
        ])->first();

        $profit = $stock->stock_price - ($quoteData->getCurrentPrice() * 100);
        $profit = Convert::CentsToDollars($profit);

        return view('stocks.stock', ['stock' => $stock, 'quote' => $quoteData, 'profit' => $profit]);
    }

    public function showStocks(): View
    {
        $stocks = Auth::user()->stocks()->orderBy('updated_at', 'DESC')->paginate(15);

        return view('stocks.stocks', ['stocks' => $stocks]);
    }

    public function buyStock(BuyStocksRequest $request, BuyStocksService $service): RedirectResponse
    {
        $request->validate($request->rules());

        try {
            $service->execute($request->get('ticker'), $request->get('amount'));
        } catch (Throwable $exception) {
            report($exception);
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function sellStock(SellStocksRequest $request, string $stock, int $price, SellStocksService $service): RedirectResponse
    {
        $request->validate($request->rules());

        try {
            $result = $service->execute($stock, $price, $request->get('amount'));
        } catch (Throwable $exception) {
            report($exception);
            return redirect('stocks');
        }

        return $result !== null ? redirect()->back() : redirect('stocks');
    }
}
