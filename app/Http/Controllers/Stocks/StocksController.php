<?php

namespace App\Http\Controllers\Stocks;

use App\Convert\Convert;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyStocksRequest;
use App\Http\Requests\SellStocksRequest;
use App\Http\Requests\StocksRequest;
use App\Models\Stock;
use App\Repositories\StocksRepositories\StocksRepository;
use App\Services\BuyStocksService;
use App\Services\MarketOpenService;
use App\Services\SanitizeInputService;
use App\Services\SellStocksService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
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

        return redirect()->route('company', $company['display_symbol']);
    }

    public function showCompany(string $companySymbol)
    {
        try {
            $companyData = $this->stocksRepository->companyProfile($companySymbol);
            $quoteData = $this->stocksRepository->quoteData($companySymbol);
        } catch (Throwable $exception)
        {
            return redirect()->back()->withErrors("You don't have access to this resource.");
        }

        return view('companies.company', [
            'company' => $companyData,
            'quote' => $quoteData,
            'open' => (new MarketOpenService())->execute()
        ]);
    }

    public function showStock(string $stock, int $price): View
    {
        $quoteData = $this->stocksRepository->quoteData($stock);
        $stock = Stock::where([
            'stock' => $stock,
            'stock_price' => $price
        ])->first();

        $profit = ($quoteData->getCurrentPrice() * 100) - $stock->stock_price;
        $profit = Convert::CentsToDollars($profit);

        return view('stocks.stock', [
            'stock' => $stock,
            'quote' => $quoteData,
            'profit' => $profit,
            'open' => (new MarketOpenService())->execute()
        ]);
    }

    public function showStocks(string $stock): View
    {
        $stocks = $this->stocksRepository->getCompaniesByStock($stock);

        return view('stocks.stocks', ['stocks' => $stocks, 'open' => (new MarketOpenService())->execute()]);
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
            return redirect('stocks/{stock}');
        }

        return $result !== null
            ? redirect()->back()
            : ( $this->stocksRepository->getOneByStock(Auth::user()->id, $stock)=== null
                ? redirect('companies')
                : Redirect::route('stocks', [$stock]));
    }

    public function showCompanies()
    {
        return view('companies.show-companies', [
            'companies' => $this->stocksRepository->getCompanies(),
            'open' => (new MarketOpenService())->execute()
        ]);
    }
}
