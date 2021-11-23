<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company->getName()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200">

                    @include('messages.messages')
                    @include('open.open')

                    <div class="grid-cols-2 grid justify-items-center">

                        <div class="grid grid-cols-2 justify-items-left font-bold bg-white p-4 border-2 border-black">
                            <div>
                                <img src="{{ $company->getLogo() }}" alt="{{ $company->getName() }}" height="200" width="200"/>
                            </div>
                            <div>
                                <div class="text-3xl">{{ $company->getName() }}</div>
                                <div>Country: {{ $company->getCountry() }}</div>
                                <div>Currency: {{ $company->getCurrency() }}</div>
                                <div>No: {{ $company->getPhone() }}</div>
                                <div>Stock: {{ $company->getTicker() }}</div>
                                <div>Share: {{ $company->getShareOutstanding() }}</div>
                                <div>{{ $company->getExchange() }} </div>

                                <a href="{{ $company->getWebUrl() }}" target="_blank"
                                   class="text-blue-700 hover:text-blue-800">
                                    {{ $company->getWebUrl() }}
                                </a>
                            </div>
                        </div>
                        <div class="font-bold bg-white p-4 border-2 border-black">

                            @include('stocks._quote')

                        </div>
                    </div>

                    @include('errors.errors')

                    <form method="post" action="{{ route('stock.buy') }}" class="mt-10 grid justify-items-center">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{ $company->getTicker() }}" name="ticker"/>
                        <label for="amount" class="text-4xl mb-2">Buy Stock</label>
                        <input type="text" name="amount" placeholder="See Your Company Here For 1000$" required/>
                        <x-button type="submit" class="mt-5">
                            Buy
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
