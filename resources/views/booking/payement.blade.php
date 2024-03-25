<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $booking->id }}
        </h2>
    </x-slot>
    <div class="flex flex-col h-full mt-4 px-4 gap-4">
        <x-booking-card :booking='$booking' />
        <div
            class="flex gap-4 flex-col md:flex-row w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            @if ($booking->financial_status === 'non payé')
                <form action="{{ route('bookings.payment.store',$booking->id) }}" class="w-full" method="post">
                    @csrf
                    <input type="hidden" id="id"name="id" value="{{ $booking->id }}">
                    <div class="mb-6">
                        <label for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="number" id="price"name="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Methode</label>
                        <select name="methode" id="methode"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                            required>
                            <option value="" disabled selected>Select Methode</option>
                            <option value="espece">Espece</option>
                            <option value="cheque">Cheque</option>
                            <option value="tpe">TPE</option>

                        </select>
                    </div>
                    <div class="mb-6" id="additional">

                    </div>

                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="all" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                        </div>
                        <label for="all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">paye
                            Tous</a></label>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                </form>
            @endif
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800">
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
        </div>
    </div>
    <script>
        // Get references to the elements
        const priceInput = document.getElementById('price');
        const allCheckbox = document.getElementById('all');
        const selected = document.getElementById('methode');
        // Function to update the price input value and required attribute
        function updatePriceInput() {
            if (allCheckbox.checked) {
                // Set the value of 'price' to {{ $booking->reste() }}
                priceInput.value = "{{ $booking->reste() }}";
                priceInput.removeAttribute('required');
            } else {
                // Clear the 'price' value and set it as required
                priceInput.value = '';
                priceInput.setAttribute('required', 'required');
            }
        }

        // Add an event listener to the 'all' checkbox
        allCheckbox.addEventListener('change', updatePriceInput);
        selected.addEventListener('change', function() {
            if (selected.value == 'espece') {
                document.getElementById('additional').innerHTML = ``;
            } else {
                document.getElementById('additional').innerHTML = `
            <label for="price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero (cheque,transation)</label>
                <input type="text" name="nr"                             
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            `;
            }
        });

        // Call the function initially to set the initial state
        updatePriceInput();
    </script>
</x-app-layout>
