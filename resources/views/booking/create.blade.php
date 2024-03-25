<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Create Booking') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="px-6 py-2 space-y-6">
            <style>
                .step {
                    display: none;
                }

                .step.active {
                    display: block;
                }
            </style>

            <div class="container mx-auto p-4">
                <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 mb-8">
                    <li class="flex items-center w-full text-blue-600 dark:text-blue-500 space-x-2.5">
                        <span
                            class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">{{ __('steps.0') }}</h3>
                        </span>
                    </li>
                    <li class="flex items-center w-full text-gray-500 dark:text-gray-400 space-x-2.5" id="nav-2">
                        <span
                            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">{{ __('steps.1') }}</h3>
                        </span>
                    </li>
                </ol>
                <form action="{{ route('bookings.store') }}" method="post" class="stepper-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="step active" id="step1">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">Step 1: Voiture Info</h2>
                        <div class="grid grid-cols-3 gap-2">

                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="pickup_date">Client</label>
                                <div class="w-[100%] relative inline-block text-left">
                                    <input type="text" id="searchInput"
                                        class="p-2 w-[100%] border border-gray-300 rounded"
                                        placeholder="Select a Client" onclick="toggleDropdown()">
                                    <div class="w-[100%] absolute mt-2 bg-white border border-gray-300 rounded-md shadow-lg"
                                        id="dropdownContent" style="display: none;">
                                        <ul class="py-1">
                                            @foreach ($clients as $client)
                                                <li id="{{ $client->id }}"
                                                    class="cursor-pointer hover:bg-gray-100 px-4 py-2">
                                                    {{ $client->fname . ' ' . $client->lname }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selected
                                    Clients</label>
                                <ul id="selectedClientsList" class="border border-gray-300 p-2 rounded"
                                    style="min-height: 100px;"></ul>
                                <input type="hidden" name="client1_id" id="client1_id">
                                <input type="hidden" name="client2_id" id="client2_id">
                            </div>
                            <script src="{{ asset('/js/select-search.js') }}"></script>

                            <div class=" flex justify-center p-6">
                                <a href="{{ route('clients.create') }}"
                                    class="flex items-center justify-center dark: text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Ajouter Client
                                </a>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="pickup_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Pick-up Date</label>
                                <input type="datetime-local" id="pickup_date" name="pickup_date" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="dropoff_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Date Drop-off</label>
                                <input type="datetime-local" id="dropoff_date" name="dropoff_date" disabled required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="marque">Pick-up
                                    Location</label>
                                <select name="pickup_location" id="pickup_location"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                    required>
                                    <option value="" disabled selected>Select Pick-up Location</option>

                                    @foreach ($locations as $location)
                                        <option value=" {{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="marque">Drop-off
                                    Location</label>
                                <select name="dropoff_location" id="dropoff_location"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                    required>
                                    <option value="" disabled selected>Select Drop-off Location</option>
                                    @foreach ($locations as $location)
                                        <option value=" {{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button type="button"
                                class="next-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg "
                                onclick="nextStep(1)">{{ __('Next') }}</button>
                        </div>
                    </div>

                    <div class="step" id="step2">

                        <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('steps.1') }}
                        </h2>
                        <section id="availible_cars" class="grid grid-cols-3 gap-2">
                            @foreach ($cars as $car)
                                <x-card-cars :car="$car" />
                            @endforeach
                        </section>
                        <div id="step-2-inputs">


                        </div>
                        <div class="flex justify-between mt-8">
                            <button type="button"
                                class="prev-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg"
                                onclick="nextStep(-1)">{{ __('Previous') }}</button>
                            <button type="submit"
                                class="bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg">Submit</button>
                        </div>
                    </div>


                </form>


            </div>
        </div>

    </div>
    <style>
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            max-height: 150px;
            overflow-y: auto;
        }

        .autocomplete-item {
            padding: 5px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/dateformbooking.js"></script>

    <script>
        $(document).ready(function() {
            $('#pickup_date, #dropoff_date').on('change', function() {
                const pickupDate = $('#pickup_date').val();
                const dropoffDate = $('#dropoff_date').val();
                if (pickupDate && dropoffDate) {
                    // Make an AJAX request to update the available cars
                    $.ajax({
                        url: '{{ route('update.available.cars') }}',
                        type: 'POST',
                        data: {
                            pickup_date: pickupDate,
                            dropoff_date: dropoffDate,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            // Update the available cars on the page
                            $('#availible_cars').html(data.carCards.join(''));
                        },
                        error: function(error) {
                            console.error('Error updating available cars:', error);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function validateStep1() {
            let isValid = true;
            // Get all radio buttons by name
            var radioButtons = document.getElementsByName('car');
            var kmDepartInput = document.getElementById('km_depart');

            if (kmDepartInput) {
                // Initially disable the km_depart input
                kmDepartInput.disabled = true;

                // Add event listener to each radio button
                radioButtons.forEach(function(radioButton) {
                    radioButton.addEventListener('change', function() {
                        // Update the min attribute of km_depart based on the selected car's kilometer value
                        kmDepartInput.min = this.getAttribute('data-car-km');

                        // Enable km_depart input when a car is selected
                        kmDepartInput.disabled = false;
                    });
                });
            } else {
                console.error("Element with id 'km_depart' not found.");
            }
            const selectedClientsList = document.getElementById('selectedClientsList');
            if (selectedClientsList.children.length === 0) {
                isValid = false;
                alert('Please select a client.');
            }

            const pickupDateInput = document.getElementById('pickup_date');
            if (!pickupDateInput.value) {
                isValid = false;
                alert('Please select a pick-up date.');
            }

            // Additional validation for other fields in Step 1
            // For example, validate pick-up location
            const pickupLocationSelect = document.getElementById('pickup_location');
            if (pickupLocationSelect.value === "") {
                isValid = false;
                alert('Please select a pick-up location.');
            }

            // You can add more validation for other fields in Step 1 as needed

            return isValid;
        }

        function validateStep2() {
            let isValid = true;
            // Get all radio buttons by name
            radioButtons = document.getElementsByName('car');
            kmDepartInput = document.getElementById('km_depart');

            if (kmDepartInput) {
                // Initially disable the km_depart input
                kmDepartInput.disabled = true;

                // Add event listener to each radio button
                radioButtons.forEach(function(radioButton) {
                    radioButton.addEventListener('change', function() {
                        // Update the min attribute of km_depart based on the selected car's kilometer value
                        kmDepartInput.min = this.getAttribute('data-car-km');

                        // Enable km_depart input when a car is selected
                        kmDepartInput.disabled = false;
                    });
                });
            } else {
                console.error("Element with id 'km_depart' not found.");
            }
            const kmDepartInput = document.getElementById('km_depart');
            if (!kmDepartInput.value) {
                isValid = false;
                alert('Please enter the kilométrage depart.');
            }


            let selectedCar;

            // Loop through radio buttons to find the selected one
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    selectedCar = radioButton.value;
                    break; // Exit the loop once a checked radio button is found
                }
            }
            if (!selectedCar) {
                isValid = false;
                alert('Please select at least one car.');
            }
            // You can add more validation for other fields in Step 2 as needed

            return isValid;
        }
    </script>
    <script>
        const nav2 = document.getElementById('nav-2');
        let currentStep = 1; // Keeps track of the current step
        function updatenav() {
            switch (currentStep) {
                case 1:
                    nav2.classList.remove('text-blue-600', 'dark:text-blue-500');
                    nav2.classList.add('text-gray-500', 'dark:text-gray-400');
                    break;
                case 2:
                    nav2.classList.add('text-blue-600', 'dark:text-blue-500');
                    nav2.classList.remove('text-gray-500', 'dark:text-gray-400');
                    break;

                default:
                    break;
            }
        }




        // Function to move to the next step
        function nextStep(stepChange) {
            // Validate fields based on the current step
            var isValid = false;
            if (stepChange > 0) {
                switch (currentStep) {
                    case 1:
                        isValid = validateStep1();
                        break;
                    case 2:
                        isValid = validateStep2();
                        break;
                        // Add cases for other steps as needed

                    default:
                        break;
                }
                if (isValid) {
                    // Move to the next step logic (e.g., show/hide steps, update progress, etc.)
                    document.getElementById(`step${currentStep}`).classList.remove('active');
                    currentStep += stepChange;
                    console.log(currentStep);
                    updatenav()
                    document.getElementById(`step${currentStep}`).classList.add('active');
                    alert('Validation passed! Moving to the next step.');
                }
            } else {
                document.getElementById(`step${currentStep}`).classList.remove('active');
                currentStep += stepChange;
                console.log(currentStep);
                updatenav()
                document.getElementById(`step${currentStep}`).classList.add('active');
            }

            // If validation passed, move to the next step

        }
    </script>
    <!-- Add this script to your HTML file or include it in your JavaScript file -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var pickupDateInput = document.getElementById('pickup_date');
            var dropoffDateInput = document.getElementById('dropoff_date');

            function checkSameAsToday() {

                var pickupDate = new Date(pickupDateInput.value);
                var today = new Date();

                if (pickupDate.toDateString() === today.toDateString()) {
                    // If pick-up date is the same as today
                    document.getElementById('step-2-inputs').innerHTML = `
                <div class="my-6">
                    
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="km_depart">Kilométrage
                                        Depart</label>
                                    <input type="number" name="km_depart" id="km_depart" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required>
                                </div>
                                <div class="my-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="km_depart">Carburant Depart</label>
                                    <select name="carburant_depart" id="carburant_depart" required>
                                        <option value="full">Full</option>
                                        <option value="half">Half</option>
                                        <option value="empty">Empty</option>
                                    </select>
                                </div>`;
                } else {
                    // If pick-up date is different from today
                    document.getElementById('step-2-inputs').innerHTML = ``;
                }
            }

            // Call the function initially and bind it to the change event of the passport input

            checkSameAsToday();
            pickupDateInput.addEventListener('change', checkSameAsToday);
        });
    </script>
</x-app-layout>
