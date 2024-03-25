<!-- Main modal -->
<div id="EditeLocation{{ $location->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edite Office
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="EditeLocation{{ $location->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('locations.update', $location->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="isOffice" name="isOffice" value="on" />
                    <div id="contentContainer">
                        <div class="mb-6">
                            <label for="cities" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Ville</label>
                            <div class="autocomplete">
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="text" id="cities" name="city" value="{{ $location->office->city }}"
                                    placeholder="Type a cities" required>
                                <div class="autocomplete-items" id="autocomplete-list-cities"></div>
                            </div>
                        </div>
                        <div class="flex flex-row gap-4 w-full">
                            <div class="mb-6 w-full">
                                <label for="fixe"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fixe</label>
                                <input type="tel" id="fixe" name="fixe" value="{{ $location->office->fixe }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6 w-full">
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                <input type="tel" id="phone" name="phone" required
                                    value="{{ $location->office->phone }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                        <div class="flex flex-row gap-4 w-full">
                            <div class="mb-6 w-full">
                                <label for="addressLine1"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address Line
                                    1</label>
                                <textarea
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="addressLine1" id="addressLine1" cols="30" rows="5" required>{{ $location->office->addressLine1 }}</textarea>
                            </div>
                            <div class="mb-6 w-full">
                                <label for="addressLine2"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address Line
                                    2</label>
                                <textarea
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="addressLine2" id="addressLine2" cols="30" rows="5">{{ $location->office->addressLine2 }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="EditeLocation{{ $location->id }}" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edite</button>
                        <button data-modal-hide="EditeLocation{{ $location->id }}" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/country-cities.js') }}"></script>
