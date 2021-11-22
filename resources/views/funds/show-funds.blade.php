<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200">

                    <div class="text-4xl font-bold">
                        Your Balance:
                        <span class="text-green-600">{{ number_format(Auth::user()->cash/100, 2) }}$ USD</span>
                    </div>

                    @include('errors.errors')

                    <div class="font-bold my-10">
                        <form action="{{ route('funds.add') }}" method="POST">
                            @csrf
                            <label for="cash" class="text-3xl">Add Funds</label><br/>
                            <input type="text" name="cash" id="cash" class="mt-5 rounded" /><br/>
                            <x-button class="mt-5">Add</x-button>
                        </form>
                    </div>

                    @include('messages.messages')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
