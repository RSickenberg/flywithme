<div class="-mx-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col"
                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ __('flights.table.id') }}</th>
            <th scope="col"
                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">{{ __('flights.table.registration') }}</th>
            <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                {{ __('flights.table.model') }}</th>
            <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('flights.table.date') }}</th>
            <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('flights.table.from') }}</th>
            <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('flights.table.to') }}</th>
            <th scope="col"
                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('flights.table.status') }}</th>
            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                <span class="sr-only">{{ __('flights.table.action.edit') }}</span>
            </th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
        @foreach ($flights as $flight)
            <tr>
                <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                    {{ '#' . substr($flight->id, -5) }}
                </td>
                <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $flight->registration }}</td>
                <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $flight->model }}</td>
                <td class="px-3 py-4 text-sm text-gray-500">{{ $flight->out }}</td>
                <td class="px-3 py-4 text-sm text-gray-500">{{ $flight->departure }}</td>
                <td class="px-3 py-4 text-sm text-gray-500">{{ $flight->arrival }}</td>
                <td class="px-0 py-4 text-sm text-gray-500">
                    <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $flight->getStatusClass() }}">{{ ucfirst($flight->status->value) }}</span>
                </td>
                <td class="py-0 pl-0 pr-4 text-right text-sm font-medium sm:pr-6">
                    <a href="#" class="text-gray-400 hover:text-gray-900"><i class="fa-solid fa-pencil"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
