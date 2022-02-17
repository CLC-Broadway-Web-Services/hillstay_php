var reviewedbookingoptions = $('#reviewedbookingoptions');
var reviewedbooking_onedayresponse = $('#reviewedbooking_onedayresponse');
var reviewedbooking_ranklower = $('#reviewedbooking_ranklower');
var reviewedbooking_nohostprotection = $('#reviewedbooking_nohostprotection');
var reviewedCheckboxes = $('.reviewedCheckboxes');

var instantBookingDivs = $('.instantBooking');

var instantBookingSubmit = $('#instantBookingSubmit');

instantReview(instantBookingSubmit.val())

function instantReview(event) {
    console.log(event)
    if (event == 0) {
        instantBookingDivs.each(function () {
            $(this).hide();
        })
        reviewedbookingoptions.show();
        reviewedbooking_onedayresponse.attr('required', 'required')
        reviewedbooking_ranklower.attr('required', 'required')
        reviewedbooking_nohostprotection.attr('required', 'required')
    } else {
        instantBookingDivs.each(function () {
            $(this).show();
        })
        reviewedbookingoptions.hide();
        reviewedbooking_onedayresponse.removeAttr('required')
        reviewedbooking_ranklower.removeAttr('required')
        reviewedbooking_nohostprotection.removeAttr('required')
    }
}


formNextButton.click(function () {
    if (instantBookingSubmit.val() == 0) {
        let notChecked = 0;
        reviewedCheckboxes.each(function () {
            if (!this.checked) {
                // alert('Please agree all below terms before continue');
                notChecked += 1;
            }
        })
        if (notChecked > 0) {
            alert('Please agree all below terms before continue');
            // notChecked += 1;
        }
    }
});