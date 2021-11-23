<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <span class="pr-4">{{ $transactions->links() }}</span>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200">

                    @if($transactions->count() < 1)
                        <div class="font-bold text-3xl">
                            The List Is Empty
                        </div>
                    @endif

                    @foreach($transactions->all() as $transaction)

                        <div class="grid grid-cols-5 justify-items-center p-3 mt-5 font-bold rounded-md bg-gradient-to-tr from-blue-400 to-blue-700">
                            <div class="pt-2">
                                Stock: {{ $transaction->stock_name }}
                            </div>
                            <div class="pt-2">
                                Quantity: {{ $transaction->quantity }}
                            </div>
                            <div class="pt-2">
                                Total Value: ${{ number_format($transaction->total_amount/100,2) }}
                            </div>
                            <div class="pt-2">
                                Date: {{ $transaction->created_at }}
                            </div>
                            <div class="@if($transaction->status === "Purchased") bg-green-600 @else bg-red-500 @endif
                                px-4 py-2 rounded border-2 border-black ">
                                {{ $transaction->status }}
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
            <span class="pr-4">{{ $transactions->links() }}</span>
        </div>
    </div>
</x-app-layout>
