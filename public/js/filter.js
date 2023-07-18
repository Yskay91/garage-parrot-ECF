var filterForm = document.getElementById('filter-form');

filterForm.addEventListener('submit', function (event) {
    event.preventDefault(); //empêche le rechargement de la page

    var priceMin = parseInt(document.getElementById('price-min').value);
    var priceMax = parseInt(document.getElementById('price-max').value);
    var kilometreMin = parseInt(document.getElementById('kilometre-min').value);
    var kilometreMax = parseInt(document.getElementById('kilometre-max').value);

    var usedCars = document.getElementsByClassName('cars-filter');

    for (let i = 0; i < usedCars.length; i++) {
        let usedCar = usedCars[i];
        let price = parseInt(usedCar.getAttribute('data-price'));
        let kilometre = parseInt(usedCar.getAttribute('data-kilometre'));

        if (price < priceMin || price > priceMax || kilometre < kilometreMin || kilometre > kilometreMax) {
            usedCar.style.display = 'none'; //Masque les véhicules qui ne correspondent pas aux critères
        } else {
            usedCar.style.display = 'block'; //Affiche les véhicules qui correspondent aux critères
        }
    }
});
