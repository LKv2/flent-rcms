<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Car') }}
        </h2>
    </x-slot>
    <div class="py-4">
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
                <ol class="items-center justify-around w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0">
                    <li class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5">
                        <span
                            class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">{{ __('steps.0') }}</h3>
                        </span>
                    </li>
                    <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5" id="nav-2">
                        <span
                            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">{{ __('steps.1') }}</h3>
                        </span>
                    </li>
                </ol>

                <div class="container mx-auto p-4">
                    <form action="{{ route('clients.store') }}" method="post" class="stepper-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="step active" id="step1">
                            <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                                {{ __('steps.0') }}</h2>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-6">
                                    <label for="fname"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                        name</label>
                                    <input type="text" id="fname" name="fname"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="John" required>
                                </div>
                                <div class="mb-6">
                                    <label for="lname"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                        name</label>
                                    <input type="text" id="lname" name="lname"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Doe" required>
                                </div>
                                <div class="mb-6">
                                    <label for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                        number</label>
                                    <input type="tel" id="phone" name="phone"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="123-45-678" pattern="[0-9]{10}" required>
                                </div>
                                <div class="mb-6">
                                    <label for="eamil"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Email</label>
                                    <input type="eamil" id="email" name="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="test@gmail.com" required>
                                </div>
                                <div class="mb-6">
                                    <label for="eamil"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Naissance</label>
                                    <input type="date" id="date_naissance" name="date_naissance"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label for="cities"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Ville</label>
                                    <div class="autocomplete">
                                        <input
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="text" id="cities" name="ville" placeholder="Type a cities"
                                            required>
                                        <div class="autocomplete-items" id="autocomplete-list-cities"></div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="adresse"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Adresse</label>
                                    <input type="text" id="adresse" name="adresse"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Doe" required>
                                </div>
                                <div class="mb-6">
                                    <label for="nationalite"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nationalite</label>
                                    <div class="autocomplete">
                                        <input
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            type="text" id="nationalite" name="nationalite"
                                            placeholder="Type a country or nationality" required>
                                        <div class="autocomplete-items" id="autocomplete-list"></div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="cin"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        CIN
                                    </label>
                                    <input type="text" id="cin" name="cin"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="JBxxxxxx" required>
                                </div>
                                <div class="mb-6">
                                    <label for="permis"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Permis
                                    </label>
                                    <input type="text" id="permis" name="permis"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="xx/xxxxxx" required>
                                </div>
                                <div class="mb-6">
                                    <label for="passport"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Passport
                                    </label>
                                    <input type="text" id="passport" name="passport"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                            </div>
                            <div class="flex justify-between">
                                <button type="button"
                                    class="next-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg "
                                    onclick="nextStep(1)">{{ __('Next') }}</button>
                            </div>
                        </div>

                        <div class="step" id="step2">
                            <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                                {{ __('steps.1') }}
                            </h2>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Delivrance CIN</label>
                                    <input type="date" id="CDelivre_date" name="CDelivre_date" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Validite CIN</label>
                                    <input type="date" id="CValide_date" name="CValide_date" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Delivrance Passeport</label>
                                    <input type="date" id="PassDelivre_date" name="PassDelivre_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Validite Passeport</label>
                                    <input type="date" id="PassValide_date" name="PassValide_date" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Delivrance Permie</label>
                                    <input type="date" id="PDelivre_date" name="PDelivre_date" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="PDelivre_date"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Date Validite Permie</label>
                                    <input type="date" id="PValide_date" name="PValide_date" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input_C">Upload CIN</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input_C" name="file_input_C" type="file">

                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input_P">Upload Permis</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input_P" name="file_input_P" type="file">

                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input_P">Upload Passeport</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input_Pass" name="file_input_Pass" type="file">

                                </div>
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
    </div>
    <style>
        .autocomplete-items {
            position: absolute;
            z-index: 10000;
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
    <!-- Include this script at the end of your HTML file -->
    <script src="{{ asset('/js/function.js') }}"></script>
    <script src="{{ asset('/js/contries.js') }}"></script>
    <script src="{{ asset('/js/country-cities.js') }}"></script>

    <script>
        handleDateInputs('PDelivre_date', 'PValide_date', 10);
        handleDateInputs('PassDelivre_date', 'PassValide_date', 5);
        handleDateInputs('CDelivre_date', 'CValide_date', 10);
    </script>
    <script>
        // ... (previous code)

        function validateStep1() {
            // Implement your Step 1 validation logic
            // Return true if validation passes, false otherwise
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();
            const date_naissance = document.getElementById('date_naissance').value.trim();
            const ville = document.getElementById('cities').value.trim();
            const adresse = document.getElementById('adresse').value.trim();
            const nationalite = document.getElementById('nationalite').value.trim();
            const cin = document.getElementById('cin').value.trim();
            const permis = document.getElementById('permis').value.trim();
            const passport = document.getElementById('passport').value.trim();

            // Add validation logic for other Step 1 fields
            // Example: Check if the fields are not empty
            if (fname === '' || lname === '' || phone === '' || email === '' || date_naissance === '' ||
                ville === '' || adresse === '' || nationalite === '' || cin === '' || permis === '') {
                alert('Step 1 validation failed: Please fill in all required fields.');
                return false;
            }

            // Add more specific validation rules as needed

            return true;
        }

        function validateStep2() {
            // Implement your Step 2 validation logic
            // Return true if validation passes, false otherwise
            const CDelivre_date = document.getElementById('CDelivre_date').value.trim();
            const CValide_date = document.getElementById('CValide_date').value.trim();
            const PassDelivre_date = document.getElementById('PassDelivre_date').value.trim();
            const PassValide_date = document.getElementById('PassValide_date').value.trim();

            // Add validation logic for other Step 2 fields
            // Example: Check if the fields are not empty
            if (CDelivre_date === '' || PassDelivre_date === '') {
                alert('Step 2 validation failed: Please fill in all required fields.');
                return false;
            }

            // Add more specific validation rules as needed

            return true;
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
                console.log(currentStep);

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

        }
    </script>
    <!-- Add this script to your HTML file or include it in your JavaScript file -->
    <script>
        function togglePassportFields() {
            var passportInput = document.getElementById('passport');
            var passDelivreDateInput = document.getElementById('PassDelivre_date');
            var passValideDateInput = document.getElementById('PassValide_date');
            var fileInputPass = document.getElementById('file_input_Pass');

            if (passportInput.value.trim() === '') {
                passDelivreDateInput.disabled = true;
                passValideDateInput.disabled = true;
                fileInputPass.disabled = true;
            } else {
                passDelivreDateInput.disabled = false;
                passValideDateInput.disabled = false;
                fileInputPass.disabled = false;
            }
        }

        // Call the function initially and bind it to the change event of the passport input
        document.addEventListener('DOMContentLoaded', function() {
            togglePassportFields();

            var passportInput = document.getElementById('passport');
            passportInput.addEventListener('input', togglePassportFields);
        });
    </script>
</x-app-layout>