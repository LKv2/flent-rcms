<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center gap-4 ">
                    <div class="w-full">
                        <label for="simple-search" class="sr-only">{{ __('Search') }}</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#3CB371] focus:border-[#3CB371] block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3CB371] dark:focus:border-[#3CB371]"
                                placeholder="Search" required="">

                        </div>
                    </div>
                    <input type="date" id="start"
                        class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#3CB371] focus:border-[#3CB371] block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3CB371] dark:focus:border-[#3CB371]"
                        required="">
                    <input type="date" id="end"
                        class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#3CB371] focus:border-[#3CB371] block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3CB371] dark:focus:border-[#3CB371]"
                        required="">
                </form>
            </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <a href="{{ route('locations.index') }}"
                    class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800">

                    {{ __('Add') }} {{ __('location') }}
                </a>
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <select name="etat" id="etat"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#3CB371] focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="all">{{ __('All') }}</option>
                        <option value="payé">{{ __('paye') }}</option>
                        <option value="non payé">{{ __('unpaid') }}</option>

                    </select>
                    <select name="status" id="status"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#3CB371] focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="all">{{ __('All') }}</option>
                        <option value="en cours">{{ __('In-Progress') }}</option>
                        <option value="terminée">{{ __('Done') }}</option>
                        <option value="confirmée">{{ __('confirmed') }}</option>
                        <option value="non confirmée">{{ __('cancel') }}</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="clientTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">{{ __('booking') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('Depart') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('Return') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('etat') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('etat') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('status') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('client') }}</th>
                        <th scope="col" class="px-4 py-3">{{ __('Ammount') }}</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">{{ __('Actions') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        @include('booking.cancel')
                        <tr class="border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $booking->id }}
                            </td>
                            <td class="px-4 py-3">{{ $booking->pickup_date }}</td>
                            <td class="px-4 py-3">{{ $booking->dropoff_date }}</td>
                            <td class="px-4 py-3">{{ $booking->reservation_status }}</td>
                            <td class="px-4 py-3">{{ $booking->financial_status }}</td>
                            <td class="px-4 py-3">{{ $booking->client->fname }} {{ $booking->client->lname }}</td>
                            <td class="px-4 py-3">{{ $booking->amount() }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="booking-{{ $booking->id }}-dropdown-button"
                                    data-dropdown-toggle="booking-{{ $booking->id }}-dropdown"
                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="booking-{{ $booking->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="booking-{{ $booking->id }}-dropdown-button">
                                        <li>
                                            <a href="{{ route('bookings.show', $booking->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('bookings.invoice', $booking->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Invoice</a>
                                        </li>
                                        @if ($booking->reservation_status == 'en cours')
                                            <li>
                                                <a href="{{ route('bookings.contract', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Contrat</a>
                                            </li>
                                        @endif
                                        @if ($booking->reservation_status == 'non confirmée')
                                            <li>
                                                <a href="{{ route('bookings.cancel', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annule</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('bookings.confirm', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Confirme</a>
                                            </li>
                                        @endif
                                        @if ($booking->reservation_status == 'confirmée' || $booking->reservation_status == 'en cours')
                                            @if ($booking->reste() < $booking->amount())
                                                <a data-modal-target="CancelBooking{{ $booking->id }}"
                                                    data-modal-toggle="CancelBooking{{ $booking->id }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">

                                                    Annule
                                                </a>
                                            @else
                                                <li>
                                                    <a href="{{ route('bookings.cancel', $booking->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annule</a>
                                                </li>
                                            @endif
                                        @else
                                            <li>
                                                <a href="{{ route('bookings.cancel', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annule</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('bookings.confirm', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Confirme</a>
                                            </li>
                                        @endif
                                        @if ($booking->reservation_status == 'en cours' || $booking->reservation_status == 'confirmée')
                                            @if ($booking->reste() !== 0.0)
                                                <li>
                                                    <a href="{{ route('bookings.payement', $booking->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Payement</a>
                                                </li>
                                            @endif
                                            @if ($booking->prolongationDays() > -1 || $booking->prolongations->count() > 0)
                                                <a href="{{ route('bookings.prolongation', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Prolongation</a>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--<nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
        aria-label="Table navigation">
         $bookings->links()
    </nav>-->
    </div>
    <!-- Add a script at the end of your HTML body or in a separate JavaScript file -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput2 = document.getElementById("simple-search");
            const startDateInput = document.getElementById("start");
            const endDateInput = document.getElementById("end");
            const etatSelect = document.getElementById("etat");
            const statusSelect = document.getElementById("status");
            const tableRows = document.querySelectorAll("#clientTable tbody tr");

            function filterTable() {
                const searchTerm = searchInput2.value.toLowerCase();
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                const etatFilter = etatSelect.value.toLowerCase();
                const statusFilter = statusSelect.value.toLowerCase();

                tableRows.forEach(function(row) {
                    const id = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
                    const client = row.querySelector("td:nth-child(6)").innerText.toLowerCase();
                    const date = new Date(row.querySelector("td:nth-child(2)").innerText);
                    const etat = row.querySelector("td:nth-child(5)").innerText.toLowerCase();
                    const status = row.querySelector("td:nth-child(4)").innerText.toLowerCase();
                    console.log(id);
                    console.log(searchTerm);
                    const isIdMatch = id.includes(searchTerm);
                    console.log(isIdMatch);
                    const isClientMatch = client.includes(searchTerm);
                    const isDateMatch = (isNaN(startDate) || date >= startDate) && (isNaN(endDate) ||
                        date <= endDate);
                    const isEtatMatch = etatFilter === "all" || etat.includes(etatFilter);
                    const isStatusMatch = statusFilter === "all" || status.includes(statusFilter);

                    if (isIdMatch && isClientMatch && isDateMatch && isEtatMatch && isStatusMatch) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            searchInput2.addEventListener("input", filterTable);
            startDateInput.addEventListener("change", filterTable);
            endDateInput.addEventListener("change", filterTable);
            etatSelect.addEventListener("change", filterTable);
            statusSelect.addEventListener("change", filterTable);
        });
    </script>



</x-app-layout>
