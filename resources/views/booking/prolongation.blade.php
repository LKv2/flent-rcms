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

            @if ($booking->prolongationDays() > -1)
                <form action="{{ route('bookings.prolongation.store',$booking->id) }}" class="w-full" method="post">
                    @csrf
                    <input type="hidden" id="id"name="id" value="{{ $booking->id }}">
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="dropoff_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Date Drop-off</label>
                        <input type="datetime-local" id="new_dropoff_date" name="new_dropoff_date"
                            min="{{ $booking->dropoff_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="new_price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="number" id="new_price"name="new_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="all" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                        </div>
                        <label for="all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">same
                            price</a></label>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                </form>
            @endif
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
    <script>
        // Get references to the elements
        const new_priceInput = document.getElementById('new_price');
        const allCheckbox = document.getElementById('all');
        const new_dropoff_date = document.getElementById('new_dropoff_date');

        // Function to update the new_price input value and required attribute
        function updatePriceInput() {
            if (allCheckbox.checked) {
                // Set the value of 'new_price' to {{ $booking->reste() }}
                new_priceInput.value = "{{ $booking->prix_day }}";
                new_priceInput.removeAttribute('required');
            } else {
                // Clear the 'new_price' value and set it as required
                new_priceInput.value = '';
                new_priceInput.setAttribute('required', 'required');
            }
        }
        // Get the 'new_dropoff_date' input element
        var newDropoffDateInput = document.getElementById('new_dropoff_date');

        // Get the prolongation days value from PHP
        var prolongationDays = @json($booking->prolongationDays());
        console.log(prolongationDays);

        // Calculate the maximum date using the prolongation days
        var validiteDate = new Date(@json($booking->dropoff_date));
        validiteDate.setDate(validiteDate.getDate() + prolongationDays);
        console.log(validiteDate.toISOString().split('T')[0]);
        // Set the 'max' attribute for the input element
        if (prolongationDays !== 0) {
            newDropoffDateInput.max = validiteDate.toISOString().split('T')[0];
        }
        // Add an event listener to the 'all' checkbox
        allCheckbox.addEventListener('change', updatePriceInput);

        // Call the function initially to set the initial state
        updatePriceInput();
    </script>
</x-app-layout>
