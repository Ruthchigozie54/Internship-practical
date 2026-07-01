const map = document.getElementById("map")

const nigeriaStates = [
  {
    state: "Abia",
    capital: "Umuahia",
    governor: "Alex Otti",
    population: "3700000",
    mineralResources: ["Crude Oil", "Natural Gas", "Limestone", "Lead", "Zinc"]
  },
  {
    state: "Adamawa",
    capital: "Yola",
    governor: "Ahmadu Umaru Fintiri",
    population: "4900000",
    mineralResources: ["Gypsum", "Kaolin", "Bentonite", "Magnesite"]
  },
  {
    state: "Akwa Ibom",
    capital: "Uyo",
    governor: "Umo Eno",
    population: "5500000",
    mineralResources: ["Crude Oil", "Natural Gas", "Clay", "Salt"]
  },
  {
    state: "Anambra",
    capital: "Awka",
    governor: "Charles Soludo",
    population: "6000000",
    mineralResources: ["Natural Gas", "Clay", "Glass Sand", "Limestone"]
  },
  {
    state: "Bauchi",
    capital: "Bauchi",
    governor: "Bala Mohammed",
    population: "7000000",
    mineralResources: ["Tin", "Columbite", "Limestone", "Gypsum"]
  },
  {
    state: "Bayelsa",
    capital: "Yenagoa",
    governor: "Douye Diri",
    population: "2500000",
    mineralResources: ["Crude Oil", "Natural Gas", "Clay"]
  },
  {
    state: "Benue",
    capital: "Makurdi",
    governor: "Hyacinth Alia",
    population: "6000000",
    mineralResources: ["Limestone", "Barite", "Gypsum", "Coal"]
  },
  {
    state: "Borno",
    capital: "Maiduguri",
    governor: "Babagana Zulum",
    population: "7500000",
    mineralResources: ["Clay", "Limestone", "Kaolin"]
  },
  {
    state: "Cross River",
    capital: "Calabar",
    governor: "Bassey Otu",
    population: "4000000",
    mineralResources: ["Limestone", "Tin", "Marble", "Salt"]
  },
  {
    state: "Delta",
    capital: "Asaba",
    governor: "Sheriff Oborevwori",
    population: "5600000",
    mineralResources: ["Crude Oil", "Natural Gas", "Limestone", "Clay"]
  },
  {
    state: "Ebonyi",
    capital: "Abakaliki",
    governor: "Francis Nwifuru",
    population: "3000000",
    mineralResources: ["Lead", "Limestone", "Salt", "Zinc"]
  },
  {
    state: "Edo",
    capital: "Benin City",
    governor: "Monday Okpebholo",
    population: "5000000",
    mineralResources: ["Crude Oil", "Limestone", "Marble", "Clay"]
  },
  {
    state: "Ekiti",
    capital: "Ado Ekiti",
    governor: "Biodun Oyebanji",
    population: "3500000",
    mineralResources: ["Granite", "Clay", "Kaolin", "Feldspar"]
  },
  {
    state: "Enugu",
    capital: "Enugu",
    governor: "Peter Mbah",
    population: "4500000",
    mineralResources: ["Coal", "Limestone", "Iron Ore"]
  },
  {
    state: "Gombe",
    capital: "Gombe",
    governor: "Muhammadu Inuwa Yahaya",
    population: "3500000",
    mineralResources: ["Gypsum", "Limestone", "Coal"]
  },
  {
    state: "Imo",
    capital: "Owerri",
    governor: "Hope Uzodimma",
    population: "5400000",
    mineralResources: ["Crude Oil", "Natural Gas", "Lead", "Zinc"]
  },
  {
    state: "Jigawa",
    capital: "Dutse",
    governor: "Umar Namadi",
    population: "6000000",
    mineralResources: ["Granite", "Laterite", "Kaolin"]
  },
  {
    state: "Kaduna",
    capital: "Kaduna",
    governor: "Uba Sani",
    population: "9000000",
    mineralResources: ["Gold", "Tin", "Kaolin", "Marble"]
  },
  {
    state: "Kano",
    capital: "Kano",
    governor: "Abba Kabir Yusuf",
    population: "15000000",
    mineralResources: ["Cassiterite", "Granite", "Gypsum"]
  },
  {
    state: "Katsina",
    capital: "Katsina",
    governor: "Dikko Umar Radda",
    population: "8000000",
    mineralResources: ["Kaolin", "Asbestos", "Marble"]
  },
  {
    state: "Kebbi",
    capital: "Birnin Kebbi",
    governor: "Nasir Idris",
    population: "5000000",
    mineralResources: ["Gold", "Limestone", "Clay"]
  },
  {
    state: "Kogi",
    capital: "Lokoja",
    governor: "Usman Ododo",
    population: "5300000",
    mineralResources: ["Iron Ore", "Coal", "Limestone", "Gold"]
  },
  {
    state: "Kwara",
    capital: "Ilorin",
    governor: "AbdulRahman AbdulRazaq",
    population: "3600000",
    mineralResources: ["Gold", "Marble", "Granite"]
  },
  {
    state: "Lagos",
    capital: "Ikeja",
    governor: "Babajide Sanwo-Olu",
    population: "20000000",
    mineralResources: ["Bitumen", "Clay", "Glass Sand"]
  },
  {
    state: "Nasarawa",
    capital: "Lafia",
    governor: "Abdullahi Sule",
    population: "3000000",
    mineralResources: ["Tin", "Columbite", "Barite", "Gold"]
  },
  {
    state: "Niger",
    capital: "Minna",
    governor: "Mohammed Umar Bago",
    population: "6000000",
    mineralResources: ["Gold", "Talc", "Limestone", "Granite"]
  },
  {
    state: "Ogun",
    capital: "Abeokuta",
    governor: "Dapo Abiodun",
    population: "7000000",
    mineralResources: ["Limestone", "Granite", "Bitumen"]
  },
  {
    state: "Ondo",
    capital: "Akure",
    governor: "Lucky Aiyedatiwa",
    population: "5000000",
    mineralResources: ["Crude Oil", "Bitumen", "Limestone"]
  },
  {
    state: "Osun",
    capital: "Osogbo",
    governor: "Ademola Adeleke",
    population: "4700000",
    mineralResources: ["Gold", "Talc", "Granite"]
  },
  {
    state: "Oyo",
    capital: "Ibadan",
    governor: "Seyi Makinde",
    population: "8000000",
    mineralResources: ["Marble", "Clay", "Granite"]
  },
  {
    state: "Plateau",
    capital: "Jos",
    governor: "Caleb Mutfwang",
    population: "4500000",
    mineralResources: ["Tin", "Columbite", "Lead", "Zinc"]
  },
  {
    state: "Rivers",
    capital: "Port Harcourt",
    governor: "Siminalayi Fubara",
    population: "8000000",
    mineralResources: ["Crude Oil", "Natural Gas", "Silica Sand"]
  },
  {
    state: "Sokoto",
    capital: "Sokoto",
    governor: "Ahmad Aliyu",
    population: "6000000",
    mineralResources: ["Limestone", "Clay", "Gypsum"]
  },
  {
    state: "Taraba",
    capital: "Jalingo",
    governor: "Agbu Kefas",
    population: "4000000",
    mineralResources: ["Lead", "Zinc", "Barytes"]
  },
  {
    state: "Yobe",
    capital: "Damaturu",
    governor: "Mai Mala Buni",
    population: "4000000",
    mineralResources: ["Gypsum", "Kaolin", "Quartz"]
  },
  {
    state: "Zamfara",
    capital: "Gusau",
    governor: "Dauda Lawal",
    population: "5000000",
    mineralResources: ["Gold", "Granite", "Lead"]
  }
];

// consolel00000iaStates[0]s00000/ consolel00000iaStates[1].state);
// console.log(nigeriaStates[2].state);
// console.log(nigeriaStates[3].state);
// console.log(nigeriaStates[4].state);


for(let x = 0; x < nigeriaStates.length; x++) {

    let getState = nigeriaStates[x].state;

    let updatedCase = getState.toLowerCase().replaceAll(" ", "");

    map.innerHTML += `
    
    <div id="${updatedCase}">
        <a href="./36 states/${updatedCase}.html">
            ${nigeriaStates[x].state}
            <br>
            <span id="population${x}">0</span>
        </a>
    </div>
    
    `;

    let counter = 0;

    let counting = setInterval(() => {

        if(counter < nigeriaStates[x].population) {

            counter += 1000;

            document.getElementById(`population${x}`).innerText = counter;

        } else {

            clearInterval(counting);

        }

    }, 10);

}