@section('title', 'Flight - Index')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('flights.create.header') }}
        </h2>
    </x-slot>

    <div class="px-4 mt-6">
        <livewire:create-flight />
    </div>
</x-app-layout>
