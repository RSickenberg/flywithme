<header class="sticky -top-0.5 z-30 border-b dark:border-gray-700 bg-white dark:bg-coolGray-800 mb-3">
    <div class="container px-4 py-5 mx-auto space-y-4 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:space-x-10">
        <div class="flex justify-between">
            <a href="/">
                <div class="flex items-center">
                    <x-jet-application-logo class="h-7 w-7 -mt-2 flex-shrink-0"/>
                    <span class="text-xl ml-2 dark:text-gray-400">FlyWith<strong class="dark:text-gray-100">Me</strong></span>
                </div>
            </a>
            <div class="flex items-center space-x-2 lg:hidden">
                <button class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none" onclick="FlyWithMe.NavigationMenu.navToggle(this)">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-gray-700 dark:text-gray-300">
                        <path fill-rule="evenodd"
                              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="hidden flex flex-col space-y-4 lg:hidden" id="mobile_menu">
            @include('components.nav._links')
        </div>
        <div class="hidden lg:flex lg:flex-row lg:items-center lg:justify-between lg:flex-1 lg:space-x-2">
            @include('components.nav._links')
        </div>
    </div>
</header>
@push('extra-js')
    <script type="text/javascript" async>
        window.onload = function() {
            FlyWithMe.NavigationMenu = new FlyWithMe.NavigationMenu;
        }
    </script>
@endpush
