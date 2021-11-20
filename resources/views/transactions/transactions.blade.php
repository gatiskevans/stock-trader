<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($transactions->count() < 1)
                        <div>
                            The List Is Empty
                        </div>
                    @endif

                    @foreach($transactions->get() as $transaction)

                        <div>{{ $transaction->stock_name }}</div>
                        <div>{{ $transaction->quantity }}</div>
                        <div>{{ $transaction->total_amount }}</div>
                        <div>{{ $transaction->status }}</div>
                        <div>{{ $transaction->created_at }}</div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
