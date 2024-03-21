<!-- Modal toggle -->
<button data-modal-target="ExportCar" data-modal-toggle="ExportCar"
    class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800"
    type="button">
    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
    </svg>
    {{ __('content.Export') }} {{ __('content.Car') }}
</button>

<!-- Main modal -->
<div id="ExportCar" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('content.Export') }} {{ __('content.Car') }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover-bg-gray-600 dark:hover-text-white"
                    data-modal-hide="ExportCar">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4" action="{{ route('export.car', 'cars') }}" method="post">
                @csrf
                <div class="p-8 grid grid-cols-4 gap-4">
                    @foreach ($allColumns as $column)
                        @switch($column)
                            @case('marque')
                            @case('model')
                            @case('categorie')
                            @case('categorie')
                            @case('carburant')
                            @case('etat')
                            @case('nrchassis')
                            @case('immatriculationWW')                            
                            @case('immatriculation1')
                            @case('status')
                            @case('sous_price')
                            @case('date_achat')
                            @case('prix_achat')
                            <div class="flex flex-row justify-between gap-4">

                                <label for="{{ $column }}">{{ $column }}</label>
                                <input type="checkbox" name="columns[]" value="{{ $column }}">
                            </div>
                            @break

                                
                        @endswitch
                    @endforeach

                </div>
                <button
                    class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800"
                    type="submit">Export CSV</button>
            </form>
        </div>
    </div>
</div>
