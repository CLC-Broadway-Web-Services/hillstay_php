// var _listingForm = $('#_listingForm');
// var formNextButton = $('#formNextButton');
// console.log(_step);
var href = new URL(window.location.href);
console.log(_mode);
if (_mode == 'edit') {
    editNavigationBlock();
}

var loader = $('#listing_form_loader');

// PREVIOUS BUTTON
function _previousStep() {

}
// NEXT BUTTON
_listingForm.submit(function (event) {
    event.preventDefault();
    // return;
    var formData = new FormData(_listingForm[0]);

    formData.append('request_type', 'ajax');

    if (_step == 9) {
        formData.delete('gallery_files');
        for (i = 0; i < galleryImagesToChoose.length; i++) {
            formData.append('galleryImages[]', galleryImagesToChoose[i]);
        }
        if (galleryImagesToDelete.length > 0) {
            formData.append('galleryImagestoDelete', galleryImagesToDelete.join());
        }

        // console.log(formData.get('cover'));
        if(!formData.get('cover')) {
            loader.attr('hidden');
            alert("Please make an image as cover first");
            return;
        }


    }
    if (_step == 10) {
        console.log(tinymceValidation());
        if (tinymceValidation() == false) {
            window.location.href += '#';
            return;
        }
    }
    if (_step == 22) {
        href.searchParams.set("step", (_step + 1));
        window.location.href = href.toString();
        return;
    }
    if (_step == 23) {
        window.location.href = '/hosting/listings';
        return;
    }

    console.log(Array.from(formData));
    // var serializedForm = form.serialize();
    // console.log(serializedForm);
    // return;
    if (_listingForm.valid()) {

        loader.removeAttr('hidden');
        $.ajax({
            url: window.location.href,
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                console.log(JSON.parse(data));
                // return;
                var lastid = parseInt(data);
                console.log(lastid)
                if (lastid > 0) {
                    href.searchParams.set("step", (_step + 1));
                    href.searchParams.set("id", (lastid));
                    console.log(href.toString());
                    window.location.href = href.toString();
                }
            },
            error: function (textStatus, errorThrown) {
                loader.attr('hidden', 'hidden');
                alert('There has been some error, please try again later.');
                // location.reload();
            }
        });

    }
});


function editNavigationBlock() {
    $('#add-listing-headline').append(
        $(document.createElement('select')).prop({
            id: 'selectEditLocation',
        })
    )
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: '',
        text: 'Select Step',
        disabled: true,
        selected: Boolean(_step < 2),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 2,
        text: 'What kind of hillstay are you listing?',
        selected: Boolean(_step == 2),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 3,
        text: 'Sleeping Arrangements?',
        selected: Boolean(_step == 3),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 4,
        text: 'How many bathrooms?',
        selected: Boolean(_step == 4),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 5,
        text: 'Address',
        selected: Boolean(_step == 5),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 6,
        text: 'Amenities',
        selected: Boolean(_step == 6),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 7,
        text: 'Safety Amenities',
        selected: Boolean(_step == 7),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 8,
        text: 'Guest/shared Space',
        selected: Boolean(_step == 8),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 9,
        text: 'Cover and Gallery',
        selected: Boolean(_step == 9),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 10,
        text: 'Description',
        selected: Boolean(_step == 10),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 11,
        text: 'Title',
        selected: Boolean(_step == 11),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 12,
        text: 'Review Requirements',
        selected: Boolean(_step == 12),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 13,
        text: 'House Rules',
        selected: Boolean(_step == 13),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 14,
        text: 'Instant & Reviewd Booking',
        selected: Boolean(_step == 14),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 15,
        text: 'Host details',
        selected: Boolean(_step == 15),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 16,
        text: 'Arrival Notice',
        selected: Boolean(_step == 16),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 17,
        text: 'Advance Booking',
        selected: Boolean(_step == 17),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 18,
        text: 'Nights',
        selected: Boolean(_step == 18),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 19,
        text: 'Price',
        selected: Boolean(_step == 19),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 20,
        text: 'Welcome Offer',
        selected: Boolean(_step == 20),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 21,
        text: 'Long Discounts',
        selected: Boolean(_step == 21),
    }))
    $('#selectEditLocation').append($(document.createElement('option')).prop({
        value: 22,
        text: 'Payment Mode',
        selected: Boolean(_step == 22),
    }))
    $('#selectEditLocation').change(function () {
        const stepToGo = this.value;
        window.location.href = window.location.origin + window.location.pathname + '?step=' + stepToGo;
    });
}
