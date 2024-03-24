<x-app-layout>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex w-full justify-around gap-6">
                <div
                    class="grow w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                    <div class="flex flex-row justify-around">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $client->fname . ' ' . $client->lname }}
                            </h5>
                        </a>
                    </div>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                        Phone : {{ $client->date_naissance }} <br>
                        Phone : {{ $client->phone }} <br>
                        Email : {{ $client->user()->email }} <br>
                        Addresse : {{ $client->adresse }} <br>
                        Ville : {{ $client->ville }} <br>
                        Nationalite : {{ $client->nationalite }} <br>

                    </p>
                </div>
                <div
                    class="grow w-full text-center p-4 flex gap-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a class="bg-gray-200 rounded-lg h-[90px]"
                        href="{{ route('clients.document', ['id' => $client->id, 'type' => 'CIN']) }}">
                        <h3 class="p-2">CIN : Carte d'Identide National</h3>
                        <p>{{ $client->cin }}</p>
                        <p>Valide :{{ $client->CValide_date }}</p>
                    </a>
                    <a class="bg-gray-200 rounded-lg h-[90px]"
                        href="{{ route('clients.document', ['id' => $client->id, 'type' => 'Permis']) }}">
                        <h3 class="p-2">Permis de Conduite</h3>
                        <p>{{ $client->permis }}</p>
                        <p>Valide :{{ $client->PValide_date }}</p>
                    </a>
                    @if ($client->passport)
                        <a class="bg-gray-200 rounded-lg h-[90px]"
                            href="{{ route('clients.document', ['id' => $client->id, 'type' => 'Passport']) }}">
                            <h3 class="p-2">Passport</h3>
                            <p>{{ $client->passport }}</p>
                            <p>Valide :{{ $client->PassValide_date }}</p>
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
