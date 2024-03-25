<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $booking->id }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col h-full mt-2 px-4 gap-4">
                        <ol class="items-center flex w-[100%] px-8">
                            <li class="relative mb-6 sm:mb-0 w-[100%]">
                                <div class="flex items-center">
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <div class="hidden sm:flex w-full dark:bg-gray-200 border-b-2 bg-gray-700"></div>
                                </div>
                                <div class="mt-3 sm:pr-8">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Depart') }}
                                    </h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        {{ $booking->pickup_date }}
                                    </time>
                                </div>
                            </li>
                            @foreach ($booking->prolongations as $prolongation)
                                <li class="relative mb-6 sm:mb-0 w-[100%]">
                                    <div class="flex items-center">
                                        <div
                                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-full dark:bg-gray-200 border-b-2 bg-gray-700">
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pr-8">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">prolongation
                                        </h3>
                                        <time
                                            class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                            {{ $prolongation->old_dropoff_date }}
                                        </time>
                                    </div>
                                </li>
                            @endforeach
                            <li class="relative mb-6 sm:mb-0 w-[100%]">
                                <div class="flex items-center text-end">
                                    <div class="hidden sm:flex w-full dark:bg-gray-200 border-b-2 bg-gray-800"></div>
                                    <div
                                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="mt-3 sm:pr-8 text-right">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Return') }}
                                    </h3>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        {{ $booking->dropoff_date }}</time>
                                </div>
                            </li>
                        </ol>
                        <x-booking-card :booking='$booking' />
                        <div class="flex">
                            <div class="flex flex-col w-full justify-around gap-4">
                                <div
                                    class="grow max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex flex-row justify-around mb-3">
                                        <a href="{{ route('cars.show', $booking->car->id) }}" class="items-center flex">
                                            <h5
                                                class="flex items-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                {{ $booking->car->marque()->name . ' ' . $booking->car->mode->name }}
                                            </h5>
                                        </a>
                                        <img src="{{ asset('storage/' . $booking->car->marque()->logo) }}"
                                            class="h-12">
                                    </div>
                                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                        {{ __('Immatriculation') }} : @if ($booking->car->immatriculation1)
                                            {{ strval($booking->car->immatriculation1) . '|' . $booking->car->lettre . '|' . strval($booking->car->immatriculation2) }}
                                        @else
                                            {{ $booking->car->immatriculationWW }}
                                        @endif <br>
                                        {{ __('transcription') }} : {{ $booking->car->transcription }} <br>
                                        {{ __('Kilométrage') }} : {{ $booking->car->km }} km <br>
                                    </p>
                                </div>
                                <div
                                    class="grow max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                    <div class="flex flex-row justify-around">
                                        <a href="{{ route('clients.show', $booking->client->id) }}">
                                            <h5
                                                class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                {{ $booking->client->fname . ' ' . $booking->client->lname }}
                                            </h5>
                                        </a>
                                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z" />
                                        </svg>
                                    </div>
                                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                        {{ __('ADRESSE') }} : {{ $booking->client->adresse }} <br>
                                        CIN : {{ $booking->client->cin }} <br>
                                        {{ __('phone') }} : {{ $booking->client->phone }}
                                    </p>
                                </div>
                                @if ($booking->client2)
                                    <div
                                        class="grow max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                        <div class="flex flex-row justify-around">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $booking->client2->fname . ' ' . $booking->client2->lname }}
                                                </h5>
                                            </a>
                                            <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z" />
                                            </svg>
                                        </div>
                                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                            {{ __('ADRESSE') }} : {{ $booking->client2->adresse }} <br>
                                            CIN : {{ $booking->client2->cin }} <br>
                                            {{ __('phone') }} : {{ $booking->client2->phone }}
                                        </p>
                                    </div>
                                @endif

                            </div>
                            <div class="flex flex-col w-full justify-around gap-4">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50 dark:bg-gray-800">
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                                Methode
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="dark:text-white">
                                        @foreach ($booking->payments as $payment)
                                            <tr>
                                                <td class="text-center">{{ $payment->methode }}</td>
                                                <td class="text-center">{{ $payment->created_at }}</td>
                                                <td class="text-center">{{ $payment->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="w-full ">
                                    <thead>
                                        <tr class="bg-gray-50 dark:bg-gray-800">
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                                Duration
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="dark:text-white">
                                        @foreach ($booking->prolongations as $prolongation)
                                            <tr>
                                                <td class="text-center">{{ $prolongation->created_at }}</td>
                                                <td class="text-center">{{ $prolongation->duration() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
