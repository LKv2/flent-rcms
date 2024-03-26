<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $task->title }}
        </h2>
    </x-slot>
    <form action="{{ route('tasks.done', $task->id) }}" method="post">
        @csrf
        <input type="hidden" name="taskId" value="{{ $task->id }}">
        @if ($task->type == 'Car Task')
            @switch($task->title)
                @case('Vidange')
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="kmvidange">Kilométrage
                            Vidange</label>
                        <input type="number" name="kmvidange" id="kmvidange" max="{{ $car[0]->km }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                            required>
                    </div>

                @break;
                @case('Autorisation Circulation')
                    <div class="grid grid-cols-2 gap-2" id="autorisationdv">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                Validite</label>
                            <input type="date" id="date_validite_autorisation" name="date_validite_autorisation" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="recto">Upload
                                autorisation</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="autorisation" name="autorisation" type="file" required>
                        </div>
                    </div>
                @break;
                @case('Control Technique')
                    <div class="grid grid-cols-2 gap-2" id="controlv">

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                Validite</label>
                            <input type="date" id="date_validite_control" name="date_validite_control" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="recto">Upload
                                Control</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="control" name="control" type="file" required>
                        </div>
                    </div>
                @break;
                @case('Carte Grise')
                    <div id="carte_grise">

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_validite_CG"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                Validite</label>
                            <input type="date" id="date_validite_CG" name="date_validite_CG"  required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="verso">Upload
                                Carte Grise</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="verso" name="verso" type="file" required>
                        </div>
                    </div>
                @break;
                @case('Vignette Renewal')
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_validite_CG"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                        Validite</label>
                    <input type="date" id="date_validite_vingnette" name="date_validite_vingnette"  required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="vignette">Upload
                            Vignette</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="vignette" name="vignette" type="file" required>
                    </div>
                @break;
                @case('Insurance Renewal')
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_validite_CG"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                        Validite</label>
                    <input type="date" id="date_validite_issurrance" name="date_validite_issurrance"  required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="issurance">Upload
                            Issurance</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="issurance" name="issurance" type="file" required>
                    </div>
                @break;

                @default
            @endswitch
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                     for="cout">Price</label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                <input type="number" name="cout" id="cout"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                    required>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                     for="cout">Date </label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                <input type="date" name="date" id="date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                    required>
            </div>
        @endif

        @if ($task->type == 'Booking Task')
            @if (str_contains($task->title, 'Checkin'))
                <div class="step " id="step-2">
                    <div class="my-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="km_depart">Kilométrage
                            Depart</label>
                        <input type="number" name="km_depart" id="km_depart" min="{{ $booking->car->km }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
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
                    </div>
                    <div class="my-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="km_depart">disaccount</label>
                        <input type="number" name="disaccount" id="disaccount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                            required>
                    </div>
                </div>
            @endif
            @if (str_contains($task->title, 'Checkout'))
                <div class="step " id="step-2">
                    <div class="my-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="km_depart">Kilométrage
                            Return</label>
                        <input type="number" name="km_retour" id="km_retour" min="{{ $booking->car->km }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                            required>
                    </div>
                    <div class="my-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="km_depart">Carburant Return</label>
                        <select name="carburant_retour" id="carburant_retour" required>
                            <option value="full">Full</option>
                            <option value="half">Half</option>
                            <option value="empty">Empty</option>
                        </select>
                    </div>
                    <div class="my-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="km_depart">surcharge</label>
                        <input type="number" name="surcharge" id="surcharge"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500""
                            required>
                    </div>
                </div>
            @endif
        @endif
        <input class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" type="submit" value="Done">
    </form>
</x-app-layout>
