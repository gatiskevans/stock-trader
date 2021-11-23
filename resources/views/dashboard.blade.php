<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gradient-to-tr from-gray-300 to-gray-400 border-b border-gray-200 p-3 mb-3">

                    @include('open.open')
                    @include('errors.errors')
                    @include('messages.messages')

                    <form action="{{ route('stock.search') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="text" name="search" id="search" placeholder="e.g. Apple" class="rounded min-w-full" />
                        <x-button type="submit" class="mt-3" value="Search">Search Stock</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
