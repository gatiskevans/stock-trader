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

                    @include('open.open')
                    @include('errors.errors')
                    @include('messages.messages')

                    <div>

                        @foreach($companies as $company)
                            <div
                                class="rounded p-3 bg-gradient-to-tr from-blue-400 to-blue-700 mt-3">
                                <div class="text-1xl font-bold mb-3 grid grid-cols-5 pt-3 justify-items-center">
                                    <div>{{ $company[0]->company }}</div>
                                    <div>Stock Name: {{ $company[0]->stock }}</div>
                                    <div>Stocks: {{ $company[1] }}</div>
                                    <div>Total Value: {{ number_format($company[1] * $company[0]->stock_price/100,2) }}$</div>
                                    <form method="get" action="{{ route('stocks', ['stock' => $company[0]->stock]) }}">
                                        <x-button>View</x-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
