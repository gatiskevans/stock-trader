<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200">

                    @include('open.open')
                    @include('messages.messages')

                    @if($stocks->count() < 1)
                        <div class="font-bold text-3xl">
                            The List Is Empty
                        </div>
                    @endif

                        @foreach($stocks->get() as $stock)
                            <div
                                class="rounded p-3 bg-gradient-to-tr from-blue-400 to-blue-700 mt-3">
                                <div class="text-2xl font-bold mb-3 grid grid-cols-4 pt-3 justify-items-center">
                                    <div>Initial Price: {{ number_format($stock->stock_price/100,2) }}$</div>
                                    <div>Number of Stocks: {{ $stock->quantity }}</div>
                                    <div>Total Value: {{ number_format($stock->quantity * $stock->stock_price/100,2) }}$</div>
                                    <form method="get" action="{{ route('stock.view', ['stock' => $stock->stock, 'price' => $stock->stock_price]) }}">
                                        <x-button>View</x-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
