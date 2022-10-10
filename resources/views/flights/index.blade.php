@section('title', 'Flight - Index')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('flights.header') }}
        </h2>
    </x-slot>

    <div class="px-4 mt-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">{{ __('flights.header') }}</h1>
                <p class="mt-2 text-sm text-gray-700">{{ __('flights.sub_header') }}</p>
            </div>
            <div class="flex flex-row items-center space-x-8">
                @include('.flights._tabs')
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button"
                            class="ds-btn ds-btn-accent ds-btn-block text-white">{{ __('flights.add') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        @include('.flights._table-read', ['flights' => $flights])
    </div>
@push('extra-js')
    <script type="text/javascript" defer>
        document.addEventListener('DOMContentLoaded', function() {
            FlyWithMe.App.FlightIndex = new FlyWithMe.App.FlightIndex;
        });
    </script>
@endpush
</x-app-layout>
