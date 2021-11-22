<?php

namespace App\Http\Controllers\Funds;

use App\Convert\Convert;
use App\Http\Controllers\Controller;
use App\Http\Requests\FundsRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    public function showFunds(): View
    {
        return view('funds.show-funds');
    }

    public function addFunds(FundsRequest $request): RedirectResponse
    {
        $request->validate($request->rules());

        $cash = Convert::DollarsToCents($request->cash);

        Auth::user()->update(['cash' => Auth::user()->cash += $cash]);
        session()->flash('message', "{$request->cash}$ Added Successfully");

        return redirect()->back();
    }
}
