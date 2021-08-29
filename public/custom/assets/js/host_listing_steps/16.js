const guestsCheckoutTime = $('.guestsCheckoutTime');

function selectFrom(event) {
    var fromTime = event.target.value;
    console.log(fromTime)
    guestsCheckoutTime.each(function (index) {
        if ((fromTime + 1) > $(this).val()) {
            $(this).attr('disabled', 'disabled');
        } else {
            $(this).removeAttr('disabled');
        }
        // if ($(this).val() >= (fromTime+1)) {
        //     $(this).removeAttr('disabled');
        // }
    });
    $('#guestsCheckoutTimeSelect').removeAttr('disabled');
}