<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Agencie') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 py-2 space-y-6">
                <div class="container mx-auto p-4">
                    <form action="{{ route('agencies.store') }}" method="post" class="stepper-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="step active" id="step1">

                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-6">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="John" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="logo">Upload Logo</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="logo" name="logo" type="file">

                                </div>
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
                                    <label for="adresse"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Adresse</label>
                                    <input type="text" id="adresse" name="adresse"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Doe" required>
                                </div>


                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div class="mb-6">
                                    <label for="cin"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        CIN
                                    </label>
                                    <input type="text" id="cin" name="cin"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="JBxxxxxx" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input_C">Upload CIN</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input_C" name="file_input_C" type="file">

                                </div>
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

                            </div>
                            <div class="flex justify-between mt-8">
                                <button type="submit"
                                    class="bg-gray-500 text-white dark:bg-white dark:text-black py-2 px-8 rounded-lg">Submit</button>
                            </div>
                        </div>


                    </form>



                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('/js/function.js') }}"></script>
    <script>
        handleDateInputs('CDelivre_date', 'CValide_date', 10);
    </script>
</x-app-layout>
