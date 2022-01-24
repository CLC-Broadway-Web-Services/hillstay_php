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
        const ICON = getHtmlPlainElement('i', '', [], ['sl', 'sl-icon-plus']);

        const ANCHOR = getHtmlPlainElement('a', 'Guest ' + (i + 1), [ICON], [], [{ name: 'href', value: '#' }]);

        const SPAN = getHtmlPlainElement('span', '', [ANCHOR], ['trigger'], [{ name: 'id', value: 'trigger' + i }], [])

        const guestNameClasses = ['guestName'];
        const guestNameAttr = [
            {
                name: 'placeholder',
                value: 'Guest ' + (i + 1) + ' Name'
            },
            {
                name: 'name',
                value: "guest[" + i + "]['name']"
            },
            {
                name: 'type',
                value: 'text'
            },
            {
                name: 'required',
                value: true
            }
        ];
        const INPUT01 = getInput('guestname_' + i, guestNameAttr, guestNameClasses);

        const guestAgeClasses = ['guestAge'];
        const guestAgeAttr = [
            {
                name: 'placeholder',
                value: 'Age'
            },
            {
                name: 'name',
                value: "guest[" + i + "]['age']"
            },
            {
                name: 'type',
                value: 'number'
            },
            {
                name: 'required',
                value: true
            },
            {
                name: 'min',
                value: '1'
            },
            {
                name: 'max',
                value: '99'
            }
        ];
        const INPUT02 = getInput('guestage_' + i, guestAgeAttr, guestAgeClasses);

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
        const genderAttr = [
            {
                name: 'id',
                value: 'select_gender_' + i
            },
            {
                name: 'name',
                value: "guest[" + i + "]['gender']"
            },
            {
                name: 'required',
                value: true
            }
        ];
        const GENDERSELECT = getSelect(genderOptions, 'Gender', genderAttr, []);

        const LABEL1 = getLabel('heading', '<h4>Medical Data</h4>');

        // Covid certification
        const VACCINATION = getInput('vaccination_' + i, [{ name: 'type', value: 'checkbox' }], ['guest_input_']);
        const VACCINATION_LABEL = getLabel('vaccination_' + i, 'Vaccination certificate (1st and 2nd Dose)');
        const DIVVACCINATION = getHtmlPlainElement('div', '', [VACCINATION, VACCINATION_LABEL]);
        const VACCINATION_HIDDEN = getInput('vaccination_' + i + 'guest', [{ name: 'type', value: 'file' }, { name: 'name', value: "guest_" + i + "_vaccination_certificate" }], ['guest_input_', 'form-control'], [{ name: 'display', value: 'none' }]);

        // Covid certification
        const RTPCR = getInput('rtpcr_' + i, [{ name: 'type', value: 'checkbox' }], ['guest_input_']);
        const RTPCR_LABEL = getLabel('rtpcr_' + i, 'RTPCR');
        const DIVRTPCR = getHtmlPlainElement('div', '', [RTPCR, RTPCR_LABEL]);
        const RTPCR_HIDDEN = getInput('rtpcr_' + i + 'guest', [{ name: 'type', value: 'file' }, { name: 'name', value: "guest_" + i + "_rtpcr_certificate" }], ['guest_input_', 'form-control'], [{ name: 'display', value: 'none' }]);

        // medical Condition div
        const INPUT11 = getInput('flusymptoms_' + i, [{ name: 'type', value: 'checkbox' }], ['guest_input_']);
        const LABEL11 = getLabel('flusymptoms_' + i, 'Do you have any of the following flu like symptoms?<br> <small>(ex: Fever, Cough, Sore Throat, Runny Nose, Shortness of Breath etc...)</small>');
        const DIV001 = getHtmlPlainElement('div', '', [INPUT11, LABEL11]);

        const INPUT001 = getInput('flusymptoms_' + i + 'guest', [{ name: 'placeholder', value: 'Write flu symptoms' }, { name: 'name', value: "guest[" + i + "]['flu_symptoms']" }], ['guest_input_'], [{ name: 'display', value: 'none' }]);

        // medical conition data
        const INPUT12 = getInput('chronicmedicalcondition_' + i, [{ name: 'type', value: 'checkbox' }], ['guest_input_']);
        const LABEL12 = getLabel('chronicmedicalcondition_' + i, 'Do you have any chronic medical condition?<br>such as diabetes, hypertension, cancer, immune compromising disorder?')
        const DIV002 = getHtmlPlainElement('div', '', [INPUT12, LABEL12]);

        const INPUT002 = getInput('chronicmedicalcondition_' + i + 'guest', [{ name: 'placeholder', value: 'Write chronic edical condition' }, { name: 'name', value: "guest[" + i + "]['chronic_medical_condition']" }], ['guest_input_'], [{ name: 'display', value: 'none' }]);

        const INPUT13 = getInput('onmedication_' + i, [{ name: 'type', value: 'checkbox' }], ['guest_input_']);
        const LABEL13 = getLabel('onmedication_' + i, 'Are you currently on any medication?');
        const DIV003 = getHtmlPlainElement('div', '', [INPUT13, LABEL13]);

        const INPUT003 = getInput('onmedication_' + i + 'guest', [{ name: 'placeholder', value: 'Write medication' }, { name: 'name', value: "guest[" + i + "]['on_medication']" }], ['guest_input_'], [{ name: 'display', value: 'none' }]);

        const LABEL14 = getLabel('healthinsurance_' + i, 'Guest have health insurance?');
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
        const insuranceAttr = [
            {
                name: 'id',
                value: 'select_insurance_' + i
            },
            {
                name: 'name',
                value: "guest[" + i + "]['health_insurance']"
            },
            {
                name: 'required',
                value: true
            }
        ];
        const INSURANCESELECT = getSelect(insuranceOptions, 'Select', insuranceAttr, []);

        const DIVMC = getHtmlPlainElement('div', '', [DIVVACCINATION, VACCINATION_HIDDEN, DIVRTPCR, RTPCR_HIDDEN, DIV001, INPUT001, DIV002, INPUT002, DIV003, INPUT003], ['checkboxes', 'in-row', 'margin-bottom-20']);

        const DIV01 = getHtmlPlainElement('div', '', [INPUT01, INPUT02, GENDERSELECT], ['personalGuestsDetails']);

        var DIV2CLASSES = [];
        if (totalGuests > 1) {
            DIV2CLASSES = ['toggle-container'];
        }
        const DIV2 = getHtmlPlainElement('div', '', [DIV01, LABEL1, DIVMC, LABEL14, INSURANCESELECT], DIV2CLASSES, [{ name: 'id', value: 'toggle-container' + i }]);

        const DIV = getHtmlPlainElement('div', '', [SPAN, DIV2]);

        guestsAccordion.appendChild(DIV)
    }
    reInit();
    initiateGuestFunctions();
}

function getHtmlPlainElement(element, innerhtml = '', appendedItems = [], classes = [], attributes = [], styles = []) {
    var HTMLELEMENT = document.createElement(element);
    if (innerhtml) {
        HTMLELEMENT.innerHTML = innerhtml;
    }
    classes.forEach((cls) => {
        HTMLELEMENT.classList.add(cls);
    })
    appendedItems.forEach((items) => {
        HTMLELEMENT.appendChild(items);
    })
    attributes.forEach((attr) => {
        HTMLELEMENT.setAttribute(attr.name, attr.value);
    })
    if (styles.length > 0) {
        var styleNow = '';
        styles.forEach((stl) => {
            styleNow += stl.name + ':' + stl.value + ';'
        })
        HTMLELEMENT.setAttribute('style', styleNow);
    }
    return HTMLELEMENT;
}
function getLabel(labelfor, labeltext, index = '') {
    var LABEL = document.createElement('label');
    LABEL.setAttribute('for', labelfor + index);
    LABEL.innerHTML = labeltext;
    return LABEL;
}
function getInput(id, attributes, classes = [], styles = []) {
    var INPUT = document.createElement('input');
    classes.forEach((cls) => {
        INPUT.classList.add(cls);
    })
    INPUT.id = id;
    attributes.forEach((attr) => {
        INPUT.setAttribute(attr.name, attr.value);
    })
    if (styles.length > 0) {
        var styleNow = '';
        styles.forEach((stl) => {
            styleNow += stl.name + ':' + stl.value + ';'
        })
        INPUT.setAttribute('style', styleNow);
    }
    return INPUT;
}
function getSelect(options, defaultOption, attributes, classes) {
    var SELECT = document.createElement('select');
    classes.forEach((cls) => {
        SELECT.classList.add(cls);
    })
    attributes.forEach((attr) => {
        SELECT.setAttribute(attr.name, attr.value);
    })

    var OPTION = document.createElement('option');
    OPTION.setAttribute('value', '');
    OPTION.innerText = defaultOption;
    SELECT.appendChild(OPTION);

    options.forEach((option) => {
        var OPTION2 = document.createElement('option');
        OPTION2.setAttribute('value', option.value);
        OPTION2.innerText = option.name;
        SELECT.appendChild(OPTION2);
    })

    return SELECT;
}

function initiateGuestFunctions() {
    $('.guest_input_').change(function () {
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

// open guest form for booking request
function openGuestsForm() {
}

const guestForm = $('#guestsData');

guestForm.submit(function (event) {
    event.preventDefault();

    var formData = new FormData(guestForm[0]);

    var formData2 = _bookingForm.serializeArray();

    formData2.forEach(function (fields) {
        formData.append(fields.name, fields.value);
    });
    formData.append('dataForForm', JSON.stringify(dataForForm));

    console.log(Array.from(formData));

    $.ajax(window.location.href, {
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
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