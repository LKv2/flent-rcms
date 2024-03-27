<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            {{ $car->marque()->name }} {{ $car->mode->name }} {{ $car->mode->year }}
            {{$car->immatriculation()}}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="flex w-full md:flex-row flex-col my-4 px-4">
                        <div class="w-1/2 flex-col">
                            <div class="h-48 md:h-72 w-full display_image bg-center bg-cover "
                                style="background-image: url('{{ asset('storage/' . $car->mode->exterior_image) }}');background-repeat: no-repeat;">
                            </div>
                            <div class="flex justify-center mt-3">
                                <img class="w-1/5 h-18 pb-3 mr-3 option"
                                    src="{{ asset('storage/' . $car->mode->exterior_image) }}">
                                <img class="w-1/5 h-18 pb-3 mr-3 option"
                                    src="{{ asset('storage/' . $car->mode->interior_image) }}">
                                <img class="w-1/5 h-18 pb-3 mr-3 option"
                                    src="{{ asset('storage/' . $car->mode->back_image) }}">
                                <img class="w-1/5 h-18 pb-3 mr-3 option"
                                    src="{{ asset('storage/' . $car->mode->front_image) }}">
                            </div>
                        </div>
                        <div class="flex w-1/2 p-3 flex-col justify-center items-center">
                            <div class="flex flex-row justify-around w-full">
                                <div class="w-1/2 w-full flex-col">
                                    <h5
                                        class="flex items-center text-3xl font-semibold md:justify-center tracking-tight text-gray-900 dark:text-white">
                                        {{ $car->mode->name }}</h5>
                                    <h5
                                        class="flex items-center text-center md:justify-center text-l  tracking-tight text-gray-600 dark:text-white">
                                        {{ $car->marque()->name }}</h5>
                                </div>
                                <img class=" h-12 flex items-center justify-center"
                                    src="{{ asset('storage/' . $car->marque()->logo) }}">
                            </div>
                            <div class="w-full grid md:grid-cols-4 grid-cols-2 gap-2 mt-6">
                                <p class="text-gray-600 dark:text-white">{{ __('Year') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->mode->year }}</p>
                                <p class="text-gray-600 dark:text-white">{{ __('Places') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->nbplace }}</p>
                                <p class="text-gray-600 dark:text-white">Bagage</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->km }}</p>
                                <p class="text-gray-600 dark:text-white">{{ __('Color') }}</p>
                                <p class="text-center font-semibold dark:text-white"><input type="color"
                                        value="{{ $car->color }}" disabled></p>
                                <p class="text-gray-600 dark:text-white">{{ __('Puissance') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->puissance }}</p>
                                <p class="text-gray-600 dark:text-white">{{ __('Kilométrage') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->kmjr }}</p>
                                <p class="text-gray-600 dark:text-white">{{ __('transcription') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->transcription }}</p>
                                <p class="text-gray-600 dark:text-white">{{ __('carburant') }}</p>
                                <p class="text-center font-semibold dark:text-white">{{ $car->carburant }}</p>
                            </div>
                            <div
                                class="grow w-full p-3 mt-6 justify-center text-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                Tarif journalier
                                <h2
                                    class="flex items-center text-4xl mt-3 font-semibold justify-center tracking-tight text-gray-900 dark:text-white">

                                    {{ $car->price() }}.00</h2>

                            </div>
                        </div>
                    </div>
                    <div class="flex w-full flex-row gap-4 px-4 mb-4">
                        
                    </div>
                    
                </div>
                <script type="text/javascript" src="{{ asset('/js/detail_car.js') }}"></script>
            </div>
        </div>
    </div>
</x-app-layout>
