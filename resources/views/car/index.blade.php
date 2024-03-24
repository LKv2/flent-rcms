<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="flex items-center space-x-3 w-full md:w-auto">
            <select name="etat" id="etatDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#3CB371] focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <option value="all">{{ __('All') }}</option>
                @foreach ($content['etat']['list']['car'] as $item)
                    <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                @endforeach

            </select>
            <select name="status" id="statusDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#3CB371] focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <option value="all">{{ __('All') }}</option>
                @foreach ($content['status']['list']['car'] as $item)
                    <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                @endforeach

            </select>


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table id="car-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">{{ __('Immatriculation') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('model') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('etat') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('status') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Price') }}</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr class="border-b dark:border-gray-700">
                                <td scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($car->immatriculation1)
                                        {{ strval($car->immatriculation1) . '|' . $car->lettre . '|' . strval($car->immatriculation2) }}
                                    @else
                                        {{ $car->immatriculationWW }}
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $car->mode->name }}</td>
                                <td class="px-4 py-3">{{ $car->etat }}</td>
                                <td class="px-4 py-3">{{ $car->status }}</td>
                                <td class="px-4 py-3">{{ $car->price() }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="{{ $car->nrchassis }}-button"
                                        data-dropdown-toggle="{{ $car->nrchassis }}"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="{{ $car->nrchassis }}"
                                        class="hidden z-0 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="{{ $car->nrchassis }}-button">
                                            <li>
                                                <a href="{{ route('cars.show', $car->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Show') }}</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('cars.edit', $car->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edite') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('cars.destroy', $car->id) }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{ __('Delete') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
