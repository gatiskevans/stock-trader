<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($stocks->count() < 1)
                        <div>
                            The List Is Empty
                        </div>
                    @endif

                    @include('errors.errors')

                    @foreach($stocks->get() as $stock)

                        <div>{{ $stock->company }}</div>
                        <div>{{ $stock->stock }}</div>
                        <div>{{ $stock->quantity }}</div>

                        <div>

                            <form method="post" action="{{ route('stock.sell', ['stock' => $stock->stock]) }}">

                                @csrf
                                @method('POST')
                                <input type="number" name="amount" value="{{ $stock->quantity }}"/>
                                <x-button>Sell</x-button>
                            </form>

                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
