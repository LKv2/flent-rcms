<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $booking->id }}
        </h2>
        <button id="print-button">Print</button>
    </x-slot>
    

    <div id="print">
    <div>
        <div class="flex flex-row gap-24 justify-between items-center ">
            <div class="w-1/4 text-center">
                <p class="font-semibold">Royaume du Maroc</p>
                <p> Ministére de l'Equipement, du Transport et de la
                    Logistique</p>
            </div>
            <img class="h-32" src="C:\Users\soufi\Downloads\OIP.jpg">
            <div class="w-1/4 text-center">
                <p class="font-semibold">المملكة المغربية</p>
                <p>وزارة التجهيز والنقل واللوجستيك
                </p>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center ">
            <p class="font-semibold"> التصريح القبلي بكراء سيارة بدون سائق</p>
            <p class="text-xs">يعبأ من طرف المكتي القاطن بالمغرب</p>
            <p class="font-semibold">Déclaration préalable de location de voiture sans chauffeur</p>
            <p class="taxt-xs">(à renseigner par le locataire résident au Maroc ) </p>
        </div>
        <div class="flex flex-row justify-between items-center border-2 px-4">
            <p>Je soussigne </p>
            <p>أنا الممضي (ة) أسفله</p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Nom </p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->fname }}</p>
            <p class="w-1/2 text-right">الاسم العائلي</p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Prenom </p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->lname }}</p>
            <p class="w-1/2 text-right">الاسم الشخصي</p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">N° de la C.N.I.E <br>Ou carte de séjour</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->cin }}</p>
            <p class="w-1/2 text-right"> <span> رقم بطاقة التعريف الوطنية الإلكترونية</span> <br> <span>أو بطاقة
                    الإقامة</span></p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">N° du permis de conduire</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->permis }}</p>
            <p class="w-1/2 text-right"> رقم رخصة القيادة</p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Adresse</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->cin }}</p>
            <p class="w-1/2 text-right"> العنوان </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Ville</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->ville }}</p>
            <p class="w-1/2 text-right"> المدينة </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Code postal</p>
            <p class="uppercase w-1/4 text-center"></p>
            <p class="w-1/2 text-right"> الرمز البريدي </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">N° de GSM</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->phone }}</p>
            <p class="w-1/2 text-right"> الهاتف النقال </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Email</p>
            <p class="uppercase w-1/4 text-center">{{ $booking->client->user()->email}}</p>
            <p class="w-1/2 text-right"> العنوان الإلكتروني </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Déclare avoir pris en location le
                véhicule<br>
                Immatriculé sous numéro: <br>
                et appartenant à l'agence de location</p>
            <p class="uppercase w-1/4 items-center text-center">
                @if ($booking->car->immatriculation1)
                    {{ strval($booking->car->immatriculation1) . '|' . $booking->car->lettre . '|' . strval($booking->car->immatriculation2) }}
                @else
                    {{ $booking->car->immatriculationWW }}
                @endif
            </p>
            <p class="w-1/2 text-right"> أصرح أنني اكتريت المركبة المسجلة
                <br> الرقم<br>
                والتي هي في ملكية وكالة كراء السيارات
            </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p>Pour la période allant du </p>
            <p> خلال الفترة التي تمتد من </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">jour d'emprint (jj/HH/AAAA)
            <p class="uppercase w-1/4 items-center text-center">
                {{ (new DateTime($booking->pickup_date))->format('d / m / Y') }}
    
            </p>
            <p class="w-1/2 text-right"> يوم تسلم المركبة </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Heur d'emprint (HH:MM)
            <p class="uppercase w-1/4 items-center text-center">
                {{ (new DateTime($booking->pickup_date))->format('H:i') }}
            </p>
            <p class="w-1/2 text-right"> ساعة تسلم المركبة </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p>Au</p>
            <p> إلي </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">jour d'restitution (jj/HH/AAAA)
            <p class="uppercase w-1/4 items-center text-center">
                {{ (new DateTime($booking->dropoff_date))->format('d / m / Y') }}
            </p>
            <p class="w-1/2 text-right"> يوم تسلم المركبة </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Heur d'restitution (HH:MM)
            <p class="uppercase w-1/4 items-center text-center">
                {{ (new DateTime($booking->dropoff_date))->format('H:i') }}
            </p>
            <p class="w-1/2 text-right"> ساعة تسلم المركبة </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Fait à
            <p class="uppercase w-1/4 items-center text-center">Agadir</p>
            <p class="w-1/2 text-right"> حرر ب </p>
        </div>
        <div class="flex flex-row justify-between items-center border-x-2 border-b-2  px-4">
            <p class="w-1/2">Le
            <p class="uppercase w-1/4 items-center text-center"></p>
            <p class="w-1/2 text-right"> في </p>
        </div>
        <div class="flex flex-row">
            <div class="border-l-2 flex flex-col items-center text-center justify-start border-b-2  w-1/2 h-32">
                <p>لإمضاء و خاتم و كالة كراء السيارات</p>
                <p> Signature et cachet de l'agence de location</p>
            </div>
            <div class="border-x-2 border-b-2 items-start text-center justify-center w-1/2 h-32">
                <p> Signature de locataire إمضاء المكتري</p>
            </div>
        </div>
    </div>
    
    <div class="flex flex-col items-center ">
        <div class="flex w-full flex-row gap-24 justify-between items-center ">
            <div class="w-1/4 text-center">
                <p class="font-semibold">Ste TYR TOURS s.a.r.l</p>
                <p> كراء السيارات</p>
                <p> Agence Location de Voiture</p>
                <p> Rent a Car</p>
            </div>
            <img class="w-48" src="{{asset('logo.png')}}">
            <div class="w-1/4 text-center">
                <p class="font-semibold"> CONTRACT </p>
                <p> N 99830847
                </p>
            </div>
        </div>
        <div class="flex w-full flex-row justify-between items-center border px-4 ">
            <p class="w-full">Model : {{ $booking->car->mode->name }}</p>
            <p class="w-full">Immatriculation :
                @if ($booking->car->immatriculation1)
                    {{ strval($booking->car->immatriculation1) . '|' . $booking->car->lettre . '|' . strval($booking->car->immatriculation2) }}
                @else
                    {{ $booking->car->immatriculationWW }}
                @endif
            </p>
        </div>
        <h1>LOCATAIRE</h1>
        <div class="flex w-full flex-row justify-between items-center border-y  ">
            <div class="flex w-1/2 flex-col justify-between items-center border-l-2 px-4 ">
                <p class="w-full">Nom : {{ $booking->client->fname }}</p>
                <p class="w-full">Prenom : {{ $booking->client->lname }}</p>
                <p class="w-full">Date de naissance : {{ $booking->client->date_naissance }}</p>
                <p class="w-full">Nationalite : {{ $booking->client->nationalite }}</p>
                <p class="w-full">Adresse : {{ $booking->client->adresse }}</p>
                <p class="w-full">Ville : {{ $booking->client->ville ? $booking->client->ville : null }} </p>
                <p class="w-full">Telephone : {{ $booking->client->phone }}</p>
                <p class="w-full">Adresse a l'etranger: </p>
                <p class="w-full">Permis : {{ $booking->client->permis }} </p>
                <p class="w-full">Delivre le : {{ $booking->client->PDelivre_date }}<span class="mx-4">a</span>
                    {{ $booking->client->PValide_date }} </p>
                <p class="w-full">Passeport : {{ $booking->client->passport ? $booking->client->passport : null }} </p>
                <p class="w-full">Delivre le :
                    {{ $booking->client->PassDelivre_date ? $booking->client->PassDelivre_date : null }}<span class="mx-4">a</span>
                    {{ $booking->client->PassValide_date ? $booking->client->PassValide_date : null }} </p>
                <p class="w-full">C.I.N : {{ $booking->client->cin }}</p>
                <p class="w-full">Delivre le : {{ $booking->client->CDelivre_date }}<span class="mx-4">a</span>
                    {{ $booking->client->CValide_date }} </p>
            </div>
            <div class="flex w-1/2 flex-col justify-between items-center border-x-2 px-4 ">
                @if ($booking->client2)
                    <p class="w-full">Nom : {{ $booking->client2->fname }}</p>
                    <p class="w-full">Prenom : {{ $booking->client2->lname }}</p>
                    <p class="w-full">Date de naissance : {{ $booking->client2->date_naissance }}</p>
                    <p class="w-full">Nationalite : {{ $booking->client2->nationalite }}</p>
                    <p class="w-full">Adresse : {{ $booking->client2->adresse }}</p>
                    <p class="w-full">Ville : {{ $booking->client2->ville }} </p>
                    <p class="w-full">Telephone : {{ $booking->client2->phone }}</p>
                    <p class="w-full">Adresse a l'etranger: </p>
                    <p class="w-full">Permis : {{ $booking->client2->permis }} </p>
                    <p class="w-full">Delivre le : {{ $booking->client2->PDelivre_date }}<span class="mx-4">a</span>
                        {{ $booking->client2->PValide_date }} </p>
                    <p class="w-full">Passeport : {{ $booking->client2->passport }} </p>
                    <p class="w-full">Delivre le : {{ $booking->client2->PassDelivre_date }}<span class="mx-4">a</span>
                        {{ $booking->client2->PassValide_date }} </p>
                    <p class="w-full">C.I.N : {{ $booking->client2->cin }}</p>
                    <p class="w-full">Delivre le : {{ $booking->client2->CDelivre_date }}<span class="mx-4">a</span>
                        {{ $booking->client2->CValide_date }} </p>
                @else
                    <p class="w-full">Nom : </p>
                    <p class="w-full">Prenom : </p>
                    <p class="w-full">Date de naissance : </p>
                    <p class="w-full">Nationalite : </p>
                    <p class="w-full">Adresse : </p>
                    <p class="w-full">Ville : </p>
                    <p class="w-full">Telephone : </p>
                    <p class="w-full">Adresse a l'etranger: </p>
                    <p class="w-full">Permis : </p>
                    <p class="w-full">Delivre le : <span class="mx-4">a</span>
                    </p>
                    <p class="w-full">Passeport : </p>
                    <p class="w-full">Delivre le : <span class="mx-4">a</span>
                    </p>
                    <p class="w-full">C.I.N : </p>
                    <p class="w-full">Delivre le : <span class="mx-4">a</span>
                    </p>
                @endif
    
            </div>
        </div>
        <div class="flex w-full flex-row justify-start items-center   ">
            <div class="flex w-1/2 flex-col justify-between items-center">
                <table class="border-collapse border w-full my-2 mx-2">
                    <tbody>
                        <tr>
                            <td class="border w-1/4"></td>
                            <td class="border w-6 text-center">J</td>
                            <td class="border w-6 text-center">M</td>
                            <td class="border w-6 text-center">A</td>
                            <td class="border w-1/2"></td>
                        </tr>
                        <tr>
                            <td class="border ">Depart : </td>
                            <td class="border ">
                                {{ (new DateTime($booking->pickup_date))->format('d') }}
                            </td>
                            <td class="border ">{{ (new DateTime($booking->pickup_date))->format('m') }}</td>
                            <td class="border ">{{ (new DateTime($booking->pickup_date))->format('Y') }}</td>
                            <td class="border ">Kilometrage : {{$booking->km_depart}} km</td>
                        </tr>
                        <tr>
                            <td class="border ">Retour : </td>
                            <td class="border ">{{ (new DateTime($booking->dropoff_date))->format('d') }}</td>
                            <td class="border ">{{ (new DateTime($booking->dropoff_date))->format('m') }}</td>
                            <td class="border ">{{ (new DateTime($booking->dropoff_date))->format('Y') }}</td>
                            <td class="border ">Kilometrage : {{$booking->km_retour}} km</td>
                        </tr>
                        <tr>
                            <td class="border " colspan="4">Duree de location : {{$booking->duration()}} jours</td>
    
                            <td class="border ">Kilometrage : {{$booking->km_retour-$booking->km_depart}} km</td>
                        </tr>
                    </tbody>
                </table>
                <table class="border-collapse border w-full mb-2 mx-2">
                    <tbody>
                        <tr>
                            <td class="border w-1/3"></td>
                            <td class="border w-1/3">Lieu</td>
                            <td class="border w-1/3">Heure</td>
                        </tr>
                        <tr>
                            <td class="border w-1/3">Livraison</td>
                            <td class="border w-1/3">{{ $booking->pickLo->name }}</td>
                            <td class="border w-1/3">{{ (new DateTime($booking->pickup_date))->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="border w-1/3">Reception</td>
                            <td class="border w-1/3">{{ $booking->dropLo->name }}</td>
                            <td class="border w-1/3">{{ (new DateTime($booking->pickup_date))->format('H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex w-full flex-col justify-between items-start border ">
                    <p class="w-full">Frais de Livraison/Reception :
                        {{ $booking->pickLo->amount + $booking->dropLo->amount }} dh</p>
                    <p class="w-full">TVA 20% : {{ $booking->amount * 0.2 }} dh</p>
                    <p class="w-full">Rachat Francise : </p>
                    <p class="w-full">Nationalite : </p>
                    <p class="w-full">Carburant : {{ $booking->carburant_depart }} </p>
                    <p class="w-full">Niveau Carburant : {{ $booking->carburant_retour }}</p>
                    <p class="w-full">Divers : </p>
                    <p class="w-full">Total Generale:{{ $booking->amount }} dh</p>
                </div>
                <p class="p-0 text-xs text-left w-full h-full" style="font-size: xx-small;line-height: normal;">
                    La Signature de contrat par le client confirm
                    qu's'engage avec CONFORT DRIVERS à:
                    <br>1 -Rendre la voiture en bon état tel qu'elle lui été confiée par CONFORT DRIVERS.
                    <br>2- Prendre en charge le véhicule.
                    <br>3- Sa responsabilité unique en cas de transport de morchandise interdite por lo loi.
                    <br>4- Respecter la durée du contrat, aucun remborsement ne sera permis à se sujet.
                    <br>5- Ce que tous les véhicules ne sont pas assuré en route piste sauf les 4x4
                    <br>6- Présenter en cas d'accident un costet amiable ou PV de Police pu gendarmerie.
                    <br>7- Régler le montant de la location au début de location soit à la livraison de la voiture.
                    <br>8- La reconaissance des conditions stippulées au verso.
                </p>
            </div>
            <div class="flex w-1/2 flex-col justify-start items-start border-r-2 px-4 ">
                <p class="p-0 text-xs" style="font-size: 5px;line-height: normal;">
                    NOTICE 24 HOURS OVERDUE FROM THE DATE AND HOUR OF THIS VEHICULE UNLESS Alln Leading CAR HAS
                    BEEN INFORMED OF THE INTENTION OF PROLONGING THE CONTRACT THE ADDITIONL DEPOSIT REQUIRED
                    MADE LEGAL PROCEDURES WILL BE INITIATED AGAINST THE RENTEE THE RENTEE IS POSSIBLE FOR ALL
                    TRAFFIC VIOLATION AND/OR LES PLATES OR CIRCULATION DOCUMENTS.
                    AVIS LE LOCATAIRE SEXPOSE À DES POURSUITES JUDICIAIRES SI 24 HEURES APRÈS L'HEURE ET LA DATE
                    CONVENUES AU DEPART. LE VEHICULE NEST TOUJOURS PAS RETOURNE, ET CELA SANS QUE Alin Leading CAR
                    ETE INFORME DUNE PROLONGATION DE LOCATION ET AIT REÇU LA SOMME SUPPLÉMENTAIRE DUE</p>
            </div>
        </div>
    </div>
    </div>
    <script>
    document.getElementById('print-button').addEventListener('click', function() {
        var printContent = document.getElementById('print');
        var originalContents = document.body.innerHTML;
        var printContents = printContent.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>

</x-app>
