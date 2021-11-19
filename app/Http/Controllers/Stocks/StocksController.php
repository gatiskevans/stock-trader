<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use App\Models\Companies\CompanyProfile;
use App\Models\QuoteData;
use App\Models\Transaction;
use App\Repositories\StocksRepositories\FinnhubStocksRepository;
use App\Repositories\StocksRepositories\StocksRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function buyStock(Request $request)
    {
        $companyData = $this->stocksRepository->companyProfile($request->get('ticker'));
        $quoteData = $this->stocksRepository->quoteData($request->get('ticker'));

        $user = Auth::user();

        $totalAmount = $request->get('amount') * $quoteData->getCurrentPrice() * 100;

        if($user->cash < $totalAmount){
            return redirect()->back()->withErrors(['_error' => "Not Enough Money"]);
        }

        $transaction = new Transaction([
            'stock_name' => $companyData->getTicker(),
            'quantity' => $request->get('amount'),
            'total_amount' => $totalAmount,
            'status' => 'Purchased'
        ]);

        //Associate current user with this transaction
        $transaction->user()->associate($user);
        $transaction->save();

        $user->update(['cash' => $user->cash -= $totalAmount]);

        return redirect()->back();
    }

    public function sellStock()
    {

    }
}
