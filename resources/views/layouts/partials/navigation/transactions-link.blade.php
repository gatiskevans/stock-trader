<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('transactions')" :active="request()->routeIs('transactions')">
        {{ __('Transactions') }}
    </x-nav-link>
</div>
