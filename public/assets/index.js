//Selectores
const selectOrigin = document.getElementById('origins');
const selectDestinations = document.getElementById('destinations');
const selectSeat = document.getElementById('seat');
const datePicker = document.getElementById('date');
const baseRate = document.getElementById('base-rate');

const addSeatingsToSelect = (seats, travel) => {
    //Se eliminan todos los destinos
    clearSelectSeat();
    for (let index = 1; index <= seats; index++){
        const option = document.createElement('option');
        option.value = index;
        option.text = index;
        selectSeat.appendChild(option);
    }
    baseRate.value = travel.base_rate;
}

const verifySeating = () => {
    const origin = selectOrigin.value;
    const destination = selectDestinations.value;
    const date = datePicker.value;

    if(origin && destination && date){
        fetch(`/seating/${origin}/${destination}/${date}`)
            .then(response => response.json())
            .then(data => {
                //Manipula los datos recibidos aqui
                addSeatingsToSelect(data.seats, data.travel)
            })
            .catch(error =>{
                console.error('Hubo un error:', error);
            });
    }
}

const clearSelectSeat = () => {
    while (selectSeat.firstChild) {
        selectSeat.removeChild(selectSeat.firstChild);
    }
}

const clearSelect = () =>{
    while (selectDestinations.firstChild){
        selectDestinations.removeChild(selectDestinations.firstChild);
    }
}

const addDestinationsToSelect = (destinations) => {
    //Se eliminan todos los destinos
    clearSelect();
    //Se crea la opcion por defecto (Selectione un destino)
    const option = document.createElement('option');
    option.value = "";
    option.text = "Seleccione un destino";
    option.selected = true;
    selectDestinations.appendChild(option);
    //Se empiezan a agregar los nuevos destinos
    destinations.forEach(destination => {
        const option = document.createElement('option');
        option.value = destination;
        option.text = destination;
        selectDestinations.appendChild(option);
    })
}

const addOriginsToSelect = (origins) => {
    origins.forEach(origin => {
        const option = document.createElement('option');
        option.value = origin;
        option.text = origin;
        selectOrigin.appendChild(option);
    });
}

const loadedOrigins = () => {
    fetch('/get/origins')
        .then(response => response.json())
        .then(data => {
            //manipular los datos obtenidos
            const origins = data.origins;
            //console.log(origins)
            addOriginsToSelect(origins);
        })
        .catch(error => {
            //manejo de errores
            console.error('Hubo un error:', error);
        })
}

const loadedDestinations = () => {
    const currentValue = selectOrigin.value;
    if(currentValue){
        fetch(`/get/destinations/${currentValue}`)
            .then(response => response.json())
            .then(data => {
                //manipular los datos obtenidos
                const destinations = data.destination;
                addDestinationsToSelect(destinations);
            })
            .catch(error => {
                console.error('Hubo un error:', error);
            })
        }
}

document.addEventListener('DOMContentLoaded', loadedOrigins);
selectOrigin.addEventListener('change', loadedDestinations);
selectDestinations.addEventListener('change', verifySeating);
datePicker.addEventListener('change',verifySeating);
