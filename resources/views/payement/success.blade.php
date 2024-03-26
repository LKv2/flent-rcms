<x-guest-layout>
    <div class="flex flex-col md:flex-row gap-4 h-full">
        <div class="relative flex w-full h-full flex-col p-4 justify-top">
            <ol class="flex w-[100%] my-3 px-3">
                <li class="relative mb-6 sm:mb-0 w-[100%]">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full dark:bg-white border-b-2 bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pr-8">
                        <h3 class="text-lg font-semibold dark:text-gray-400 text-gray-900">{{ __('Depart') }}
                        </h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                            {{ $booking->pickup_date }}
                        </time>
                    </div>
                </li>
                @foreach ($booking->prolongations as $prolongation)
                    <li class="relative mb-6 sm:mb-0 w-[100%]">
                        <div class="flex items-center">
                            <div
                                class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                                <svg class="w-2.5 h-2.5 text-blue-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <div class="hidden sm:flex w-full dark:bg-gray-200 border-b-2 bg-gray-700"></div>
                        </div>
                        <div class="mt-3 sm:pr-8">
                            <h3 class="text-lg font-semibold dark:text-white text-gray-900">prolongation</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                                {{ $prolongation->old_dropoff_date }}
                            </time>
                        </div>
                    </li>
                @endforeach
                <li class="relative mb-6 sm:mb-0 w-[100%]">
                    <div class="flex items-center text-end dark:text-gray-400 text-gray-900">
                        <div class="hidden sm:flex w-full dark:bg-gray-200 border-b-2 bg-gray-700"></div>
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>

                    </div>
                    <div class="mt-3 sm:pr-8 text-right">
                        <h3 class="text-lg font-semibold dark:text-white text-gray-900">{{ __('Return') }}</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                            {{ $booking->dropoff_date }}</time>
                    </div>
                </li>
            </ol>
            Car :<br>
            <div class="flex flex-row justify-around mb-3 items-center">
                <a href="{{ route('cars.show', $booking->car->id) }}" class="items-center flex">
                    <h6 class="flex items-center text-xl font-semibold tracking-tight dark:text-gray-400 text-gray-900">
                        {{ $booking->car->marque()->name . ' ' . $booking->car->mode->name }}
                    </h6>
                </a>
                <img src="{{ asset('storage/' . $booking->car->marque()->logo) }}" class="h-12">
            </div>
            <table>
                <thead>
                    <tr>
                        <td class="text-gray-900 dark:text-white">Reservation</td>
                        <td class="text-center dark:text-white text-gray-900">Tarif journalier</td>
                        <td class="text-center dark:text-white text-gray-900">Duration</td>
                        <td class="text-center dark:text-white text-gray-900">Montant</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="dark:text-gray-400 text-gray-900">Base</td>
                        <td class="text-end dark:text-gray-400 text-gray-900">{{ $booking->prix_day }}</td>
                        @if (count($booking->prolongations) > 0)
                            @php
                                $int = 1;
                                $duration = $booking->duration();
                                foreach ($booking->prolongations as $prolongation) {
                                    $duration -= $prolongation->duration();
                                }

                            @endphp
                            <td class="text-center dark:text-gray-400 text-gray-900">{{ $duration }}</td>
                            <td class="text-end dark:text-gray-400 text-gray-900">{{ $booking->prix_day * $duration }}
                            </td>
                        @else
                            <td>{{ $booking->duration() }}</td>
                            <td class="text-end dark:text-gray-400 text-gray-900">
                                {{ $booking->prix_day * $booking->duration() }}</td>
                        @endif

                    </tr>
                    @foreach ($booking->prolongations as $prolongation)
                        <tr>
                            <td class="dark:text-gray-400 text-gray-900"> prolongation {{ $int }}</td>
                            <td class="text-end dark:text-gray-400 text-gray-900">{{ $prolongation->new_price }}</td>

                            <td class="text-center dark:text-gray-400 text-gray-900">{{ $prolongation->duration() }}
                            </td>
                            @php
                                $int += 1;
                            @endphp
                            <td class="text-end dark:text-gray-400 text-gray-900">
                                {{ $booking->prix_day * $prolongation->duration() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="absolute bottom-0 right-0">

                @if ($booking->financial_status === 'non payé')
                    @if (count($booking->payments) > 0)
                        <p class="text-end px-4">{{ floatval($booking->amount()) . '.00' }}</p>

                        <p class="text-red-500 dark:text-red-200 text-end px-4">
                            -{{ $booking->amount() - $booking->reste() . '.00' }}</p>
                    @endif
                    <p class="text-end text-2xl mt-2 border-t-2 py-4 my-4 dark:text-gray-400 text-gray-900">Total :
                        {{ $booking->reste() . '.00' }}</p>
                @else
                    <p class="text-end text-2xl mt-2 border-t-2 py-4 my-4 dark:text-gray-400 text-gray-900">Total :
                        {{ $booking->amount() . '.00' }}</p>

                @endif
            </div>
            @if ($booking->financial_status === 'non payé')
                <div
                    class="absolute bottom-[75px] -rotate-45 left-8 justify-center flex items-center border-8 border-dashed border-red-900 dark:border-red-400 h-[75px] w-[200px] opacity-50">
                    <p class="text-3xl  text-red-900 dark:text-red-400">UnPaye</p>
                </div>
            @else
                <div
                    class="absolute bottom-[75px] -rotate-45 left-8 justify-center flex items-center border-8 border-dashed border-green-900 dark:border-green-400 h-[75px] w-[200px] opacity-50">
                    <p class="text-3xl dark:text-green-400 text-green-900">Paye</p>
                </div>
            @endif
        </div>
        <div class="border-2 border-dashed"></div>
        <div class="max-w-md w-full p-8 bg-green-200 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Payment Successful</h2>
            <p class="text-green-700">Thank you for your payment!</p>
        </div>
    </div>

</x-guest-layout>
