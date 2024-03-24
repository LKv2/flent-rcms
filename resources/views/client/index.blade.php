<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('create client') }}
        </h2>

            <form class="flex items-center">
                <label for="simple-search" class="sr-only">{{ __('Search') }}</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#3CB371] focus:border-[#3CB371] block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3CB371] dark:focus:border-[#3CB371]"
                        placeholder="Search" required="">
                </div>
            </form>
        <div
            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <a href="#"
                class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                {{ __('Export') }} {{ __('client') }}
            </a>
        </div>



    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <table id="clientTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">{{ __('Name') }}</th>
                                    <th scope="col" class="px-4 py-3">{{ __('phone') }}</th>
                                    <th scope="col" class="px-4 py-3">Cin</th>
                                    <th scope="col" class="px-4 py-3">{{ __('ADRESSE') }}</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only"> </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="border-b dark:border-gray-700">
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $client->fname }} {{ $client->lname }}
                                        </td>
                                        <td class="px-4 py-3">{{ $client->phone }}</td>
                                        <td class="px-4 py-3">{{ $client->cin }}</td>
                                        <td class="px-4 py-3">{{ $client->adresse }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="client-{{ $client->id }}-dropdown-button"
                                                data-dropdown-toggle="client-{{ $client->id }}-dropdown"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="client-{{ $client->id }}-dropdown"
                                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="client-{{ $client->id }}-dropdown-button">
                                                    <li>
                                                        <a href="{{ route('clients.show', $client->id) }}"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Show') }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('clients.edit', $client->id) }}"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edite') }}</a>
                                                    </li><li>
                                                        <a href="{{ route('clients.destroy', $client->id) }}"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Delete') }}</a>
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
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the input element for searching
            const searchInput = document.getElementById("simple-search");

            // Get all the rows in the table
            const rows = document.querySelectorAll("#clientTable tbody tr");

            // Function to filter rows based on search input
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();

                rows.forEach(function(row) {
                    const name = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
                    const phone = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
                    const cin = row.querySelector("td:nth-child(3)").innerText.toLowerCase();

                    if (name.includes(searchTerm) || phone.includes(searchTerm) || cin.includes(
                            searchTerm)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            // Event listener for input change
            searchInput.addEventListener("input", filterTable);
        });
    </script>
</x-app-layout>
