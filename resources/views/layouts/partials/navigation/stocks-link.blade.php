<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('companies.show')" :active="request()->routeIs('companies.show')">
        {{ __('My Stocks') }}
    </x-nav-link>
</div>
