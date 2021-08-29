const bathrooms = $('#total_bathrooms');

function increaseBaths() {
    var value = parseInt(parseInt(bathrooms.val()) + 1)
    bathrooms.val(value);
}
function decreaseBaths() {
    if (bathrooms.val() > 1) {
        var value = parseInt(parseInt(bathrooms.val()) - 1)
        bathrooms.val(value);
    }
}