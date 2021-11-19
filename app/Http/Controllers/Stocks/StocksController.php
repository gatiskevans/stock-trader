<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\StocksRepositories\StocksRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(FinnhubStocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function search(Request $request): RedirectResponse
    {
        $search = Str::snake(strtolower($request->get('search')));

        $company = $this->stocksRepository->fetchData($search);

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

    public function showStocks(): View
    {
        return view('stocks.stocks');
    }
}
