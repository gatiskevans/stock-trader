<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                @include('layouts.partials.logo.logo')

                <!-- Navigation Links -->
                @include('layouts.partials.navigation.dashboard-link')
                @include('layouts.partials.navigation.stocks-link')

            </div>

            <!-- Settings Dropdown -->
            @include('layouts.partials.dropdown.settings-dropdown')

            <!-- Hamburger -->
            @include('.layouts.partials.hamburger.hamburger-menu')

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @include('layouts.partials.responsive.responsive-navigation-menu')

        <!-- Responsive Settings Options -->
        @include('layouts.partials.responsive.responsive-settings-options')

    </div>
</nav>
