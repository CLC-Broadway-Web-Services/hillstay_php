// first get universal leader here
let totalBookingsDone = 0;
let totalDaysSelected = 0;
var calculatePriceButton = $('#calculatePriceButton');
var openGuestFormButton = $('#openGuestFormButton');
var resetCalculatebutton = $('#resetCalculatebutton');
const serviceFee = 5;
const lodgingTax = 0;
const _bookingForm = $('#_bookingForm');

var dataForForm = '';

// breakdown modal
// breakdown modal

function openBreakDown(modalName) {
    $('#pricingBreakdownModal').addClass('show');
}
// if not suitable for children -> children guests buttons disabled
// if not suitable for infant -> infant guests buttons disabled

const totalPriceHtml = $('#totalPriceHtml')
const showPriceBreakdownPanel = $('#showPriceBreakdownPanel');
// Discount panels
const discount_weekly_panel = $('#discount_weekly_panel');
const discount_monthly_panel = $('#discount_monthly_panel');
const discount_welcome_panel = $('#discount_welcome_panel');
// Discount prices
const weeklyPrice = $('#weeklyPrice');
const monthlyPrice = $('#monthlyPrice');
const welcomePrice = $('#welcomePrice');
// universal variables
var current_listing_id = $('#current_listing_id').val();

// send message to host
var contactHostForm = $('#contactHostForm');

contactHostForm.submit(function (event) {
    event.preventDefault();
    // start loader

    var messageToHost = $('#messageToHost').val();

    var formData = new FormData(contactHostForm[0]);

    console.log(Array.from(formData));

    // check form validation

    if (messageToHost !== '') {

        // submit data
        // submit form, get return response
        $.ajax("/place", {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (response) {
            // if get error show error and stop loader.

            // else show success message and stop loader
            console.log(response);
            console.log(JSON.parse(response));
        });
    } else {
        console.log('message is null');
        // if no message found send back error and stop loader
    }


})

console.log($('#listing_advancebooking').val())

// BOOKING PART
// if dates unavailable, user have to message host for dates availablity so they can provide custom dates for booking --> DONE
// How far in advance can guest book -> when click on first date check if we need to disable the calender dates --> DONE around 1.5 hours
let calendarStatus = true;

console.log(calendarOptions)
function checkAdvanceBooking() {
    dataForForm = '';
    const advanceBookingValue = parseInt($('#listing_advancebooking').val());
    if (advanceBookingValue == '0') {
        console.log('apply zero')
        // mark full calender disabled
        calendarOptions.disable = [
            function (date) {
                return true;
            }
        ]
        calendarStatus = false;
    }
    if (advanceBookingValue > '1' && advanceBookingValue <= '365') {
        console.log('apply days')
        // enable only days from today
        const days = parseInt(advanceBookingValue);
        var end_date = new Date();
        console.log(end_date)
        end_date.setDate(new Date().getDate() + days);
        calendarOptions.maxDate = end_date
    }
    if (calendarStatus == true) {
        minMaxNightsAndBookingsCheck();
    }
    // disable calculate button
    // calculatePriceButton.prop('disabled', true);
    calculatePriceButton.show();
    openGuestFormButton.hide();
    resetCalculatebutton.hide();
    showPriceBreakdownPanel.hide();

    $('.datepicker2').val('');
}
checkAdvanceBooking();

// when user click on first date check if there is min-max nights for disabling dates - onInialization -- DONE needed to create function for minimum nights because not availablity on calendar, -- taken around2.5 hours
function minMaxNightsAndBookingsCheck() {
    var minNights = parseInt($('#listing_nightsmin').val())
    var maxNights = parseInt($('#listing_nightsmax').val())
    calendarOptions.onChange = function (selectedDates, dateStr, instance) {
        showPriceBreakdownPanel.hide();
        discount_weekly_panel.hide()
        discount_monthly_panel.hide()
        discount_welcome_panel.hide()
        weeklyPrice.html('')
        monthlyPrice.html('')
        welcomePrice.html('')
        totalPriceHtml.html('')
        if (selectedDates.length == 2) {
            const startDate = moment(selectedDates[0])
            const endDate = moment(selectedDates[1])
            const daysDiff = endDate.diff(startDate, 'days');
            totalDaysSelected = daysDiff;
            console.log(daysDiff);
            if (minNights != 0 && minNights > daysDiff) {
                alert('You need to select minimum ' + minNights + ' nights.')
                instance.clear()
                return;
            }
            if (maxNights != 0 && maxNights < daysDiff) {
                alert('You could only select maximum ' + maxNights + ' nights.')
                instance.clear()
                return;
            }
            // calculatePriceButton.prop('disabled', false);

            $('.datepicker2').removeClass('is-invalid')
        }
    }
    totalBookingsDone = parseInt($('#listing_bookings_count').val())
    var listing_bookings_data = JSON.parse($('#listing_bookings_data').val())
    // disable dates by disabled and current bookings
    if (listing_bookings_data.length > 0) {
        var disablingDates = [];
        listing_bookings_data.forEach(booking => {
            // needs to add flat pickr instead of datepicker
            const dates = {
                from: booking.check_in,
                to: booking.check_out
            }
            disablingDates.push(dates);
        });
        calendarOptions.disable = disablingDates;
    }
}

// then after selecting dates -> get base price & cleaning fee --> only if ##calendarStatus if not false
// starting on calculate clicking function
function calculate() {
    console.log($('#bookingdate').val())
    if ($('#bookingdate').val()) {
        gettingSettingPrices();
        // console.log('calendar value is available')
    } else {
        $('.datepicker2').addClass('is-invalid')
    }
    // console.log('calculate pressed')
    // gettingSettingPrices();
}
function gettingSettingPrices() {
    const basePrice = $('#listing_price').val();
    // cleaning fee 1/0
    const listing_cleaning_fee = parseInt($('#listing_cleaning_fee').val());
    // doscounts - in percents %
    const listing_welcomeoffer = parseInt($('#listing_welcomeoffer').val());
    const listing_weeklydiscount = parseInt($('#listing_weeklydiscount').val());
    const listing_monthlydiscount = parseInt($('#listing_monthlydiscount').val());

    const listing_bookings_count = parseInt($('#listing_bookings_count').val());
    // Main panel
    // showPriceBreakdownPanel

    // (discountedPriceNight*totalNights)+cleaingFee+
    // service fee calculate here
    // ((((discountedPriceNight*totalNights)+cleaingFee)/100)*serviceFee)+
    // lodging tax calculate here
    // ((((discountedPriceNight*totalNights)+cleaingFee)/100)*lodgingTax)

    const totalNights = parseInt(totalDaysSelected);
    let weekMonthDiscount = 0;
    let discountPerNight = 0;
    let discountApplied = '';

    // then -> 7 day or more till 27 -> check if there is discount on listing (weekly discount)
    let weeklyDiscountPrice = 0;
    if (totalDaysSelected >= 7 && totalDaysSelected <= 27 && listing_weeklydiscount > 0) {
        // apply weekly discount if available
        weekMonthDiscount = listing_weeklydiscount;
        weeklyDiscountPrice = (basePrice / 100) * listing_weeklydiscount;
        discountPerNight = (basePrice / 100) * listing_weeklydiscount;
        weeklyPrice.html(weeklyDiscountPrice);
        console.log(weeklyDiscountPrice)
        discountApplied = 'weekly'
    }
    // then -> 28 or more days -> check if there is discount on listing (monthly discount)
    let monthlyDiscountPrice = 0;
    if (totalDaysSelected >= 28 && listing_monthlydiscount > 0) {
        // apply monthly discount if available
        weekMonthDiscount = listing_monthlydiscount;
        monthlyDiscountPrice = (basePrice / 100) * listing_monthlydiscount
        discountPerNight = (basePrice / 100) * listing_monthlydiscount;
        monthlyPrice.html(discountPerNight);
        console.log(monthlyDiscountPrice)
        discountApplied = 'monthly'
    }
    // if booking is less than 3 -> then check special discount -> if yes apply that
    // apply welcome only if bigger than monthly or weekly
    let welcomeDiscountPrice = 0;
    if (listing_bookings_count < 3 && listing_welcomeoffer > 0 && listing_welcomeoffer > weekMonthDiscount) {
        // apply welcome discount if available
        welcomeDiscountPrice = (basePrice / 100) * listing_welcomeoffer
        discountPerNight = (basePrice / 100) * listing_welcomeoffer;
        welcomePrice.html(discountPerNight);
        console.log(welcomeDiscountPrice)
        discountApplied = 'welcome'
    }
    const discountedPricePerNight = basePrice - discountPerNight;
    console.log(discountedPricePerNight)
    console.log(totalNights)

    if (discountApplied == 'weekly') {
        console.log(discountApplied)
        discount_welcome_panel.hide()
        discount_weekly_panel.show()
        discount_monthly_panel.hide()
    } else if (discountApplied == 'monthly') {
        console.log(discountApplied)
        discount_welcome_panel.hide()
        discount_weekly_panel.hide()
        discount_monthly_panel.show()
    } else if (discountApplied == 'welcome') {
        console.log(discountApplied)
        discount_welcome_panel.show()
        discount_weekly_panel.hide()
        discount_monthly_panel.hide()
    }
    // then make total
    const basePrices0 = discountedPricePerNight * totalNights;
    // console.log(basePrices0);
    const basePrices = basePrices0 + listing_cleaning_fee;
    // console.log(basePrices)
    const servicePrices = ((basePrices0 + listing_cleaning_fee) / 100) * serviceFee;
    // console.log(servicePrices)
    const lodgingPrices = ((basePrices0 + listing_cleaning_fee) / 100) * lodgingTax;
    // console.log(lodgingPrices)
    const totalPricingAmount = parseInt(basePrices + servicePrices + lodgingPrices);
    dataForForm = {
        servicePrices,
        lodgingPrices,
        totalPricingAmount,
        discountApplied,
        discountedPricePerNight,
        totalNights,
        discountPerNight,
        weeklyDiscountPrice,
        monthlyDiscountPrice,
        welcomeDiscountPrice
    }
    // console.log(totalPricingAmount)
    calculatePriceButton.hide();
    resetCalculatebutton.show();
    openGuestFormButton.show();
    totalPriceHtml.html(totalPricingAmount);
    showPriceBreakdownPanel.show();
}

// GUESTS QUANTITY BUTTONS
function qtySum() {
    if (document.querySelector(".qtyTotal")) {
        // var arr = document.getElementsByName("qtyInput");
        var arr = document.getElementsByClassName("qtyInput");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].value)) tot += parseInt(arr[i].value);
        }
        // var qtyInputTotal = document.querySelector("#qtyInputTotal");
        var qtyInputTotal = $('#qtyInputTotal');
        qtyInputTotal.val(tot);

        var cardQty = document.querySelector(".qtyTotal")
        cardQty.innerHTML = qtyInputTotal.val();
        var formData = new FormData(_bookingForm[0]);
        console.log(Array.from(formData));
        // add guest forms here
        // const formData = Array.from(formData)
        // console.log(formData)
        const getMainInput = $('#qtyInputTotal').val();
        // console.log(totalGuests)
        addGuests(getMainInput)
    }
}
qtySum();
$(function () {
    $(".qtyButtons input").after('<div class="qtyInc"></div>');
    $(".qtyButtons input").before('<div class="qtyDec"></div>');

    $(".qtyDec, .qtyInc").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("qtyInc")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        var getMainInput = $('#qtyInputTotal');
        var wholeMaxValue = parseInt(getMainInput.attr('max'));
        var wholeOldValue = parseInt(getMainInput.val());
        console.log(wholeMaxValue)
        console.log(wholeOldValue)
        if (wholeOldValue < wholeMaxValue) {
            // if($button.parent().find("input").attr('min') <= newVal && $button.parent().find("input").attr('max') >= newVal) {
            $button.parent().find("input").val(newVal);
            qtySum();
            // }
            $(".qtyTotal").addClass("rotate-x");
        }
    });
    function removeAnimation() {
        $(".qtyTotal").removeClass("rotate-x");
    }
    if (document.querySelector(".qtyTotal")) {
        const counter = document.querySelector(".qtyTotal");
        counter.addEventListener("animationend", removeAnimation);
    }
});

function addGuests(totalGuests) {
    const guestsAccordion = document.getElementById('guestsAccordion');
    // return;
    guestsAccordion.innerHTML = '';
    console.log(totalGuests)

    for (i = 0; i < totalGuests; i++) {
        var DIV = document.createElement('div');
        DIV.classList.add('toggle-wrap');

        var SPAN = document.createElement('span');
        SPAN.classList.add('trigger');
        SPAN.id = 'trigger' + i;

        var ANCHOR = document.createElement('a');
        ANCHOR.href = '#';
        ANCHOR.innerHTML = 'Guest ' + (i + 1);

        var ICON = document.createElement('i');
        ICON.classList.add('sl');
        ICON.classList.add('sl-icon-plus');

        ANCHOR.appendChild(ICON);
        SPAN.appendChild(ANCHOR);

        var DIV2 = document.createElement('div');
        if (totalGuests > 1) {
            DIV2.classList.add('toggle-container');
        }
        DIV2.id = 'toggle-container' + i;

        var DIV01 = document.createElement('div');
        DIV01.classList.add('personalGuestsDetails');

        var INPUT01 = document.createElement('input');
        INPUT01.classList.add('guestName');
        INPUT01.id = 'guestname_' + i;
        INPUT01.placeholder = 'Guest ' + (i + 1) + ' Name';
        INPUT01.setAttribute('name', "guest[" + i + "]['name']");
        INPUT01.setAttribute('type', 'text');
        INPUT01.setAttribute('required', 'required');
        DIV01.appendChild(INPUT01);

        var INPUT02 = document.createElement('input');
        INPUT02.classList.add('guestAge');
        INPUT02.id = 'guestage_' + i;
        INPUT02.placeholder = 'Age';
        INPUT02.setAttribute('name', "guest[" + i + "]['age']");
        INPUT02.setAttribute('type', 'number');
        INPUT02.setAttribute('required', 'required');
        INPUT02.setAttribute('min', '1');
        INPUT02.setAttribute('max', '99');
        DIV01.appendChild(INPUT02);

        const genderOptions = [
            {
                value: 'Male',
                name: 'Male'
            },
            {
                value: 'Female',
                name: 'Female'
            }
        ];
        const GENDERSELECT = getSelectInput(i, 'gender', genderOptions, true, 'Gender');
        DIV01.appendChild(GENDERSELECT);

        DIV2.appendChild(DIV01);

        // var LABEL1 = document.createElement('label');
        var LABEL1 = getLabel('heading', '<h4>Medical Data</h4>');
        // var H41 = document.createElement('h4');
        // H41.innerHTML = 'Medical Data';
        // LABEL1.appendChild(H41);

        DIV2.appendChild(LABEL1);

        // medical Condition div
        var DIVMC = document.createElement('div');
        DIVMC.classList.add('checkboxes');
        DIVMC.classList.add('in-row');
        DIVMC.classList.add('margin-bottom-20');

        var DIV001 = document.createElement('div');
        var INPUT11 = document.createElement('input');
        INPUT11.setAttribute('type', 'checkbox');
        INPUT11.id = 'flusymptoms_' + i;
        INPUT11.classList.add('guest_flusymptoms_');
        var LABEL11 = document.createElement('label');
        LABEL11.setAttribute('for', 'flusymptoms_' + i);
        LABEL11.innerHTML = 'Do you have any of the following flu like symptoms?<br>'
        var SMALL11 = document.createElement('small');
        LABEL11.innerHTML = '(ex: Fever, Cough, Sore Throat, Runny Nose, Shortness of Breath etc...)';
        LABEL11.appendChild(SMALL11);
        DIV001.appendChild(INPUT11);
        DIV001.appendChild(LABEL11);

        var INPUT001 = document.createElement('input');
        INPUT001.id = 'flusymptoms_' + i + 'guest';
        INPUT001.placeholder = 'Write flu symptoms';
        INPUT001.setAttribute('name', "guest[" + i + "]['flu_symptoms']");
        INPUT001.style.display = 'none';

        // medical conition data
        var DIV002 = document.createElement('div');
        var INPUT12 = document.createElement('input');
        INPUT12.setAttribute('type', 'checkbox');
        INPUT12.id = 'chronicmedicalcondition_' + i;
        INPUT12.classList.add('guest_chronicmedicalcondition_');
        var LABEL12 = document.createElement('label');
        LABEL12.setAttribute('for', 'chronicmedicalcondition_' + i);
        LABEL12.innerHTML = 'Do you have any chronic medical condition?<br>such as diabetes, hypertension, cancer, immune compromising disorder?';
        DIV002.appendChild(INPUT12);
        DIV002.appendChild(LABEL12);


        var INPUT002 = document.createElement('input');
        INPUT002.id = 'chronicmedicalcondition_' + i + 'guest';
        INPUT002.placeholder = 'Write chronic edical condition';
        INPUT002.setAttribute('name', "guest[" + i + "]['chronic_medical_condition']");
        INPUT002.style.display = 'none';


        var DIV003 = document.createElement('div');
        var INPUT13 = document.createElement('input');
        INPUT13.setAttribute('type', 'checkbox');
        INPUT13.id = 'onmedication_' + i;
        INPUT13.classList.add('guest_onmedication_');
        var LABEL13 = document.createElement('label');
        LABEL13.setAttribute('for', 'onmedication_' + i);
        LABEL13.innerHTML = 'Are you currently on any medication?';
        DIV003.appendChild(INPUT13);
        DIV003.appendChild(LABEL13);


        var INPUT003 = document.createElement('input');
        INPUT003.id = 'onmedication_' + i + 'guest';
        INPUT003.placeholder = 'Write medication';
        INPUT003.setAttribute('name', "guest[" + i + "]['on_medication']");
        INPUT003.style.display = 'none';


        // var DIV004 = document.createElement('div');
        // var INPUT14 = document.createElement('input');
        // INPUT14.setAttribute('type', 'checkbox');
        // INPUT14.id = 'healthinsurance_' + i;
        // INPUT14.classList.add('guest_healthinsurance_');
        // var LABEL14 = document.createElement('label');
        // LABEL14.setAttribute('for', 'healthinsurance_' + i);
        // LABEL14.innerHTML = 'Guest have health insurance?';
        // DIV004.appendChild(INPUT14);
        // DIV004.appendChild(LABEL14);


        var LABEL14 = document.createElement('label');
        LABEL14.setAttribute('for', 'healthinsurance_' + i);
        LABEL14.innerHTML = 'Guest have health insurance?';
        const insuranceOptions = [
            {
                value: 'Yes',
                name: 'Yes'
            },
            {
                value: 'No',
                name: 'No'
            }
        ];
        const INSURANCESELECT = getSelectInput(i, 'health_insurance', insuranceOptions, true);

        // var INPUT004 = document.createElement('input');
        // INPUT004.id = 'healthinsurance_' + i + 'guest';
        // INPUT004.placeholder = 'Write health insurance details';
        // INPUT004.setAttribute('name', "guest[" + i + "]['health_insurance']");
        // INPUT004.style.display = 'none';

        DIVMC.appendChild(DIV001);
        DIVMC.appendChild(INPUT001);
        DIVMC.appendChild(DIV002);
        DIVMC.appendChild(INPUT002);
        DIVMC.appendChild(DIV003);
        DIVMC.appendChild(INPUT003);
        // DIVMC.appendChild(DIV004);
        // DIVMC.appendChild(INPUT004);

        DIV2.appendChild(DIVMC);
        DIV2.appendChild(LABEL14);
        DIV2.appendChild(INSURANCESELECT);
        DIV.appendChild(SPAN);
        DIV.appendChild(DIV2);

        guestsAccordion.appendChild(DIV)
    }
    reInit();
    initiateGuestFunctions();
}

function getLabel(labelfor, labeltext, index = '') {
    var LABEL = document.createElement('label');
    LABEL.setAttribute('for', labelfor + index);
    LABEL.innerHTML = labeltext;
    return LABEL;
}
function getSelectInput(index, name, options, required = false, defaultOption = 'select') {
    var SELECT01 = document.createElement('select');
    SELECT01.id = 'select_' + name + '_' + index;
    SELECT01.setAttribute('name', "guest[" + index + "]['" + name + "']");
    SELECT01.setAttribute('required', required);

    var OPTION1 = document.createElement('option');
    OPTION1.setAttribute('value', '');
    OPTION1.innerText = defaultOption;
    SELECT01.appendChild(OPTION1);

    options.forEach((option) => {
        var OPTION2 = document.createElement('option');
        OPTION2.setAttribute('value', option.value);
        OPTION2.innerText = option.name;
        SELECT01.appendChild(OPTION2);
    })

    return SELECT01;
}

function initiateGuestFunctions() {
    $('.guest_flusymptoms_').change(function () {
        console.log(this.id)
        if (this.checked) {
            $('#' + this.id + 'guest').show();
            $('#' + this.id + 'guest').attr('required', 'required');
        } else {
            $('#' + this.id + 'guest').hide();
            $('#' + this.id + 'guest').val('');
            $('#' + this.id + 'guest').removeAttr('required');
        }
    });
    $('.guest_chronicmedicalcondition_').change(function () {
        console.log(this.id)
        if (this.checked) {
            $('#' + this.id + 'guest').show();
            $('#' + this.id + 'guest').attr('required', 'required');
        } else {
            $('#' + this.id + 'guest').hide();
            $('#' + this.id + 'guest').val('');
            $('#' + this.id + 'guest').removeAttr('required');
        }
    });
    $('.guest_healthinsurance_').change(function () {
        console.log(this.id)
        if (this.checked) {
            $('#' + this.id + 'guest').show();
            $('#' + this.id + 'guest').attr('required', 'required');
        } else {
            $('#' + this.id + 'guest').hide();
            $('#' + this.id + 'guest').val('');
            $('#' + this.id + 'guest').removeAttr('required');
        }
    });
    $('.guest_onmedication_').change(function () {
        console.log(this.id)
        if (this.checked) {
            $('#' + this.id + 'guest').show();
            $('#' + this.id + 'guest').attr('required', 'required');
        } else {
            $('#' + this.id + 'guest').hide();
            $('#' + this.id + 'guest').val('');
            $('#' + this.id + 'guest').removeAttr('required');
        }
    });
}

// var formData = new FormData(_bookingForm[0]);

// open guest form for booking request
function openGuestsForm() {
}

const guestForm = $('#guestsData');

guestForm.submit(function (event) {
    event.preventDefault();

    var formData = new FormData(guestForm[0]);
    // var formData2 = new FormData(_bookingForm[0]);
    var formData2 = _bookingForm.serializeArray();

    // console.log(Array.from(formData),Array.from(formData2));

    formData2.forEach(function (fields) {
        formData.append(fields.name, fields.value);
    });
    formData.append('dataForForm', JSON.stringify(dataForForm));

    // formData.append('booking',formData2)
    console.log(Array.from(formData));

    $.ajax(window.location.href, {
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (response) {
        // if get error show error and stop loader.
        // else show success message and stop loader
        console.log(JSON.parse(response));
        var res = JSON.parse(response);
        if (res.success) {
            alert(res.message);
            location.reload();
        }
    });

})

// // INSTANT OR REVIEW BOOKING PART

// if guest cancel the booking -> taxes + gateway fee + hillstay service fee -> will be deducted -> show consent before cancel
// if host cancel the booking -> the next booking will be decucted by hillstay -> taxes + gateway fee + hillstay service fee

// if  host cancel the booking -> it will came to reviews of the listing

// if guest cancel any advance booking -> it will depends on cancellation policy by host on refund amount (50% / full-refund / 0refund)

// if instant booking -> if property is in sanitization -> show the user of sanitization data (true/false) when doing the payment -> also need to check the consent before pay
// 	host -> if instant booking -> if property is in sanitization -> show the host of sanitization data (true/false) when booking is confirmed (agree / disagree)
// 		if host disagree the consent -> show popup with button to cancel the boooking and in poup show text for cancellation losses (not be superhost for 1year + guest will get full refund)

// guest -> after booking confirmed -> after payment only -> show the host contact details


// re-initialize scripts
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