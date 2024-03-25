<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $booking->id }}

        </h2>
        <button id="print-button"
            class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800">
            Print</button>
    </x-slot>
    <style>
        td {
            padding: 0.5rem;
        }

        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }
    </style>



    <div id="print">
        <div class="p-4 h-full bg-white relative">
            <div class="flex w-full items-center">
                <img src="{{ asset('logo.png') }}" class="h-12">
            </div>
            <div class="flex flex-col w-full justify-end text-right p-4">
                <h1 class=" uppercase">INVOICE N : </h1>
                <p><strong>{{ $booking->id }}</strong></p>
            </div>
            <div class="flex flex-row  gap-4">
                <h3 class=" uppercase"><strong>Build To</strong></h3>
                <div class="flex flex-col justify-start text-center">
                    <h3><strong>{{ $booking->client->fname }} {{ $booking->client->lname }}</strong></h3>
                    <p>{{ $booking->client->phone }}</p>
                    <p>{{ $booking->client->adresse }}</p>
                    <p>{{ $booking->client->ville }}</p>
                </div>
            </div>
            <div class="flex flex-col w-full justify-end text-right my-4">
                <h1 class=" uppercase"><strong>Date Issues : </strong> <input type="date" class="border-0" /></h1>
            </div>
            <table class="table-auto w-full text-left p-4 text-sm border-t-4">
                <thead class="bg-gray-200">
                    <tr> <!-- Use "tr" instead of "th" for table rows -->
                        <th class="col p-4 uppercase">N</th>
                        <th class="col p-4 uppercase">Period</th>
                        <th class="col p-4 uppercase">Car</th>
                        <th class="col p-4 uppercase">Prix</th>
                        <th class="col text-center p-4 uppercase">Duration</th>
                        <th class="col p-4 uppercase">Total</th>
                    </tr> <!-- Close the "tr" element -->
                </thead>
                <tbody class="border-b-4">
                    @if (count($booking->prolongations) > 0)
                        @php
                            $d1 = new DateTime(strval($booking->pickup_date)); // Use "$booking->pickup_date" instead of "$this->pickup_date"
                            $d2 = new DateTime(strval($booking->dropoff_date)); // Use "$booking->dropoff_date" instead of "$this->dropoff_date"
                            $interval = $d2->diff($d1);
                            $duration = $interval->days;
                        @endphp
                        <tr class="border-y-2 p-4">
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->pickup_date }} <br><br>{{ $booking->prolongations[0]->old_dropoff_date }}
                            </td>
                            <td>{{ $booking->car->marque()->name }}
                                <br><br>{{ $booking->car->mode->name }}
                            </td>
                            <td>{{ $booking->prix_day }}</td>
                            <td class="text-center">{{ $duration }}</td>
                            <td class="text-right px-4 py-2">{{ $booking->prix_day * $duration }}</td>
                        </tr>
                        @foreach ($booking->prolongations as $prolongation)
                            <!-- Remove the "()" after "$booking->prolongations" -->
                            <tr class="border-y-2 p-4">
                                <td></td>
                                <td>{{ $prolongation->old_dropoff_date }}
                                    <br><br>{{ $prolongation->new_dropoff_date }}
                                </td>
                                <td>{{ $booking->car->marque()->name }}
                                    <br><br>{{ $booking->car->mode->name }}
                                </td>
                                <td>{{ $prolongation->new_price }}</td>
                                <td class="text-center">{{ $prolongation->duration() }}</td>
                                <!-- Remove extra curly braces around "$prolongation->duration()" -->
                                <td class="text-right px-4 py-2">
                                    {{ $prolongation->new_price * $prolongation->duration() }}</td>
                                <!-- Remove extra curly braces around the calculation -->
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-y-2 p-4">
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->pickup_date }} <br><br>{{ $booking->dropoff_date }}</td>
                            <td>{{ $booking->car->marque()->name }}
                                <br><br>{{ $booking->car->mode->name }}
                            </td>
                            <td>{{ $booking->prix_day }}</td>
                            <td class="text-center">{{ $booking->duration() }}</td>
                            <td class="text-right px-4 py-2">{{ $booking->prix_day * $booking->duration() }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="flex flex-row justify-between">

                <div class="flex flex-col w-2/4 justify-end text-left p-4">
                    <h1 class=" uppercase">Total Due </h1>
                    <p class="text-5xl">{{ $booking->amount() + $booking->amount() * 0.2 }}</p>
                </div>
                <div class="flex flex-row w-2/4 justify-end">
                    <div class=" w-3/4">
                        <div class="w-full text-right uppercase text-sm px-4 py-2">Subtotal : </div>
                        <div class="text-right uppercase text-sm px-4 py-2">Taxe : </div>
                        <div class="text-right uppercase text-sm px-4 py-2">Grand Total :</div>
                    </div>
                    <div class="w-1/4">
                        <div class="w-full text-right px-4 py-2 uppercase text-sm">{{ $booking->amount() }}</div>
                        <div class="w-full text-right px-4 py-2 uppercase text-sm">{{ $booking->amount() * 0.2 }}</div>
                        <div class="w-full text-right px-4 py-2 uppercase text-sm">
                            {{ $booking->amount() + $booking->amount() * 0.2 }}</div>

                    </div>
                </div>
            </div>
            @if ($booking->financial_status === 'non payé')
                <div
                    class="fixed bottom-[100px] -rotate-45 left-8 justify-center flex items-center border-8 border-dashed border-red-900 dark:border-red-400 h-[75px] w-[200px] opacity-50">
                    <p class="text-3xl  text-red-900 dark:text-red-400">UnPaye</p>
                </div>
            @else
                <div
                    class="fixed bottom-[100px] -rotate-45 left-8 justify-center flex items-center border-8 border-dashed border-green-900 dark:border-green-400 h-[75px] w-[200px] opacity-50">
                    <p class="text-3xl dark:text-green-400 text-green-900">Paye</p>
                </div>
            @endif
            <div class="flex flex-col w-full justify-end mt-12 text-right p-4">
                <h1>Administration</h1>
            </div>
            <footer class="fixed left-0 bottom-0 w-full text-center">
                tyrtours.com | call us at +2126 2290-8964 email us in info@tyrtours.com | @tyrtours
            </footer>
        </div>
    </div>
    <script>
        document.getElementById('print-button').addEventListener('click', function() {
            var printContent = document.getElementById('print');
            var originalContents = document.body.innerHTML;
            var printContents = printContent.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        });
    </script>
</x-app-layout>
