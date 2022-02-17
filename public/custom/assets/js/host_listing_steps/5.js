const all_cities = JSON.parse($('#all_cities').val());
var district_cities = $('#district_cities');
var address_town = $('#address_town');

function onStateSelect(state_id) {
    console.log(state_id)
    var selectedCities = all_cities.filter(cities => cities.state_id == state_id)
    console.log(selectedCities);

    var options = '<option disabled selected value="">Select District</option>';

    if (selectedCities.length > 0) {
        selectedCities.forEach(city => {
            options += '<option value="' + city.id + '">' + city.name + '</option>';
        });

        district_cities.html(options);
        district_cities.removeAttr('disabled');
    } else {
        district_cities.attr('disabled', 'disabled');
        district_cities.removeAttr('required');
        address_town.removeAttr('disabled');
    }
}

function onDistrictSelect() {
    address_town.removeAttr('disabled');
}