<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('stocks')" :active="request()->routeIs('stocks')">
        {{ __('My Stocks') }}
    </x-nav-link>
</div>
