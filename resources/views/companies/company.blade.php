<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company->getName()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid justify-items-center">

                        <img src="{{ $company->getLogo() }}" alt="{{ $company->getName() }}" />

                        <div>{{ $company->getName() }}</div>
                        <div>{{ $company->getCountry() }}</div>
                        <div>{{ $company->getCurrency() }}</div>
                        <div>{{ $company->getPhone() }}</div>
                        <div>{{ $company->getTicker() }}</div>
                        <div>{{ $company->getShareOutstanding() }}</div>
                        <div>{{ $company->getExchange() }} </div>

                        <a href="{{ $company->getWebUrl() }}" target="_blank" class="text-blue-700 hover:text-blue-800">
                            {{ $company->getWebUrl() }}
                        </a>

                    </div>
                    <div class="grid grid-cols-7 mt-10">

                        <div>
                            <p>Current Price:</p>
                            {{ $quote->getCurrentPrice() }}
                        </div>
                        <div>
                            <p>Change:</p>
                            {{ $quote->getChange() }}
                        </div>
                        <div>
                            <p>Change in Percent:</p>
                            {{ $quote->getPercentChange() }}
                        </div>
                        <div>
                            <p>High Price of the Day:</p>
                            {{ $quote->getHighPrice() }}
                        </div>
                        <div>
                            <p>Low Price of the Day:</p>
                            {{ $quote->getLowPrice() }}
                        </div>
                        <div>
                            <p>Open Price:</p>
                            {{ $quote->getOpenPrice() }}
                        </div>
                        <div>
                            <p>Previous Price:</p>
                            {{ $quote->getPreviousPrice() }}
                        </div>

                    </div>

                    <div class="text-red-500 mt-10 grid justify-items-center font-extrabold text-4xl">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                    </div>

                    <form method="post" action="{{ route('stock.buy') }}" class="mt-10 grid justify-items-center">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{ $company->getTicker() }}" name="ticker" />
                        <label for="amount" class="text-4xl mb-2">Buy Stock</label>
                        <input type="text" name="amount" placeholder="See Your Company Here For 1000$" required />
                        <x-button type="submit" class="mt-5">
                            Buy
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
