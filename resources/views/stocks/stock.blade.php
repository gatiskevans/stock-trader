<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200 ">

                    @include('errors.errors')
                    @include('messages.messages')

                    <div class="grid grid-cols-2">

                        <div class="font-bold">
                            <div class="text-5xl">{{ $stock->company }}</div>
                            <div class="text-1xl mt-3">Name of the Stock: {{ $stock->stock }}</div>
                            <div class="text-1xl">Quantity You Own: {{ $stock->quantity }}</div>
                            <div class="text-1xl">Stock Purchased At: {{ $stock->created_at }}</div>
                            <div class="text-1xl mb-3">Last Purchase At: {{ $stock->updated_at }}</div>

                            <form method="post" action="{{ route('stock.sell', ['stock' => $stock->stock]) }}">
                                @csrf
                                <input type="number" class="rounded" name="amount"
                                       value="{{ $stock->quantity }}"/>
                                <x-button class="mt-3">Sell</x-button>
                            </form>

                        </div>

                        <div class="font-bold bg-white p-4 border-2 border-black">

                            @include('stocks._quote')

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
