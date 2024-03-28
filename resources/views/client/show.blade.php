<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex w-full justify-around gap-6">
            <div
                class="grow w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="flex flex-row justify-around">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            {{ $client->fname . ' ' . $client->lname }}
                        </h5>
                    </a>
                </div>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Phone : {{ $client->date_naissance }} <br>
                    Phone : {{ $client->phone }} <br>
                    Email : {{ $client->user()->email }} <br>
                    Addresse : {{ $client->adresse }} <br>
                    Ville : {{ $client->ville }} <br>
                    Nationalite : {{ $client->nationalite }} <br>

                </p>
            </div>
            <div
                class="grow w-full text-center p-4 flex gap-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a class="bg-gray-200 rounded-lg h-[90px]"
                    href="{{ route('client.document', ['id' => $client->id, 'type' => 'CIN']) }}">
                    <h3 class="p-2">CIN : Carte d'Identide National</h3>
                    <p>{{ $client->cin }}</p>
                    <p>Valide :{{ $client->CValide_date }}</p>
                </a>
                <a class="bg-gray-200 rounded-lg h-[90px]"
                    href="{{ route('client.document', ['id' => $client->id, 'type' => 'Permis']) }}">
                    <h3 class="p-2">Permis de Conduite</h3>
                    <p>{{ $client->permis }}</p>
                    <p>Valide :{{ $client->PValide_date }}</p>
                </a>
                @if ($client->passport)
                    <a class="bg-gray-200 rounded-lg h-[90px]"
                        href="{{ route('client.document', ['id' => $client->id, 'type' => 'Passport']) }}">
                        <h3 class="p-2">Passport</h3>
                        <p>{{ $client->passport }}</p>
                        <p>Valide :{{ $client->PassValide_date }}</p>
                    </a>
                @endif

            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Booking</th>
                        <th scope="col" class="px-4 py-3">Pick</th>
                        <th scope="col" class="px-4 py-3">Drop</th>
                        <th scope="col" class="px-4 py-3">Etat</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Ammount</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $booking->id }}
                            </td>
                            <td class="px-4 py-3">{{ $booking->pickup_date }}</td>
                            <td class="px-4 py-3">{{ $booking->dropoff_date }}</td>
                            <td class="px-4 py-3">{{ $booking->reservation_status }}</td>
                            <td class="px-4 py-3">{{ $booking->financial_status }}</td>
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
                                            <a href="{{ route('booking.show', $booking->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('booking.invoice', $booking->id) }}"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Invoice</a>
                                        </li>
                                        @if ($booking->reservation_status == 'en cours')
                                            <li>
                                                <a href="{{ route('booking.contract', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Contrat</a>
                                            </li>
                                        @endif
                                        @if ($booking->reservation_status == 'non confirmée')
                                            <li>
                                                <a href="{{ route('booking.cancel', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annule</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('booking.confirm', $booking->id) }}"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Confirme</a>
                                            </li>
                                        @endif
                                        @if ($booking->reservation_status == 'en cours' || $booking->reservation_status == 'confirmée')
                                            @if ($booking->reste() !== 0.0)
                                                <li>
                                                    <a href="{{ route('booking.payement', $booking->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Payement</a>
                                                </li>
                                            @endif
                                            @if ($booking->prolongationDays() > -1 || $booking->prolongations->count() > 0)
                                                <a href="{{ route('booking.prolongation', $booking->id) }}"
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
        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
            aria-label="Table navigation">
            {{ $bookings->links() }}
        </nav>
    </div>
</x-app-layout>
