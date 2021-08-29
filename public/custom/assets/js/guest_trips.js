function showReservationDetails(bookId) {
    const bookingData = $('#booking_data_' + bookId).html();
    console.log(JSON.parse(bookingData));
    parseBookingDataAndShowModal(JSON.parse(bookingData));
}

function closeReservationModal() {
    $('#reservationDetailsModal').modal('toggle');
}

const bookingTableHtml = `<tbody>
    <tr>
        <td>Status</td>
        <td class="text-capitalize">listing-status_name</td>
    </tr>
    <tr>
        <td>Nights</td>
        <td>listing-total_nights</td>
    </tr>
    <tr>
        <td>Price <small>Per night</small></td>
        <td>listing-price_per_night</td>
    </tr>
    <tr>
        <td>Total Amount</td>
        <td>listing-price_total</td>
    </tr>
    <tr>
        <td>Service Charges</td>
        <td>listing-servicePrices</td>
    </tr>
    <tr>
        <td>Guests</td>
        <td>listing-guest_adults, listing-guest_chldren, listing-guest_infants</td>
    </tr>
    <tr>
        <td>Discount</td>
        <td>listing-discount_amount</td>
    </tr>
    <tr>
        <td>Discount Type</td>
        <td class="text-capitalize">listing-discount_type</td>
    </tr>
    </tbody>`;

const guestsToggleHtml = ` <div class="toggle-wrap">
    <span class="trigger "><a href="#">listing-guest_name<i class="sl sl-icon-plus"></i></a></span>
        <div class="toggle-container">
            <table class="table table-success table-striped table-hover">
                <tbody>
                    <tr>
                        <td>Age</td>
                        <td>listing-guest_age</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>listing-guest_gender</td>
                    </tr>
                    <tr>
                        <td>Any Flu Symptomns</td>
                        <td>listing-flu_symptoms</td>
                    </tr>
                    <tr>
                        <td>Any Chronic Medical Condition</td>
                        <td>listing-chronic_medical_condition</td>
                    </tr>
                    <tr>
                        <td>On Medication</td>
                        <td>listing-on_medication</td>
                    </tr>
                    <tr>
                        <td>Health Insurance</td>
                        <td>listing-health_insurance</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>`;

const modalChat = `<button type="button" class="btn btn-warning btn-sm" onclick="chatGuest(listing_chat_id)">Chat Guest</button>`;
const modalApprove = `<button type="button" class="btn btn-success btn-sm" onclick="approveRequest(listing_id)">Approve</button>`;
const modalReject = `<button type="button" class="btn btn-danger btn-sm"onclick="rejectRequest(listing_id)">Reject</button>`;

function parseBookingDataAndShowModal(data) {
    let bookingTable = bookingTableHtml;
    // let bookingTable = document.getElementById('bookingDetailsTable').innerHTML;
    bookingTable = bookingTable.replace("listing-status_name", data.status_name);
    bookingTable = bookingTable.replace("listing-total_nights", data.total_nights + ' nights');
    bookingTable = bookingTable.replace("listing-price_per_night", '₹ ' + data.price_per_night + '.00');
    bookingTable = bookingTable.replace("listing-price_total", '₹ ' + data.price_total + '.00');
    if (data.servicePrices) {
        bookingTable = bookingTable.replace("listing-servicePrices", '₹ ' + data.servicePrices + '.00');
    } else {
        bookingTable = bookingTable.replace("listing-servicePrices", 0);
    }
    bookingTable = bookingTable.replace("listing-guest_adults", 'Adults ' + data.guest_adults);
    if (data.guest_chldren) {
        bookingTable = bookingTable.replace("listing-guest_chldren", 'Children ' + data.guest_chldren);
    } else {
        bookingTable = bookingTable.replace("listing-guest_chldren", 'Children ' + 0);
    }
    if (data.guest_infants) {
        bookingTable = bookingTable.replace("listing-guest_infants", 'Infants ' + data.guest_infants);
    } else {
        bookingTable = bookingTable.replace("listing-guest_infants", 'Infants ' + 0);
    }
    if (data.discount_amount) {
        bookingTable = bookingTable.replace("listing-discount_amount", '₹ ' + data.discount_amount + '.00');
    } else {
        bookingTable = bookingTable.replace("listing-discount_amount", 0);
    }
    if (data.discount_type) {
        bookingTable = bookingTable.replace("listing-discount_type", data.discount_type);
    } else {
        bookingTable = bookingTable.replace("listing-discount_type", 'N/A');
    }

    document.getElementById('bookingDetailsTable').innerHTML = bookingTable;

    let guestsDataToPush = '';

    data.guest_details.forEach(guestData => {
        let guestDetails = guestsToggleHtml;
        // let guestDetails = document.getElementById('reservationGuestsAccordian').innerHTML;
        guestDetails = guestDetails.replace("listing-guest_name", guestData.name);
        guestDetails = guestDetails.replace("listing-guest_age", guestData.age + ' Years');
        guestDetails = guestDetails.replace("listing-guest_gender", guestData.gender);

        if (guestData.flu_symptoms) {
            guestDetails = guestDetails.replace("listing-flu_symptoms", guestData.flu_symptoms);
        } else {
            guestDetails = guestDetails.replace("listing-flu_symptoms", 'No');
        }
        if (guestData.chronic_medical_condition) {
            guestDetails = guestDetails.replace("listing-chronic_medical_condition", guestData.chronic_medical_condition);
        } else {
            guestDetails = guestDetails.replace("listing-chronic_medical_condition", 'No');
        }
        if (guestData.on_medication) {
            guestDetails = guestDetails.replace("listing-on_medication", guestData.on_medication);
        } else {
            guestDetails = guestDetails.replace("listing-on_medication", 'No');
        }
        if (guestData.health_insurance) {
            guestDetails = guestDetails.replace("listing-health_insurance", guestData.health_insurance);
        } else {
            guestDetails = guestDetails.replace("listing-health_insurance", 'No');
        }
        guestsDataToPush += guestDetails;
    });

    document.getElementById('reservationGuestsAccordian').innerHTML = guestsDataToPush;

    var base64UserId = "'" + data.user_id_64 + "'";
    let reservationFooter;
    if (data.completed === "1") {
        console.log('data.completed')
        console.log(data.completed)
        // only chat button
        reservationFooter = modalChat.replace("listing_chat_id", base64UserId);
    } else if (data.cancelled === "1" && data.requested === "1") {
        console.log('data.cancelled')
        console.log(data.cancelled)
        // chat / approve button
        reservationFooter = modalChat.replace("listing_chat_id", base64UserId) + modalApprove.replace("listing_id", data.id);
    } else if (data.approved === "1" && data.requested === "1") {
        console.log('data.approved')
        console.log(data.approved)
        // chat / reject button
        reservationFooter = modalChat.replace("listing_chat_id", base64UserId) + modalReject.replace("listing_id", data.id);
    } else if (data.requested === "1") {
        console.log('data.requested')
        console.log(data.requested)
        // all buttons
        reservationFooter = modalChat.replace("listing_chat_id", base64UserId) + modalReject.replace("listing_id", data.id) + modalApprove.replace("listing_id", data.id);
    }

    // let reservationFooter = reservationDetailsFooter;
    // reservationFooter = reservationFooter.replace("listing_chat_id", base64UserId);
    // reservationFooter = reservationFooter.replace("listing_id", data.id);
    // reservationFooter = reservationFooter.replace("listing_id", data.id);
    document.getElementById('reservationDetailsFooter').innerHTML = reservationFooter;
    reInit();
    // setTimeout(() => {
    $('#reservationDetailsModal').modal('toggle');
    // }, 3000);
}

function reInit() {
    $(".toggle-container").hide();

    $(".trigger, .trigger.opened").on("click", function (a) {
        $(this).toggleClass("active");
        a.preventDefault();
    });
    $(".trigger").on("click", function () {
        $(this).next(".toggle-container").slideToggle(300);
    });
    $(".trigger.opened").addClass("active").next(".toggle-container").show();
    $("#toggle-container0").show();
}

var myModalEl = document.getElementById('reservationDetailsModal');

myModalEl.addEventListener('hidden.bs.modal', function (event) {
    //   console.log('modal closed')
    document.getElementById('bookingDetailsTable').innerHTML = ''
    document.getElementById('reservationGuestsAccordian').innerHTML = '';
})

function chatGuest(id) {
    console.log(id)
    window.location.href = '/hosting/inbox/' + id;
}

function approveRequest(id) {
    console.log(id)
    $.ajax({
        method: "POST",
        url: "/hosting/reservations/approve",
        data: { id: id }
    }).done(function (msg) {
        const response = JSON.parse(msg);
        if (response.success) {
            alert('Successfully approved the request')
            location.reload();
        } else {
            alert('There has been some error approving the request')
        }
    });
}

function rejectRequest(id) {
    console.log(id)
    $.ajax({
        method: "POST",
        url: "/hosting/reservations/approve",
        data: { id: id }
    }).done(function (msg) {
        const response = JSON.parse(msg);
        if (response.success) {
            alert('Successfully reject the request')
            location.reload();
        } else {
            alert('There has been some error rejecting the request')
        }
    });
}

$('#resevationSelectionDropdown').on('change', function () {
    console.log($(this).val())
    if ($(this).val() == 'all') {
        window.location.href = '/hosting/reservations'
    } else {
        window.location.href = '/hosting/reservations?type=' + $(this).val()
    }
})


// payment fucntions
const current_user = JSON.parse($('#current_user').html());
function makeReservationPayment(element, booking) {
    console.log(element);
    const bookingData = JSON.parse($('#' + booking).html());
    // console.log(current_user);
    // return;

    const notes = {
        listing_id: bookingData.listing_id,
        price_per_night: bookingData.price_per_night,
        price_total: bookingData.price_total,
        servicePrices: bookingData.price_breakdown.servicePrices,
        lodgingPrices: bookingData.price_breakdown.lodgingPrices,
        total_guests: bookingData.guests,
        discount_amount: bookingData.discount_amount,
        discount_type: bookingData.discount_type,
        user_address: current_user.addressLine1
    }

    // create order first
    const formData = new FormData();
    formData.append('create_order', true);
    formData.append('amount', bookingData.price_total);
    formData.append('user_name', current_user.firstName + ' ' + current_user.lastname);
    formData.append('user_email', current_user.email);
    formData.append('user_contact', current_user.phone);
    formData.append('notes', JSON.stringify(notes));

    console.log(Array.from(formData));
    // const formData = {}
    // return;

    $.ajax({
        method: "POST",
        url: "./account/makepayment",
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (msg) {
        // console.log(msg);
        const response = JSON.parse(msg);
        console.log(response);
        // return;
        if (response.success) {
            const data = response.data;
            const razorKey = $('#razorKey').html();
            var options = {
                key: razorKey,
                amount: data.amount * 100,
                name: "Hillstay.in",
                image: "/public/assets/images/hillstay_icon.png",
                description: "Order # " + data.order_id,
                currency: "INR",
                prefill: {
                    name: current_user.firstName + ' ' + current_user.lastname,
                    email: current_user.email,
                    contact: current_user.phone
                },
                theme: {
                    color: '#123815'
                },
                order_id: data.order_id,
                notes: notes,
                handler: function (transaction) {
                    console.log(transaction);
                    // return;
                    const formData2 = new FormData();
                    if (transaction && transaction.razorpay_order_id && transaction.razorpay_payment_id) {
                        formData2.append('payment_done', true);
                        formData2.append('status', 'success');
                        formData2.append('amount_paid', data.amount);
                        formData2.append('payment_id', transaction.razorpay_payment_id);
                        formData2.append('order_id', transaction.razorpay_order_id);
                    } else {
                        formData2.append('payment_done', false);
                        formData2.append('status', 'failed');
                        alert('There has been some error making payment.')
                    }
                    $.ajax({
                        method: "POST",
                        url: "./account/makepayment",
                        data: formData2,
                        processData: false,
                        contentType: false,
                    }).done(function (msg) {
                        const response = JSON.parse(msg);
                        console.log(response);
                        if(response.success) {
                            alert('Payment is succesfull');
                        } else {
                            alert('Payment failed.');
                        }
                        location.reload();
                    });
                },
                "modal": {
                    // "ondismiss": function () {
                    //     location.reload()
                    // },
                    backdropclose: false
                }
            };
            instance = new Razorpay(options);
            instance.open();
        } else {
            alert('There has been some error creating your order.')
        }
    });


    return;
    var options = {
        key: "<?php echo $key_id; ?>",
        amount: "<?php echo $total; ?>",
        name: "<?php echo $name; ?>",
        description: "Order # <?php echo $merchant_order_id; ?>",
        netbanking: true,
        currency: "<?php echo $currency_code; ?>", // INR
        prefill: {
            name: "<?php echo $card_holder_name; ?>",
            email: "<?php echo $email; ?>",
            contact: "<?php echo $phone; ?>"
        },
        notes: {
            soolegal_order_id: "<?php echo $merchant_order_id; ?>",
        },
        handler: function (transaction) {
            document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
            document.getElementById('razorpay-form').submit();
        },
        "modal": {
            "ondismiss": function () {
                location.reload()
            }
        }
    };
    var razorpay_pay_btn, instance;
    console.log(el, id)
    // return;
    if (typeof Razorpay == 'undefined') {
        setTimeout(razorpaySubmit, 200);
        if (!razorpay_pay_btn && el) {
            razorpay_pay_btn = el;
            el.disabled = true;
            el.html = 'Please wait...';
        }
    } else {
        if (!instance) {
            instance = new Razorpay(options);
            if (razorpay_pay_btn) {
                razorpay_pay_btn.disabled = false;
                razorpay_pay_btn.value = "Pay Now";
            }
        }
        instance.open();
    }
}
function razorpaySubmit(el, id) {
    console.log(el, id)
    // return;
    if (typeof Razorpay == 'undefined') {
        setTimeout(razorpaySubmit, 200);
        if (!razorpay_pay_btn && el) {
            razorpay_pay_btn = el;
            el.disabled = true;
            el.html = 'Please wait...';
        }
    } else {
        if (!instance) {
            instance = new Razorpay(options);
            if (razorpay_pay_btn) {
                razorpay_pay_btn.disabled = false;
                razorpay_pay_btn.value = "Pay Now";
            }
        }
        instance.open();
    }
}