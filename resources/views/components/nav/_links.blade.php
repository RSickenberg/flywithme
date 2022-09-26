<div class="flex flex-col space-y-2 lg:space-y-0 lg:flex-row lg:space-x-6 xl:space-x-8 lg:items-center">
    <a href="/" class="{{ Route::is('home') ? 'text-primary text-semibold' : 'text-gray-500 dark:text-gray-300 hover:text-gray-800' }}">Home</a>
    {{-- <a href="#" class="{{ Route::is('another_one') ? 'text-primary text-semibold' : 'text-gray-500 dark:text-gray-300 dark:hover:text-gray-50 hover:text-gray-800'}}">Another link</a> --}}
</div>
<x-slot name="header"></x-slot>
<div class="flex flex-col space-y-4 lg:space-y-0 lg:flex-row lg:items-center lg:space-x-4">
    @if(!Auth::check())
        <a href="{{ route('register') }}" class="flex items-center justify-center h-12 px-4 text-sm font-semibold text-center text-white rounded-md lg:h-10 bg-primary dark:bg-primaryDark hover:bg-teal-300">
            <span class="lg:inline">Register</span>
        </a>
        <a href="{{ route('login') }}" class="flex items-center justify-center h-12 px-4 text-sm font-semibold text-center text-black dark:text-white rounded-md lg:h-10 bg-gray-200 dark:bg-gray-700 hover:bg-teal-300">
            <span class="lg:inline">Login</span>
        </a>
    @elseif(Auth::check())
        @include('navigation-menu')
    @endif
</div>
