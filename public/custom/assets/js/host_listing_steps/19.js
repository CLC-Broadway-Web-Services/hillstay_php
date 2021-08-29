const showCleaningFee = $('#showCleaningFee');
const cleaning_fee_input = $('#cleaning_fee_input');

// function cleaningFeeChange() {
//     console.log('cleaning fee event')
//     // if($(event.checked)) {
//     //     showCleaningFee.show();
//     // } else {
//     //     showCleaningFee.hide();
//     // }
// }

$("#cleaning_fee").change(function () {
    if (this.checked) {
        cleaning_fee_input.attr('required', 'required')
        showCleaningFee.show();
    } else {
        cleaning_fee_input.removeAttr('required')
        showCleaningFee.hide();
    }
});