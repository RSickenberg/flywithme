@section('title', 'Welcome')
<x-app-layout>
    <main class="mx-auto mt-10 max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
        <div class="sm:text-center lg:text-left z-10">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block xl:inline">{{ __('home.headline.title') }}</span>
                <span class="block text-indigo-600 xl:inline">{{ __('home.headline.subtitle') }}</span>
            </h1>
            <p
              class="mt-3 text-base text-gray-500 sm:mx-auto sm:mt-5 sm:max-w-xl sm:text-lg md:mt-5 md:text-xl lg:mx-0">
                {{  __('home.subtitle') }}
            </p>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                @guest
                    <div>
                        <a href="{{ route('register') }}"
                           class="ds-btn shadow ds-btn-xl md:text-lg font-medium ds-btn-block ds-btn-primary ds-btn-lg">{{ __('home.register') }}</a>
                    </div>
                    <div class="ds-divider ds-divider-horizontal">OR</div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <a href="{{ route('login') }}"
                           class="ds-btn shadow ds-btn-xl md:text-lg font-medium ds-btn-block ds-btn-outline ds-btn-lg">{{ __('home.login') }}</a>
                    </div>
                @endguest
                @auth
                    <div>
                        <a href="{{ route('flight_index') }}" class="ds-btn shadow ds-btn-xl md:text-lg font-medium ds-btn-block ds-btn-primary ds-btn-lg">{{ __('home.book') }}</a>
                    </div>
                @endauth
            </div>
        </div>
    </main>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full sm:mt-11 sm:px-4 object-cover sm:h-72 md:h-96 lg:h-full lg:w-full md:ds-mask md:ds-mask-parallelogram"
             src="https://flyingmag.sfo3.digitaloceanspaces.com/flyingma/wp-content/uploads/2021/08/25174815/httpspush.flyingmag.comsitesflyingmag.comfilesimages201908archer_a2a_2ship-1-1568x1045.jpg"
             alt="">
    </div>
</x-app-layout>
