<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Car') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 ">
                <style>
                    .step {
                        display: none;
                    }

                    .step.active {
                        display: block;
                    }
                </style>
                <ol class="items-center justify-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0">
                    <li class="flex items-center  text-blue-600 dark:text-blue-500 space-x-2.5">
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
                    <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5" id="nav-3">
                        <span
                            class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            3
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">{{ __('steps.2') }}</h3>
                        </span>
                    </li>
                </ol>

                <form action="{{ route('cars.store') }}" method="post" class="stepper-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="step active" id="step1">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('steps.1') }}</h2>
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Marque Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="marque">
                                    {{ __('marque') }}
                                </label>
                                <select name="marque" id="marque-input" style="width: 100%"
                                    onchange="modelsSelectUpdate()"
                                    class="js-example-templating bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="" selected></option>
                                    @foreach ($marques as $marque)
                                        <option value="{{ $marque->id }}" data-image="storage/{{ $marque->logo }}">
                                            {{ $marque->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Model Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="model">{{ __('model') }}</label>
                                <select name="model" id="model-input" style="width: 100%"
                                    class="js-example-templating bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="" selected></option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Categories Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="marque">{{ __('category') }}</label>
                                <select name="categorie" id="categorie-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option value="" selected></option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Carburant Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="carburant">{{ __('carburant') }}</label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <select name="carburant" id="carburant"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    @foreach ($content['carburant']['list'] as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <!-- État Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="etat">{{ __('etat') }}</label>
                                <select name="etat" id="etat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    @foreach ($content['etat']['list']['car'] as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Transcription Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="transcription">{{ __('transcription') }}</label>
                                <select name="transcription" id="transcription"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    @foreach ($content['transcription']['list'] as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-4 grid-cols-2 gap-2">
                            <!-- Nr. Chassis Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="nrchassis">{{ __('Chassis') }}</label>
                                <input type="text" name="nrchassis" id="nrchassis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Puissance Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="puissance">{{ __('Puissance') }}</label>
                                <input type="number" name="puissance" id="puissance"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    max="200"required>
                            </div>
                            <!-- Color Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="color">{{ __('Color') }}</label>
                                <input type="color" name="color" id="color"
                                    style="width: 100%;height: 42px; padding:0px"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Nombre de Places Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="nbplace">{{ __('Places') }}</label>
                                <input type="number" name="nbplace" id="nbplace"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    max="6" min="2" required>
                            </div>
                            <!-- Checkbox for WW -->
                            <div lass="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="ww">WW</label>
                                <input type="checkbox" name="ww" id="ww"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">

                            </div>
                        </div>
                        <div id="matriculediv">


                            <!-- Immatriculation1 Field -->
                            <div class="mb-6" id="immatriculation1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="immatriculation1">{{ __('Immatriculation') }} </label>
                                <div class="flex grid-cols-3 gap-2">
                                    <input type="number" min="1" max="99999" name="immatriculation1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required>
                                    <select name="lettre"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required>
                                        <option value="" selected>Select an Arabic letter</option>
                                        <option value="أ">أ</option>
                                        <option value="ب">ب</option>
                                        <option value="ت">ت</option>
                                        <!-- Add more options for other Arabic letters as needed -->
                                    </select>
                                    <input type="number" name="immatriculation2"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required min="1" max="89">

                                </div>
                            </div>
                        </div>


                        <div class="grid grid-cols-3 gap-2">
                            <!-- Km Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="km">{{ __('Kilométrage') }}
                                    {{ __('Actuel') }}</label>
                                <input type="number" name="km" id="km"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Kilométrage Journalier Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="kmjr">{{ __('Kilométrage') }}
                                    {{ __('Journalier') }}</label>
                                <input type="number" name="kmjr" id="kmjr"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Kilométrage Vidange Field -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="kmvidange">{{ __('Kilométrage') }}
                                    {{ __('Vidange') }}</label>
                                <input type="number" name="kmvidange" id="kmvidange"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button
                                class="next-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg "
                                onclick="nextStep(1)">{{ __('Next') }}</button>
                        </div>
                    </div>

                    <div class="step" id="step2">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('steps.1') }}
                        </h2>
                        <div id="carte_grise">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="date_validite_CG"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}
                                        {{ __('Validite') }} {{ __('Carte_Grise') }}</label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    <input type="date" required id="date_validite_CG" name="date_validite_CG"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="recto">{{ __('Upload') }} {{ __('Carte_Grise') }}
                                        (PDF)</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="cartegrise" name="cartegrise" type="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2" id="autorisationdv">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="date_validite_CG"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}
                                    {{ __('Validite') }}</label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <input type="date" required id="date_validite_autorisation"
                                    name="date_validite_autorisation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="recto">{{ __('Upload') }}
                                    {{ __('Autorisation') }} (PDF)</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="autorisation" name="autorisation" type="file" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2" id="controlv">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="date_validite_CG"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}
                                    {{ __('Validite') }}</label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <input type="date" required id="date_validite_control"
                                    name="date_validite_control"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="recto">{{ __('Upload') }}
                                    {{ __('Control') }} (PDF)</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="control" name="control" type="file" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2" id="issurrance_vignette">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="date_validite_CG"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}
                                    {{ __('Validite') }}</label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <input type="date" required id="date_validite_issurrance"
                                    name="date_validite_issurrance"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="issurrance">{{ __('Upload') }}
                                    {{ __('issurrance') }} (PDF)</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="issurrance" name="issurrance" type="file" required>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="date_validite_CG"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date') }}
                                    {{ __('Validite') }}</label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <input type="date" required id="date_validite_vignette"
                                    name="date_validite_vignette"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="vignette">{{ __('Upload') }}
                                    {{ __('Vignette') }} (PDF)</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="vignette" name="vignette" type="file" required>
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button type="button"
                                class="prev-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg"
                                onclick="nextStep(-1)">{{ __('Previous') }}</button>
                            <button
                                class="next-button bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg"
                                onclick="nextStep(1)">{{ __('Next') }}</button>
                        </div>
                    </div>

                    <div class="step" id="step3">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('steps.2') }}
                        </h2>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="price_1">{{ __('Price') }}
                                    {{ __('High') }}</label>
                                <input type="number" name="price_1" id="price_1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="price_2">{{ __('Price') }}
                                    {{ __('Low') }}</label>
                                <input type="number" name="price_2" id="price_2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                        </div>
                        <!-- Status Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="status">{{ __('status') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                @foreach ($content['status']['list']['car'] as $item)
                                    <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div id="containe">

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


    <!-- Include this script at the end of your HTML file -->
    <script>
        const nav2 = document.getElementById('nav-2');
        const nav3 = document.getElementById('nav-3');
        let currentStep = 1; // Keeps track of the current step
        function updatenav() {
            switch (currentStep) {
                case 1:
                    nav2.classList.remove('text-blue-600', 'dark:text-blue-500');
                    nav3.classList.remove('text-blue-600', 'dark:text-blue-500');
                    nav2.classList.add('text-gray-500', 'dark:text-gray-400');
                    nav3.classList.add('text-gray-500', 'dark:text-gray-400');
                    break;
                case 2:
                    nav2.classList.add('text-blue-600', 'dark:text-blue-500');
                    nav2.classList.remove('text-gray-500', 'dark:text-gray-400');
                    nav3.classList.remove('text-blue-600', 'dark:text-blue-500');
                    break;
                case 3:
                    nav3.classList.add('text-blue-600', 'dark:text-blue-500');
                    nav3.classList.remove('text-gray-500', 'dark:text-gray-400');
                    break;

                default:
                    break;
            }
        }
        // Function to validate Step 1 fields
        function validateStep1() {
            // Get values of required fields in Step 1
            var marque = document.getElementById('marque-input').value;
            var ww = document.getElementById('ww').checked; // Use checked instead of value
            var model = document.getElementById('model-input').value;
            var categorie = document.getElementById('categorie-input').value;
            var carburant = document.getElementById('carburant').value;
            var etat = document.getElementById('etat').value;
            var transcription = document.getElementById('transcription').value;
            var nrchassis = document.getElementById('nrchassis').value;
            var puissance = document.getElementById('puissance').value;
            var color = document.getElementById('color').value;
            var nbplace = document.getElementById('nbplace').value;
            var km = document.getElementById('km').value;
            var kmjr = document.getElementById('kmjr').value;
            var kmvidange = document.getElementById('kmvidange').value;

            var matricule = true;
            if (!ww) { // Check if "WW" checkbox is checked
                var immatriculation1 = document.getElementById('immatriculation1').value;
                var immatriculation2 = document.getElementById('immatriculation2').value;
                var lettre = document.getElementById('lettre').value;
                matricule = immatriculation1 === '' || lettre === '' || immatriculation2 === '';
                console.log(matricule);
            } else {
                var immatriculation1 = document.getElementById('immatriculationWW').value;
                matricule = immatriculation1 === '';
                console.log(matricule);
            }

            // Check if any required field is empty
            if (
                marque === '' ||
                model === '' ||
                categorie === '' ||
                carburant === '' ||
                etat === '' ||
                transcription === '' ||
                nrchassis === '' ||
                puissance === '' ||
                color === '' ||
                nbplace === '' ||
                km === '' ||
                kmjr === '' ||
                kmvidange === '' || matricule
            ) {
                // Fields are empty, display an alert or some validation message
                alert('Please fill out all required fields in Step 1');
                return false; // Validation failed
            }

            // All required fields are filled out, validation passed
            return true;
        }


        // Function to validate Step 2 fields
        function validateStep2() {
            // Get values of required fields in Step 2
            var dateValiditeCG = document.getElementById('date_validite_CG').value;
            var carteGriseFile = document.getElementById('cartegrise').value;
            var dateValiditeAutorisation = document.getElementById('date_validite_autorisation').value;
            var autorisationFile = document.getElementById('autorisation').value;
            var dateValiditeControl = document.getElementById('date_validite_control').value;
            var controlFile = document.getElementById('control').value;
            var dateValidite{{ __('issurrance') }} = document.getElementById('date_validite_issurrance').value;
            var issurranceFile = document.getElementById('issurrance').value;
            var dateValidite{{ __('Vignette') }} = document.getElementById('date_validite_vignette').value;
            var vignetteFile = document.getElementById('vignette').value;

            // Check if any required field is empty
            if (
                dateValiditeCG === '' ||
                carteGriseFile === '' ||
                dateValiditeAutorisation === '' ||
                autorisationFile === '' ||
                dateValiditeControl === '' ||
                controlFile === '' ||
                dateValidite{{ __('issurrance') }} === '' ||
                issurranceFile === '' ||
                dateValidite{{ __('Vignette') }} === '' ||
                vignetteFile === ''
            ) {
                // Fields are empty, display an alert or some validation message
                alert('Please fill out all required fields in Step 2');
                return false; // Validation failed
            }

            // All required fields are filled out, validation passed
            return true;
        }

        // Function to move to the next step
        function nextStep(stepChange) {
            // Validate fields based on the current step
            var isValid = false;
            if (stepChange > 0) {
                switch (currentStep) {
                    case 1:
                        console.log("case 1");
                        isValid = validateStep1();
                        console.log(currentStep);
                console.log(stepChange);
                console.log(isValid);
                        break;
                    case 2:
                        
                        console.log("case 2");
                        isValid = validateStep2();
                        console.log(currentStep);
                console.log(stepChange);
                console.log(isValid);
                        break;
                }
                console.log(currentStep);
                console.log(stepChange);
                console.log(isValid);
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
    <script>
        // Get references to the marque and model select elements
        const marqueSelect = document.getElementById('marque-input');

        function modelsSelectUpdate() {
            const selectedmarqueId = marqueSelect.value;

            // Make AJAX request
            $.ajax({
                url: '/getModels/' + selectedmarqueId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    // Example: Populate another dropdown with the models
                    var modelsDropdown = $(
                        '#model-input'
                    ); // Replace 'yourModelsSelect' with the actual ID or class of your models dropdown/select

                    // Clear existing options
                    modelsDropdown.empty();

                    // Populate options
                    $.each(data, function(index, model) {
                        modelsDropdown.append('<option  value="' + model.id + '">' + model.name +
                            '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
    <script>
        const matriculediv = document.getElementById('matriculediv');
        $(document).ready(function() {
            if (this.checked) {
                matriculediv.innerHTML = `<!-- Immatriculation WW Field -->
                    <div class="mb-6" id="immatriculationWW">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="immatriculationWW">{{ __('Immatriculation') }} WW</label>
                        <input type="text" name="immatriculationWW"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>`;
            } else {
                matriculediv.innerHTML = `<!-- Immatriculation1 Field -->
                    <div class="mb-6" id="immatriculation1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="immatriculation1">{{ __('Immatriculation') }} </label>
                        <div class="grid grid-cols-3 gap-2">

                            <input type="number" min="1" max="99999" name="immatriculation1" id="immatriculation1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required >
                            <select name="lettre" id="lettre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value=""  selected>Select an Arabic letter</option>
                                <option value="أ">أ</option>
                                <option value="ب">ب</option>
                                <option value="ت">ت</option>
                                <!-- Add more options for other Arabic letters as needed -->
                            </select>
                            <input type="number" name="immatriculation2" id="immatriculation2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required min="1" max="89">

                        </div>
                    </div>`;
            }
            // Handle checkbox change event
            $("#ww").change(function() {
                if (this.checked) {
                    matriculediv.innerHTML = `<!-- Immatriculation WW Field -->
                    <div class="mb-6" id="immatriculationWW">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="immatriculationWW">{{ __('Immatriculation') }} WW</label>
                        <input type="text" name="immatriculationWW"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>`;
                } else {
                    matriculediv.innerHTML = `<!-- Immatriculation1 Field -->
                    <div class="mb-6" id="immatriculation1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="immatriculation1">{{ __('Immatriculation') }} </label>
                        <div class="grid grid-cols-3 gap-2">

                            <input type="number" min="1" max="99999" name="immatriculation1" id="immatriculation1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required >
                            <select name="lettre" id="lettre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value=""  selected>Select an Arabic letter</option>
                                <option value="أ">أ</option>
                                <option value="ب">ب</option>
                                <option value="ت">ت</option>
                                <!-- Add more options for other Arabic letters as needed -->
                            </select>
                            <input type="number" name="immatriculation2" id="immatriculation2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required min="1" max="89">

                        </div>
                    </div>`;
                }
            });
        });
    </script>
    <script>
        const statusSelect = document.getElementById('status');
        const sousLocation = document.getElementById('sous_location');
        const credit = document.getElementById('credit');
        const containe = document.getElementById('containe');



        statusSelect.addEventListener('change', function() {
            const selectedStatus = statusSelect.value;

            if (selectedStatus === 'Sous Location') {
                // Show the "Sous Location" section and hide "Crédit"
                containe.innerHTML = `<div id="sous_location" class="grid grid-cols-2 gap-2">
                    <!-- Agency Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="agency">{{ __('Agency') }}</label>
                        <input type="text" name="agency" id="agency"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Sous Price Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="sous_price">{{ __('status.0') }}
                            {{ __('Price') }}</label>
                        <input type="text" name="sous_price" id="sous_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Date Sous Location Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="date_sous_location">{{ __('Date') }}  {{ __('status.0') }}</label>
                        <input type="date" name="date_sous_location" id="date_sous_location"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Joint Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="joint">
                            ({{ __('Upload') }})</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            name="joint" id="joint" type="file" required>
                    </div>
                </div>`;
            } else if (selectedStatus === 'credit') {
                // Show the "Crédit" section and hide "Sous Location"
                containe.innerHTML = `<div id="credit" class="grid grid-cols-2 gap-2">
                    <!-- Provider Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="provider">{{ __('Provider') }}</label>
                        <input type="text" name="provider" id="provider"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Date Achat Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="date_achat">{{ __('Buy') }} {{ __('Date') }}
                            </label>
                        <input type="date" name="date_achat" id="date_achat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Date Traite Achat Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="date_traite_achat">{{ __('Traite') }} {{ __('Date') }} </label>
                        <input type="date" name="date_traite_achat" id="date_traite_achat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- {{ __('Price') }} Achat Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="prix_achat">{{ __('Buy') }} {{ __('Price') }} 
                            </label>
                        <input type="number" name="prix_achat" id="prix_achat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Avance Achat Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="avance_achat">{{ __('Buy') }} {{ __('Avance') }} </label>
                        <input type="number" name="avance_achat" id="avance_achat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <!-- Duree Achat Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="duree_achat">{{ __('Buy') }} {{ __('Duration') }} </label>
                        <input type="number" name="duree_achat" id="duree_achat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="reste">{{ __('Reste') }} </label>
                        <input type="text" name="reste" id="reste" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                    </div>
                </div>
                <script type="text/javascript" src="{{ asset('/js/credit.js') }}">`;
            } else {
                // Hide both sections if neither "Sous Location" nor "Crédit" is selected
                containe.innerHTML = '';
            }
        });
    </script>
    <script>
        const price1Input = document.getElementById('price_1');
        const price2Input = document.getElementById('price_2');

        price1Input.disable = true; // Initially disable price_1

        price2Input.addEventListener('change', function() {
            price1Input.disable = price2Input.value === '' ? true : false;
            price1Input.value = price2Input.value;
            price1Input.min = price2Input.value;
        });
        price1Input.addEventListener('change', function() {
            price2Input.max = price1Input.value;
        });
    </script>
</x-app-layout>
