<!-- Modal toggle -->
<button data-modal-target="AddCharge" data-modal-toggle="AddCharge"
    class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover-bg-green-700 focus:outline-none dark:focus-ring-green-800"
    type="button">
    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
    </svg>
    Ajouter Charge
</button>

<!-- Main modal -->
<div id="AddCharge" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ajouter Charge
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="AddCharge">
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
                <form action="{{ route('charges.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6 ">
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select name="type" id="type" onchange="updateContent()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Charge ...</option>
                            <option value="Reparation">Reparation</option>
                            <option value="Office">Office</option>
                            <option value="Lavage">Lavage</option>
                            <option value="Vidange">Vidange</option>
                            <option value="Autorisation Circulation">Autorisation Circulation</option>
                            <option value="Control Technique">Control Technique</option>
                            <option value="Carte Grise">Carte Grise</option>
                            <option value="Traite">Traite</option>
                            <option value="Fuel">Fuel</option>
                            <option value="Vignette Renewal">Vignette Renewae</option>
                            <option value="Insurance Renewal">Insurance Renewae</option>
                        </select>
                    </div>
                    <div id="contentContainer"></div>

                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="AddCharge" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ajouter</button>
                        <button data-modal-hide="AddCharge" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    // Function to update contentContainer based on the selected option
    function updateContent() {
        // Get the selected option value
        var selectedOption = document.getElementById('type').value;

        // Perform actions based on the selected option
        var content = '' + base;
        var base = `<div class="grid grid-cols-2 gap-4">
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
                </div>
        `;
        switch (selectedOption) {
            case 'Reparation':
            case 'Office':
                content = `
                <div class="mb-6">
                    <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Desription</label>
                    <textarea
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="description" required id="description" cols="30" rows="2">
                    </textarea>
                </div>
                ` + base;
                break;
            case 'Traite':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                            @if ($option->status === 'credit')
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}" data-traitemt="{{$option->traite()}}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>         
                    <div class="grid grid-cols-2 gap-4">
        <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                             for="cout">Price</label
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <input type="number" name="cout" id="traite"
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
                </div> 
                ` ;
                break;
            case 'Fuel':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>          
                ` + base;
                break;
            case 'Lavage':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>          
                ` + base;
                break;
            case 'Vidange':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-6 ">
                        <label for="kmval" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kilométrage
                            Vidange</label>

                        <input type="number" name="kmvidange" id="kmval" required
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                        
                    </div>            
                ` + base;
                break;

            case 'Autorisation Circulation':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
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
                ` + base;
                break;
            case 'Control Technique':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                ` + base;
                break;
            case 'Carte Grise':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">

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
                ` + base;
                break;
            case 'Vignette Renewal':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                    </div></div>
                ` + base;
                break;
            case 'Insurance Renewal':
                content = `
                    <div class="mb-6 ">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car</label>

                        <select  name="car" id="car" required onChange="selectcar()"
                            class="w-full text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white px-6 py-2">
                            <option value="">Select Car ...</option>
                            @foreach ($cars as $option)
                                <option value="{{ $option->id }}" data-km="{{ $option->km }}">{{ $option->immatriculation1 ? $option->immatriculation1 . '/' . $option->lettre . '/' . $option->immatriculation2 : $option->immatriculationWW }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                    </div></div>
                ` + base;
                break;

        }

        // Update the contentContainer with the generated content
        document.getElementById('contentContainer').innerHTML = content;
    }
</script>


<script>
    function selectcar() {
        var select2Element = document.getElementById('car');
        var kmvalInput = document.getElementById('kmval');
        var selectedOption = select2Element.options[select2Element.selectedIndex];
        var kmValue = selectedOption.getAttribute('data-km');
        var traite =document.getElementById('traite');
        var carTraite=selectedOption.getAttribute('data-traitemt');
        traite.value=carTraite;
        kmvalInput.value = kmValue;
        kmvalInput.max = kmValue;
    }
</script>
