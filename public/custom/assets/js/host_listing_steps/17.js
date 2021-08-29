const defaultUnavailableDesc = $('#defaultUnavailableDesc');


function advanceBookingChange(event) {
    console.log(event.value)
    var days = event.value;
    if (days == 0) {
        defaultUnavailableDesc.show();
    } else {
        defaultUnavailableDesc.hide();
    }
}