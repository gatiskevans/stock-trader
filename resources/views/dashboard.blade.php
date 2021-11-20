<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @include('errors.errors')

                    <form action="{{ route('stock.search') }}" method="post">
                        @csrf
                        @method('POST')
                        <label for="search">Search Stock: </label>
                        <input type="text" name="search" id="search" placeholder="e.g. Apple" />
                        <x-button type="submit" value="Search">Search</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
