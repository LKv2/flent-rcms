<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edite client') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <form action="{{ route('clients.update', $client->id) }}" method="post" id="form" class="stepper-form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->

            <!-- Step 1: Voiture Info -->
            <div class="step" id="step-1">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mb-6">
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                            name</label>
                        <input type="text" id="fname" name="fname" value="{{ $client->fname }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John" required>
                    </div>
                    <div class="mb-6">
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                            name</label>
                        <input type="text" id="lname" name="lname" value="{{ $client->lname }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Doe" required>
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                            number</label>
                        <input type="tel" id="phone" name="phone" value="{{ $client->phone }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="123-45-678" pattern="[0-9]{10}" required>
                    </div>
                    <div class="mb-6">
                        <label for="adresse"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" id="adresse" name="adresse" value="{{ $client->adresse }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="123 Main St." required>
                    </div>
                    <div class="mb-6">
                        <label for="cin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CIN</label>
                        <input type="text" id="cin" name="cin" value="{{ $client->cin }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="JBxxxxxx" required>
                    </div>
                    <div class="mb-6">
                        <label for="permis"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permis</label>
                        <input type="text" id="permis" name="permis" value="{{ $client->permis }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="xx/xxxxxx" required>
                    </div>
                    <div class="mb-6">
                        <label for="passport" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Passport
                        </label>
                        <input type="text" id="passport" name="passport" onchange="checkPassportInput()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Step 2: Document Info -->
            <div class="step " id="step-2">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="PDelivre_date">Date Delivrance CIN</label>
                        <input type="date" id="CDelivre_date" name="CDelivre_date"
                            value="{{ $client->CDelivre_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="CValide_date">Date Validite CIN</label>
                        <input type="date" id="CValide_date" name="CValide_date" value="{{ $client->CValide_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="PDelivre_date">Date Delivrance Permie</label>
                        <input type="date" id="PDelivre_date" name="PDelivre_date"
                            value="{{ $client->PDelivre_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="PValide_date">Date Validite Permie</label>
                        <input type="date" id="PValide_date" name="PValide_date"
                            value="{{ $client->PValide_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input_C">Upload CIN</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input_C" name="file_input_C" type="file"
                            value="{{ $client->file_input_C }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input_P">Upload Permis</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input_P" name="file_input_P" type="file"
                            value="{{ $client->file_input_P }}">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="PDelivre_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Date Delivrance Passeport</label>
                        <input type="date" id="PassDelivre_date" name="PassDelivre_date"
                            value="{{ $client->PassValide_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="PDelivre_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Date Validite Passeport</label>
                        <input type="date" id="PassValide_date" name="PassValide_date"
                            value="{{ $client->PassValide_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input_P">Upload Passeport</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input_Pass" name="file_input_Pass" type="file"
                            value="{{ $client->file_input_Pass }}">

                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="submit">Update</button>
                </div>
            </div>
        </form>
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
    <!-- Include this script at the end of your HTML file -->
    <script src="{{ asset('/js/function.js') }}"></script>
    <script src="{{ asset('/js/contries.js') }}"></script>
    <script>
        const passportInput = document.getElementById("passport");
        passportInput.addEventListener('change', checkPassportInput());
        handleDateInputs('PDelivre_date', 'PValide_date', 10);
        handleDateInputs('PassDelivre_date', 'PassValide_date', 5);
        handleDateInputs('CDelivre_date', 'CValide_date', 10);
    </script>
</x-app-layout>
