<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update a Car') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 ">

                <form action="{{ route('cars.update', $car->id) }}" method="post" class="stepper-form"
                    enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                    </h2>
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Marque Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="marque">{{ __('marque') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <select name="marque" id="marque-edite-input" onchange="modesSelectUpdate()"
                                class="js-example-templating bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($marques as $marque)
                                    @if ($car->mode->marque_id == $marque->id)
                                        <option selected value="{{ $marque->id }}">{{ $marque->name }}
                                        </option>
                                    @else
                                        <option value="{{ $marque->id }}">{{ $marque->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- mode Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="mode">{{ __('mode') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <select name="model" id="mode-edite-input"
                                class="js-example-templating bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($modes as $mode)
                                    @if ($car->model == $mode->id)
                                        <option selected value="{{ $mode->id }}">{{ $mode->name }}
                                        </option>
                                    @else
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                        <!-- Categories Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="marque">{{ __('category') }}</label>
                            <select name="categorie" id="categorie-input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected></option>
                                @foreach ($categories as $categorie)
                                    <option {{ $car->categorie == $categorie->id ? 'selected' : '' }}
                                        value="{{ $categorie->id }}">{{ $categorie->name }}</option>
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
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($content['carburant']['list'] as $item)
                                    <option {{ $car->carburant == $item['value'] ? 'selected' : '' }}
                                        value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- État Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="etat">{{ __('etat') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <select name="etat" id="etat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                                @foreach ($content['etat']['list']['car'] as $item)
                                    <option {{ $car->etat == $item['value'] ? 'selected' : '' }}
                                        value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Transcription Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="transcription">{{ __('transcription') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <select name="transcription" id="transcription"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                                @foreach ($content['transcription']['list'] as $item)
                                    <option {{ $car->transcription == $item['value'] ? 'selected' : '' }}
                                        value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <!-- Nr. Chassis Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="nrchassis">{{ __('Chassis') }}</label>
                            <input type="text" name="nrchassis" id="nrchassis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                value="{{ $car->nrchassis }}">
                        </div>
                        <!-- Puissance Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="puissance">{{ __('Puissance') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="number" name="puissance" id="puissance"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                max="200" value="{{ $car->puissance }}">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="color">{{ __('Color') }}</label>
                            <input type="color" name="color" id="color" value="{{ $car->color }}"
                                class="bg-gray-50 border h-[42px] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <!-- Nombre de Places Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="nbplace">{{ __('Places') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="number" name="nbplace" id="nbplace"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                max="6" min="2" value="{{ $car->nbplace }}">
                        </div>

                    </div>
                    <div id="matriculediv">

                        <!-- Immatriculation WW Field -->
                        <div class="mb-6" id="immatriculationWW">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="immatriculationWW">{{ __('Immatriculation') }} WW</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="text" name="immatriculationWW"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                value="{{ $car->immatriculationWW }}">
                        </div>
                        <!-- Immatriculation1 Field -->
                        <div class="mb-6" id="immatriculation1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="immatriculation1">{{ __('Immatriculation') }} </label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <div class="grid grid-cols-3 gap-2">

                                <input type="text" name="immatriculation1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                    value="{{ $car->immatriculation1 }}">
                                <select name="lettre"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Select an Arabic letter</option>
                                    <script>
                                        const arabicAlphabet = [
                                            'أ', 'ب', 'ت', 'ث', 'ج', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق',
                                            'ك', 'ل', 'م', 'ن', 'ه', 'و', 'ي'
                                        ];

                                        // Get the selected letter from the server-side variable
                                        const selectedLetter = "{{ $car->lettre }}";

                                        // Loop through the Arabic alphabet array to generate options
                                        for (let i = 0; i < arabicAlphabet.length; i++) {
                                            const letter = arabicAlphabet[i];
                                            const isSelected = letter === selectedLetter ? 'selected' : '';
                                            document.write(`<option value="${letter}" ${isSelected}>${letter}</option>`);
                                        }
                                    </script>
                                    <!-- Add more options for other Arabic letters as needed -->
                                </select>

                                <input type="number" name="immatriculation2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                    min="1" max="89"value="{{ $car->immatriculation2 }}">

                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-3 gap-2">
                        <!-- Km Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="km">{{ __('Kilométrage') }}
                                {{ __('Actuel') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="number" name="km" id="km"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                value="{{ $car->km }}">
                        </div>
                        <!-- Kilométrage Journalier Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="kmjr">{{ __('Kilométrage') }}
                                {{ __('Journalier') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="number" name="kmjr" id="kmjr"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                value="{{ $car->kmjr }}">
                        </div>
                        <!-- Kilométrage Vidange Field -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="kmvidange">{{ __('Kilométrage') }}
                                {{ __('Vidange') }}</label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="number" name="kmvidange" id="kmvidange"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                                value="{{ $car->kmvidange }}">
                        </div>
                    </div>
                    <!-- Add form fields for other Voiture Info as needed -->

                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                    </h2>
                    <div id="carte_grise">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="date_validite_CG"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Date') }}
                                    {{ __('Validite') }} {{ __('Carte_Grise') }}
                                </label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <input type="date" id="date_validite_CG" name="date_validite_CG"
                                    value="{{ $car->date_validite_CG }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="recto">{{ __('Upload') }} {{ __('Carte_Grise') }}
                                    (PDF)</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="cartegrise" name="cartegrise" type="file"
                                    value="{{ $car->cartegrise }}">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2" id="autorisationdv">

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Date') }}
                                {{ __('Validite') }} {{ __('Autorisation') }}
                            </label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="date" id="date_validite_autorisation" name="date_validite_autorisation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $car->date_validite_autorisation }}">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="recto">{{ __('Upload') }}
                                {{ __('Autorisation') }} (PDF)</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="autorisation" name="autorisation" type="file"
                                value="{{ $car->autorisation }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2" id="controlv">

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Date') }}
                                {{ __('Validite') }} {{ __('Control') }}
                            </label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="date" id="date_validite_control" name="date_validite_control"
                                value="{{ $car->date_validite_control }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="recto">{{ __('Upload') }}
                                {{ __('Control') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="control" name="control" type="file" value="{{ $car->control }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2" id="issurance_vignette">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Date') }}
                                {{ __('Validite') }} {{ __('Issurance') }}
                            </label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="date" id="date_validite_issurrance" name="date_validite_issurrance"
                                value="{{ $car->date_validite_issurrance }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="issurance">{{ __('Upload') }}
                                {{ __('Issurance') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="issurance" name="issurance" type="file" value="{{ $car->issurance }}">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Date') }}
                                {{ __('Validite') }} {{ __('Vignette') }}
                            </label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <input type="date" id="date_validite_vignette" name="date_validite_vignette"
                                value="{{ $car->date_validite_vignette }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="vignette">{{ __('Upload') }}
                                {{ __('Vignette') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="vignette" name="vignette" type="file" value="{{ $car->vignette }}">
                        </div>
                    </div>
                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">
                    </h2>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="price_1">{{ __('Price') }}
                                {{ __('High') }}</label>
                            <input type="number" name="price_1" id="price_1" value="{{ $car->price_1 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="price_2">{{ __('Price') }}
                                {{ __('Low') }}</label>
                            <input type="number" name="price_2" id="price_2" value="{{ $car->price_2 }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                        </div>
                    </div>
                    <!-- Status Field -->
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="status">{{ __('status') }}</label
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
                            @foreach ($content['status']['list']['car'] as $item)
                                <option {{ $car->status == $item['value'] ? 'selected' : '' }}
                                    value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div id="containeedite">

                    </div>
                    <div class="flex justify-between mt-8">
                        <button type="submit">{{ __('Edite') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
