const UPI_DIV = $('#UPI_DIV');
const BANK_DIV = $('#BANK_DIV');
const UPI_INPUT = $('#upi_number')
const BANK_INPUTS = $('#BANK_INPUTS')

function selectPaymentMethod(event) {
    var method = event.value;
    if (method == 'UPI') {
        required(UPI_INPUT);
        BANK_INPUTS.each(function () {
            notrequired($(this));
        })

        UPI_DIV.show();
        BANK_DIV.hide();
    } else {
        notrequired(UPI_INPUT);
        BANK_INPUTS.each(function () {
            required($(this));
        })

        UPI_DIV.hide();
        BANK_DIV.show();
    }
}

function required(input) {
    input.attr('required', 'required');
}
function notrequired(input) {
    input.removeAttr('required');
}
function set_default_method(method_id) {
    console.log(method_id)
    var formData = new FormData();
    formData.append('default_method', method_id);

    console.log(Array.from(formData));
    // var serializedForm = form.serialize();
    // console.log(serializedForm);
    // return;
    $.ajax({
        url: window.location.href,
        type: "post",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            // console.log(JSON.parse(data));
            location.reload();
        },
        error: function (textStatus, errorThrown) {
            loader.attr('hidden', 'hidden');
            alert('There has been some error, please try again later.');
            // location.reload();
        }
    });
}
function set_default_contact(contact_id) {
    console.log(contact_id)
    var formData = new FormData();
    formData.append('default_contact_info', contact_id);

    console.log(Array.from(formData));
    // var serializedForm = form.serialize();
    // console.log(serializedForm);
    // return;
    $.ajax({
        url: window.location.href,
        type: "post",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            // console.log(JSON.parse(data));
            location.reload();
        },
        error: function (textStatus, errorThrown) {
            loader.attr('hidden', 'hidden');
            alert('There has been some error, please try again later.');
            // location.reload();
        }
    });
}