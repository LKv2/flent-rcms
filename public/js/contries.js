const countriesArray  = [
    "Afghan",
    "Albanais",
    "Algérien",
    "Andorran",
    "Angolais",
    "Antiguan ou Barbudan",
    "Argentin",
    "Arménien",
    "Australien",
    "Autrichien",
    "Azerbaïdjanais, Azéri",
    "Bahamien",
    "Bahreïn",
    "Bengali",
    "Barbadien",
    "Biélorusse",
    "Belge",
    "Belize",
    "Béninois, Béninois",
    "Bhoutanais",
    "Bolivien",
    "Bosnie-Herzégovine",
    "Motswana, Botswanan",
    "Brésilien",
    "Bruneian",
    "Bulgare",
    "Burkinabé",
    "Birman",
    "Burundi",
    "Cabo Verdean",
    "Cambodgien",
    "Camerounais",
    "Canadienne",
    "Afrique centrale",
    "Tchadien",
    "Chilien",
    "Chinois",
    "Colombien",
    "Comoran, Comorien",
    "Congolais",
    "Congolais",
    "Costaricain",
    "Ivoirien",
    "Croate",
    "Cubain",
    "Chypriote",
    "Tchèque",
    "Danois",
    "Djiboutien",
    "Dominicain",
    "Dominicain",
    "Timorais",
    "Équatorien",
    "Égyptien",
    "Salvadorien",
    "Équato-guinéenne, équato-guinéenne",
    "Érythrée",
    "Estonien",
    "Éthiopien",
    "Fidjien",
    "Finlandais",
    "Français",
    "Gabonais",
    "Gambien",
    "Géorgien",
    "Allemand",
    "Ghanéen",
    "Gibraltar",
    "Grec, Hellénique",
    "Grenadian",
    "Guatémaltèque",
    "Guinéenne",
    "Bissau-Guinéen",
    "Guyanais",
    "Haïtien",
    "Honduras",
    "Hongrois, Magyar",
    "Islandais",
    "Indien",
    "Indonesian",
    "Iranien, Persan",
    "Irakien",
    "Irlandais",
    "Israélien",
    "Italien",
    "Ivoirien",
    "Jamaïquain",
    "Japonais",
    "Jordanien",
    "Kazakhstani, Kazakh",
    "Kényen",
    "I-Kiribati",
    "Nord Coréen",
    "Corée du Sud",
    "Koweïtien",
    "Kirghizistan, Kirghize, Kirghiz, Kirghiz",
    "Lao, Laotien",
    "Letton, Letton",
    "Libanais",
    "Basotho",
    "Libérienne",
    "Libye",
    "Liechtenstein",
    "Lituanien",
    "Luxembourg, Luxembourgeois",
    "Macédonien",
    "Malgache",
    "Malawite",
    "Malaisie",
    "Maldives",
    "Malien, Malinais",
    "Maltais",
    "Marshall",
    "Martiniquais, Martinican",
    "Mauritanien",
    "Mauricien",
    "Mexicain",
    "Micronésiens",
    "Moldave",
    "Monégasque, Monacan",
    "Mongol",
    "Monténégrin",
    "Marocain",
    "Mozambique",
    "Namibie",
    "Nauruan",
    "Népalais, Népalais",
    "Néerlandais, Néerlandais",
    "Nouvelle-Zélande, Nouvelle-Zélande, Zelanian",
    "Nicaraguayen",
    "Nigerien",
    "Nigeria",
    "Marianan du Nord",
    "Norvégien",
    "Oman",
    "Pakistanais",
    "Palauan",
    "Palestinien",
    "Panaméen",
    "Papouasie-Nouvelle-Guinée, Papouasie",
    "Paraguayen",
    "Péruvien",
    "Philippin, Philippin",
    "Polonais",
    "Portugais",
    "Portoricain",
    "Qatari",
    "Roumain",
    "Russe",
    "Rwandais",
    "Kittitien ou Nevisien",
    "Saint Lucian",
    "Saint Vincentien, Vincentien",
    "Samoan",
    "Saint-Marin",
    "São Toméan",
    "Arabie Saoudite",
    "Sénégalais",
    "Serbe",
    "Seychellois",
    "Sierra Leone",
    "Singapour, Singapourien",
    "Slovaque",
    "Slovène, Slovène",
    "Îles Salomon",
    "Somali",
    "Sud Africain",
    "Soudan du Sud",
    "Espagnol",
    "Sri Lankais",
    "Soudanais",
    "Surinamais",
    "Swazi",
    "Suédois",
    "Suisse",
    "Syrien",
    "Tadjikistan",
    "Tanzanien",
    "Thai",
    "Timorais",
    "Togolais",
    "Tokélaouan",
    "Tongan",
    "Trinité-et-Tobago",
    "Tunisien",
    "Turc",
    "Turkmène",
    "Tuvaluan",
    "Ougandais",
    "Ukrainien",
    "Emirati, Emirian, Emiri",
    "UK, Britannique",
    "États-Unis, États-Unis, Américain",
    "Uruguayen",
    "Ouzbékistan, Ouzbek",
    "Vanuatu, Vanuatuan",
    "Vatican",
    "Vénézuélien",
    "Vietnamien",
    "Yéménite",
    "Zambien",
    "Zimbabwéen"
];
const inputElement = document.getElementById("nationalite");
const autocompleteList = document.getElementById("autocomplete-list");
inputElement.addEventListener("input", function () {
    const inputValue = this.value;
    autocompleteList.innerHTML = "";

    if (inputValue.length === 0) return;

    // Filter matching items
    const filteredItems = countriesArray.filter((item) =>
        item.toLowerCase().includes(inputValue.toLowerCase())
    );

    // Display matching items
    filteredItems.forEach((item) => {
        const listItem = document.createElement("div");
        listItem.className = "autocomplete-item";
        listItem.textContent = item;

        listItem.addEventListener("click", function () {
            inputElement.value = item;
            autocompleteList.innerHTML = "";
        });

        autocompleteList.appendChild(listItem);
    });
});

// Close the autocomplete list when clicking outside the input field
document.addEventListener("click", function (e) {
    if (e.target !== inputElement && e.target !== autocompleteList) {
        autocompleteList.innerHTML = "";
    }
});
const inputElement2 = document.getElementById("nationalite2");
const autocompleteList2 = document.getElementById("autocomplete-list2");
inputElement2.addEventListener("input", function () {
    const inputValue2 = this.value;
    autocompleteList2.innerHTML = "";

    if (inputValue2.length === 0) return;

    // Filter matching items
    const filteredItems = countriesArray.filter((item) =>
        item.toLowerCase().includes(inputValue2.toLowerCase())
    );

    // Display matching items
    filteredItems.forEach((item) => {
        const listItem = document.createElement("div");
        listItem.className = "autocomplete-item";
        listItem.textContent = item;

        listItem.addEventListener("click", function () {
            inputElement2.value = item;
            autocompleteList2.innerHTML = "";
        });

        autocompleteList2.appendChild(listItem);
    });
});

// Close the autocomplete list when clicking outside the input field
document.addEventListener("click", function (e) {
    if (e.target !== inputElement2 && e.target !== autocompleteList2) {
        autocompleteList2.innerHTML = "";
    }
});

// Event listener for input field
