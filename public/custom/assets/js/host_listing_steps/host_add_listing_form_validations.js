function validate() {
    console.log('form validating')
    switch (_step) {
        case 1:
            $("#_listingForm").validate();
            break;
        case 2:
            $("#_listingForm").validate();
            // code block
            break;
        case 3:
            $("#_listingForm").validate({
                rules: {
                    sleepbeds_x: {
                      required: true,
                      min: 1
                    }
                },
                messages: {
                    sleepbeds_x: {
                      required: "You have to add beds.",
                      min: "Please add atleast one bed before continue."
                    }
                }
            });
            // code block
            break;
        case 4:
            $("#_listingForm").validate();
            // code block
            break;
        case 5:
            $("#_listingForm").validate();
            // code block
            break;
        case 6:
            $("#_listingForm").validate();
            // code block
            break;
        case 7:
            $("#_listingForm").validate();
            // code block
            break;
        case 8:
            $("#_listingForm").validate();
            // code block
            break;
        case 9:
            $("#_listingForm").validate();
            // code block
            break;
        case 10:
            $("#_listingForm").validate();
            // code block
            break;
        case 11:
            $("#_listingForm").validate();
            // code block
            break;
        case 12:
            $("#_listingForm").validate();
            // code block
            break;
        case 13:
            $("#_listingForm").validate();
            // code block
            break;
        case 14:
            $("#_listingForm").validate();
            // code block
            break;
        case 15:
            $("#_listingForm").validate();
            // code block
            break;
        case 16:
            $("#_listingForm").validate();
            // code block
            break;
        case 17:
            $("#_listingForm").validate();
            // code block
            break;
        case 18:
            $("#_listingForm").validate();
            // code block
            break;
        case 19:
            $("#_listingForm").validate();
            // code block
            break;
        case 20:
            $("#_listingForm").validate();
            // code block
            break;
        case 21:
            $("#_listingForm").validate();
            // code block
            break;
        case 22:
            $("#_listingForm").validate();
            // code block
            break;
        case 23:
            $("#_listingForm").validate();
            // code block
            break;
    }
}
