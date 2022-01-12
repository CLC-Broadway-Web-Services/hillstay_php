const edit_listing = $('#edit_listing');
const listing_form_loader = $('#listing_form_loader');
function startLoader() {
    edit_listing.hide();
    listing_form_loader.show();
}

function stopLoader() {
    edit_listing.show();
    listing_form_loader.hide();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// $(".listing-section-content").hide();
$(".toggleTrigger, .toggleTrigger.opened").on("click", function (a) {
    $(this).toggleClass("active");
    a.preventDefault();
});
$(".toggleTrigger").on("click", function () {
    $(this).parent().next(".listing-section-content").slideToggle(300);
    $(this).toggleClass('rotated');
});
$(".toggleTrigger.opened").addClass("active").parent().next(".listing-section-content").show();


if ($('.tinymce')) {
    tinymce.init({
        selector: '.tinymce',
        branding: false,
        plugins: 'wordcount',
        height: 100,
        init_instance_callback: function (editor) {
            editor.on("Change", function (e) {
                tinyMCE.triggerSave();
            });
        }
    });
}

function tinymceValidation() {
    var content = tinymce.get('description').getContent();
    if (content === "" || content === null) {
        $("#descriptionError").html("<span>Please enter description before continue.</span>");
        return false;
    } else {
        $("#descriptionError").html("");
        return true;
    }
}

// basic information settings
// step 2
var propertyName = '';
var propertyType_description = $('#propertyType_description');

var showOffBeat = $('#showOffBeat');
var offBeatSection = $('#offBeatSection');
var onRoadInput = $('#onRoadInput');
var offbeat_walking = $('#offbeat_walking');
var offbeat_market = $('#offbeat_market');
var offbeat_medical = $('#offbeat_medical');
var offbeat_town = $('#offbeat_town');
var offbeat_busstation = $('#offbeat_busstation');

var guestsOptions = $('#guestsOptions');

var propertytyperooms = $('#propertytyperooms');
var haveRooms = $('#haveRooms');

const propertyTypes = $('#propertyTypes').html();

async function onChangeProperty(event) {
    // guestsOptions.removeAttr('hidden');
    // console.log(event);
    // console.log(propertyTypes);
    type = JSON.parse(propertyTypes);
    // console.log(type);
    var selectedType = await type.filter(type => type.value == event)[0]
    // console.log(selectedType);
    var description = '';
    if (selectedType['description']) {
        description = selectedType.description
    }
    propertyType_description.html(description);
    propertyType_description.removeAttr('hidden');

    propertyName = selectedType['name'];
    var entireF = $('#entireF');
    var privateF = $('#privateF');
    var sharedeF = $('#sharedF');

    // guest options
    if (selectedType['guestOptions'].length) {
        if (!entireF.attr('readonly')) {
            console.log('not readonly entire')
            if (selectedType['guestOptions'][0]['entire']) {
                entireF.attr('checked', true);
                entireF.attr('onclick', "return false;");
            } else {
                entireF.removeAttr('checked');
                entireF.attr('onclick', "return true;");
                if (entireF.prop('checked') === true) {
                    entireF.closest("label").click();
                }
            }
        }
        if (!privateF.attr('readonly')) {
            // console.log('not readonly private')
            if (selectedType['guestOptions'][1]['private']) {
                // privateF.attr('readonly', true);
                privateF.attr('checked', true);
                privateF.attr('onclick', "return false;");
            } else {
                privateF.removeAttr('checked');
                privateF.attr('onclick', "return true;");
                if (privateF.prop('checked') === true) {
                    privateF.closest("label").click();
                }
            }
        }
        if (!sharedeF.attr('readonly')) {
            // console.log('not readonly shared')
            if (selectedType['guestOptions'][2]['shared']) {
                sharedeF.attr('checked', true);
                sharedeF.attr('onclick', "return false;");
            } else {
                sharedeF.removeAttr('checked');
                sharedeF.attr('onclick', "return true;");
                if (sharedeF.prop('checked') === true) {
                    sharedeF.closest("label").click();
                }
            }
        }
    } else {
        if (!entireF.attr('readonly')) {
            entireF.removeAttr('checked');
            entireF.attr('onclick', "return true;");
            if (entireF.prop('checked') === true) {
                entireF.closest("label").click();
            }
        }
        if (!privateF.attr('readonly')) {
            privateF.removeAttr('checked');
            privateF.attr('onclick', "return true;");
            if (privateF.prop('checked') === true) {
                privateF.closest("label").click();
            }
        }
        if (!sharedeF.attr('readonly')) {
            sharedeF.removeAttr('checked');
            sharedeF.attr('onclick', "return true;");
            if (sharedeF.prop('checked') === true) {
                sharedeF.closest("label").click();
            }
        }
    }

    //off-beat options
    if (selectedType['offbeat']) {
        showOffBeat.removeAttr('hidden');
    } else {
        showOffBeat.attr('hidden', 'hidden');
    }

    // rooms options
    var selectedRooms = selectedType['haveRooms'];
    if (selectedRooms.length) {
        var roomOptions = '<option value="">Select Room</option>';

        var i = 0;

        const listingPropertyTypeRooms = $('#propertytyperoomsData').val();

        for (i; i < selectedRooms.length; i++) {
            var roomName = selectedRooms[i]['name'];
            var roomValue = selectedRooms[i]['value'];
            var selected = '';
            if (listingPropertyTypeRooms == selectedRooms[i]['value']) {
                selected = 'selected';
            }
            roomOptions += '<option ' + selected + ' value="' + roomValue + '">' + roomName + '</option>';
        }

        propertytyperooms.html(roomOptions);
        haveRooms.removeAttr('hidden');
    } else {
        propertytyperooms.val(0);
        propertytyperooms.html('');
        haveRooms.attr('hidden', 'hidden');
    }

    // if (selectedType['infoModal']) {
    //     showPopupStep2();
    // }
}

$('#offbeat').change(function () {
    offBeatOnChange($(this));
});

function offBeatOnChange(event) {
    if (event.prop('checked') === true) {
        offBeatSection.removeAttr('hidden');

        offbeat_walking.attr('required', true);
        offbeat_market.attr('required', true);
        offbeat_medical.attr('required', true);
        offbeat_town.attr('required', true);
        offbeat_busstation.attr('required', true);
    } else {
        offBeatSection.attr('hidden', 'hidden')

        offbeat_walking.removeAttr('required');
        offbeat_market.removeAttr('required');
        offbeat_medical.removeAttr('required');
        offbeat_town.removeAttr('required');
        offbeat_busstation.removeAttr('required');
    }
}
$('#offbeatonroad').change(function () {
    offBeatOnRoadOnChange($(this));
});

function offBeatOnRoadOnChange(event) {
    if (event.prop('checked') === true) {
        onRoadInput.attr('hidden', 'hidden');
        offbeat_walking.removeAttr('required');
    } else {
        onRoadInput.removeAttr('hidden');
        offbeat_market.attr('required', true);
    }
}

function showPopupStep2() {
    var block1content = 'A ' + propertyName + ' on Hillstay should be a licenced hospitality business and we will require a licence or registration certificate approved by the govt authority to make sure it meets our criteria. This helps listings appear in the right searches and lets guests know what to expect.';
    var block2content = 'If that doesn’t sound like your property, please change the propertytype.';
    var popContent = '<div id="modal999" class="zoom-anim-dialog mfp_modal"><div class="small-dialog-header"><h4>This listing will go through review</h4></div><div class="sign-in-form style-1 mb-0"><div class="login mb-0"><p class="form-row form-row-wide"><label>' + block1content + '</label></p><p class="form-row form-row-wide mb-5"><label>' + block2content + '</label></p><p class="form-row form-row-wide"></p></div></div><button title="Close (Esc)" type="button" class="mfp-close"></button></div>';
    $.magnificPopup.open({
        items: {
            src: popContent,
            // src: '#modal999',
            type: 'inline'
        }
    });
}
var propertytypeData = $('#propertytypeData').val();
// console.log(propertytypeData);
onChangeProperty(propertytypeData);
offBeatOnChange($('#offbeat'));
offBeatOnRoadOnChange($('#offbeatonroad'));

// ACCOMODATION FUNCTIONS START
// sleeping arrangements functions start
const sleep_arrangementsData = JSON.parse($('#sleep_arrangements').html());
// console.log(sleep_arrangementsData);
const sleepArrangementArray = document.getElementById('sleepArrangementArray');

var sleepBlock = $('#sleepBlock').html();

var oldBedroomValue = parseInt(0);

async function onSelectBedrooms(bedrooms, thisOld = false) {
    var sleep_arrangements_array = await JSON.parse($('#sleep_arrangements').html());
    console.log(sleep_arrangements_array);
    bedrooms = parseInt(bedrooms);
    // console.log(bedrooms);
    // console.log(oldBedroomValue);
    var restValue = parseInt(bedrooms) - parseInt(oldBedroomValue);
    // console.log(restValue);
    if (bedrooms > oldBedroomValue) {
        for (var totalBedroom = 0; totalBedroom < restValue; totalBedroom++) {
            // var bedRoomsValue = $('#sleep_bedrooms').val();
            // console.log(bedRoomsValue);
            // console.log(bedRoomsValue);
            var bedroomCount = $('.custom_sleep_arrangement_box').length;
            console.log(bedroomCount);
            var newValue = parseInt(oldBedroomValue) + parseInt(totalBedroom);

            var newDiv = document.createElement('div');
            newDiv.classList.add('sleepingblocks');
            newDiv.style.paddingTop = '15px';
            newDiv.style.paddingBottom = '15px';
            newDiv.id = 'sleepingBlock_x' + (newValue + 1);

            var str = sleepBlock;
            var str2 = str.replace(/_x1/g, '_x' + (newValue + 1));
            var str3 = str2.replace('Room 1', 'Room ' + (newValue + 1));
            var sleepBedsArray = sleep_arrangements_array[totalBedroom];
            // console.log(sleepBedsArray);
            var str4 = str3;
            if (thisOld) {
                var xrt = '<input class="d-none" value="' + sleepBedsArray['lsaid'] + '" name="accomodation[' + bedroomCount + '][lsaid]">';
                str4 = str3.replace('<!--oldlsaid-->', xrt);
                var str5 = str4.replace('total_beds_x', sleepBedsArray['total_beds']);
                var str6 = str5.replace('double_bed_x', sleepBedsArray['double_bed']);
                var str7 = str6.replace('king_bed_x', sleepBedsArray['king_bed']);
                var str8 = str7.replace('queen_bed_x', sleepBedsArray['queen_bed']);
                var str9 = str8.replace('single_bed_x', sleepBedsArray['single_bed']);
                var str10 = str9.replace('floormat_bed_x', sleepBedsArray['floormat_bed']);
                var str11 = str10.replace('sofa_bed_x', sleepBedsArray['sofa_bed']);
                var str12 = str11.replace('bunk_bed_x', sleepBedsArray['bunk_bed']);
                var str13 = str12.replace('hammock_bed_x', sleepBedsArray['hammock_bed']);
            } else {
                var str5 = str4.replace('total_beds_x', 0);
                var str6 = str5.replace('double_bed_x', 0);
                var str7 = str6.replace('king_bed_x', 0);
                var str8 = str7.replace('queen_bed_x', 0);
                var str9 = str8.replace('single_bed_x', 0);
                var str10 = str9.replace('floormat_bed_x', 0);
                var str11 = str10.replace('sofa_bed_x', 0);
                var str12 = str11.replace('bunk_bed_x', 0);
                var str13 = str12.replace('hammock_bed_x', 0);
            }

            // replace total & all bed types

            // var newBlock = str13.replace(/_x\{0\}/g, '_x[' + parseInt(parseInt(totalBedroom) + 1) + ']');
            var newBlock = str13.replace(/_accindex_/g, bedroomCount);

            newDiv.innerHTML = newBlock;

            sleepArrangementArray.appendChild(newDiv);
        }
    } else {
        var restValue = parseInt(oldBedroomValue) - parseInt(bedrooms);
        // console.log(restValue);
        for (var totalBedroom = 0; totalBedroom < restValue; totalBedroom++) {
            var removingBlockId = 'sleepingBlock_x' + parseInt(parseInt(oldBedroomValue) - totalBedroom);
            // console.log(removingBlockId);
            $('#' + removingBlockId).remove();
        }
    }
    oldBedroomValue = bedrooms;
    return;
}

function showHideContainer(index) {
    // console.log(index)
    var hiddenbuttonstart = $('#hiddenbuttonstart' + index);
    var hiddencontainer = $('#hiddencontainer' + index);
    if (hiddencontainer.attr('hidden')) {
        hiddenbuttonstart.html('Done');
        hiddencontainer.removeAttr('hidden');
    } else {
        hiddenbuttonstart.html('Add Beds');
        hiddencontainer.attr('hidden', 'hidden');
    }
}

function increaseBeds(bed, index) {
    var currentBedIndex = bed + index;
    var currentBed = $('#' + currentBedIndex);
    var totalBeds = $('#' + 'sleepbeds' + index);

    var value = parseInt(parseInt(currentBed.val()) + 1)
    currentBed.val(value);
    totalValue = parseInt(parseInt(totalBeds.val()) + parseInt(1));
    totalBeds.val(totalValue);
}

function decreaseBeds(bed, index) {
    var currentBedIndex = bed + index;
    var currentBed = $('#' + currentBedIndex);
    var totalBeds = $('#' + 'sleepbeds' + index);

    if (currentBed.val() > 0 && totalBeds.val() > 0) {
        var value = parseInt(parseInt(currentBed.val()) - 1)
        currentBed.val(value);
        totalValue = parseInt(parseInt(totalBeds.val()) - parseInt(1));
        totalBeds.val(totalValue);
    }
}

// console.log($('#bedroomsData').val());
onSelectBedrooms($('#bedroomsData').val(), true)
// sleeping arrangement functions end

const bathrooms = $('#total_bathrooms');

function increaseBaths() {
    var value = parseInt(parseInt(bathrooms.val()) + 1)
    bathrooms.val(value);
}

function decreaseBaths() {
    if (bathrooms.val() > 1) {
        var value = parseInt(parseInt(bathrooms.val()) - 1)
        bathrooms.val(value);
    }
}
// ACCOMODATION FUNCTIONS ENDS

// location
const all_cities = JSON.parse($('#all_cities').html());
var district_cities = $('#district_cities');
var address_town = $('#address_town');

async function onStateSelect(state_id) {
    var districtSelected = parseInt($('#districtData').val());
    // console.log(state_id)
    var selectedCities = all_cities.filter(cities => cities.state_id == state_id)
    // console.log(selectedCities);

    var options = '<option disabled selected value="">Select District</option>';

    if (selectedCities.length > 0) {
        selectedCities.forEach(city => {
            var selected = '';
            if (city.id == districtSelected) {
                selected = 'selected';
            }
            options += '<option ' + selected + ' value="' + city.id + '">' + city.name + '</option>';
        });

        district_cities.html(options);
        district_cities.removeAttr('disabled');
        district_cities.trigger("chosen:updated");
    } else {
        district_cities.attr('disabled', 'disabled');
        district_cities.removeAttr('required');
        address_town.removeAttr('disabled');
    }
}

function onDistrictSelect() {
    address_town.removeAttr('disabled');
}
onStateSelect($('#stateData').val())
address_town.removeAttr('disabled');

// Amenities & Rules
const additionalRulesInputs = document.getElementById('additionalRulesInputs');
const additionalRulesValue = document.getElementById('additionalRulesValue');
const errorAditionalRules = document.getElementById('errorAditionalRules');

function addAditionalRules(additional_rule = null) {
    var value = additionalRulesValue.value;
    if (additional_rule) {
        value = additional_rule;
    }
    addAdditionalRule(value)
}

function addAdditionalRule(value) {
    if (value.trim()) {
        // console.log(value)
        errorAditionalRules.setAttribute('hidden', 'hidden')
        const DIV = document.createElement('DIV');
        DIV.classList.add('addAdditionalRrules');

        const INPUT = document.createElement('INPUT');
        INPUT.setAttribute('type', 'text');
        INPUT.setAttribute('readonly', 'readonly');
        INPUT.setAttribute('name', 'additoinal_rules[]');
        INPUT.style.display = 'inline';
        INPUT.value = value.trim();

        const ICON = document.createElement('I');
        ICON.setAttribute('onclick', 'removeRule(this)');
        ICON.classList.add('fa');
        ICON.classList.add('fa-close');
        ICON.style.color = '#113814';
        ICON.style.fontSize = '32px';
        ICON.style.lineHeight = '53px';
        ICON.style.float = 'right';
        ICON.style.right = '0';
        ICON.style.paddingRight = '5px';
        ICON.style.paddingLeft = '5px';
        ICON.style.cursor = 'pointer';
        ICON.style.position = 'absolute';

        DIV.appendChild(INPUT);
        DIV.appendChild(ICON);
        additionalRulesInputs.appendChild(DIV);

        additionalRulesValue.value = '';
    } else {
        errorAditionalRules.removeAttribute('hidden');
        console.log('no value');
        additionalRulesValue.value = '';
    }
}

function removeRule(event) {
    $(event).closest('div').remove();
}

var detailsChange = $(".detailsChange");
detailsChange.change(function () {
    var desc = this.name + '_desc';
    if (this.checked) {
        $('#' + desc).attr('required', 'required')
        $('#' + desc).removeAttr('hidden')
    } else {
        $('#' + desc).removeAttr('required')
        $('#' + desc).attr('hidden', 'hidden')
    }
});

detailsChange.each(function () {
    if ($(this).is(":checked")) {
        // console.log('this input is checked');
        var desc = this.name + '_desc';
        if (this.checked) {
            $('#' + desc).attr('required', 'required')
            $('#' + desc).removeAttr('hidden')
        } else {
            $('#' + desc).removeAttr('required')
            $('#' + desc).attr('hidden', 'hidden')
        }
    }
});

var additionalRulesData = JSON.parse($('#additionalRulesData').html());
additionalRulesData.forEach(rule => {
    addAditionalRules(rule);
})

// gallery
function onClickImage() {
    $('#gallery_image').click();
}
function editGalleryImage(elementId) {
    console.log(elementId);
    const data = JSON.parse($('#' + elementId).html());
    console.log(data);
    var image = '/' + data.image;
    var id = data.gid;
    var caption = data.caption;
    $('#gallery_image_image').attr('src', image);
    $('#gallery_id').val(id);
    $('#gallery_caption').val(caption);
    $('#gallery_reset_button').show();
}
function resetGalleryForm() {
    $('#gallery_image_preview').attr('src', '/public/assets/images/placeholder.jpg');
    $('#gallery_id').val(0);
    $('#gallery_caption').val('');
    $('#gallery_reset_button').hide();
}
function deleteGalleryImage(elementId, galleryId, image) {
    console.log(elementId);
    console.log(galleryId);
    var formData = new FormData();
    formData.append('form_name', 'delete_gallery');
    formData.append('gid', galleryId);
    formData.append('image', image);

    $.ajax({
        url: '',
        data: formData,
        type: 'post',
        contentType: false,
        processData: false
    }).done(function (data) {
        console.log(data)
        if (data == 'true') {
            alert('Successfully delete image.');
            $('#' + elementId).remove();
            return;
        }
        alert('Error deleteting gallery image, please try again later.')
    }).fail(function (data) {
        console.log(data);
        alert('Error deleteting gallery image, please try again later.')
    })
}
// var totalImages = 0;
// var listing_id_step_9 = $('#listing_id').val();

// let galleryImagesToChoose = [];
// let galleryImagesToDelete = [];
// const image_files = document.getElementById('image_files');
// const listing_gallery = document.getElementById('listing_gallery');

// function galleryFiles() {
//     var images = image_files.files;
//     console.log(images);
//     for (i = 0; i < images.length; i++) {
//         galleryImagesToChoose.push(images[i]);
//         insertImageToView(images[i], i);
//         // console.log(galleryImagesToChoose)
//     }
// }

// function insertImageToView(image, index, old = false, caption = '', cover = 'false') {

//     var IMG = document.createElement("img");
//     if (old) {
//         IMG.setAttribute('src', image);
//     } else {
//         var reader = new FileReader();
//         reader.onload = function () {
//             IMG.setAttribute('src', reader.result);
//         };
//         reader.readAsDataURL(image);
//     }
//     IMG.setAttribute('width', 'auto');

//     var DIV1 = document.createElement('div');
//     DIV1.classList.add('gallery_image_block');
//     DIV1.setAttribute('id', 'image_block_x' + (index + 1));

//     var HR = document.createElement('hr');

//     var DIV2 = document.createElement("div");
//     DIV2.classList.add('inputsDiv');
//     DIV2.classList.add('mt-3');

//     var INPUTCAPTION = document.createElement("INPUT");
//     INPUTCAPTION.setAttribute("type", "text");
//     INPUTCAPTION.classList.add('mb-0');
//     INPUTCAPTION.classList.add('caption_input');
//     INPUTCAPTION.setAttribute("name", "caption[" + index + "]");
//     INPUTCAPTION.setAttribute("placeholder", "image captions here");
//     if (old) {
//         INPUTCAPTION.setAttribute("value", caption);
//     }

//     var DIV3 = document.createElement("div");
//     DIV3.classList.add('checkboxes');
//     DIV3.classList.add('in-row');

//     var INPUTCOVER = document.createElement("INPUT");
//     INPUTCOVER.setAttribute("type", "radio");
//     INPUTCOVER.classList.add('captionsCheckbox');
//     INPUTCOVER.setAttribute("name", "cover");
//     INPUTCOVER.setAttribute("id", "checkbox" + [index]);
//     INPUTCOVER.value = index;
//     if (old && cover == 'true') {
//         INPUTCOVER.setAttribute("checked", "checked");
//     }

//     var LABEL = document.createElement("LABEL");
//     LABEL.setAttribute("for", "checkbox" + [index]);
//     LABEL.innerHTML = "for Cover image";

//     var DELETE = document.createElement("i");
//     DELETE.classList.add('im');
//     DELETE.classList.add('im-icon-Close');
//     DELETE.style.float = "right";
//     DELETE.style.fontSize = "x-large";
//     DELETE.setAttribute('onclick', 'deleteGalleryImage("' + index + '", false)');

//     DIV3.appendChild(INPUTCOVER);
//     DIV3.appendChild(LABEL);
//     DIV3.appendChild(DELETE);
//     DIV2.appendChild(INPUTCAPTION);
//     DIV2.appendChild(DIV3);
//     DIV1.appendChild(IMG);
//     DIV1.appendChild(HR);
//     DIV1.appendChild(DIV2);

//     listing_gallery.appendChild(DIV1);
//     console.log(galleryImagesToChoose);
// }

// function deleteGalleryImage(index, newImage = true) {
//     if (newImage) {
//         var numberIndex = parseInt(index);
//         galleryImagesToChoose.splice(numberIndex, 1);
//         var getIndex = 'image_block_x' + (parseInt(index) + 1);
//         console.log(getIndex);
//         document.getElementById(getIndex).remove();
//     } else {

//     }
// }
// var oldGalleryData = JSON.parse($('#oldGalleryData').html());
// if (oldGalleryData.length) {
//     oldGalleryData.forEach((data, index) => {
//         // console.log(data.caption);
//         var image = '/' + data.image;
//         var caption = data.caption == null ? '' : data.caption;
//         var cover = data.isCover == '1' ? 'true' : 'false';
//         // if (data.isCover == 1) {
//         //     cover = true;
//         // }
//         insertImageToView(image, index, true, caption, cover);
//     })
// }

// booking settings
// instant / reviewd
var reviewedbookingoptions = $('#reviewedbookingoptions');
var reviewedbooking_onedayresponse = $('#reviewedbooking_onedayresponse');
var reviewedbooking_ranklower = $('#reviewedbooking_ranklower');
var reviewedbooking_nohostprotection = $('#reviewedbooking_nohostprotection');
var reviewedCheckboxes = $('.reviewedCheckboxes');

var instantBookingoptions = $('#instantBookingoptions');

var instantBookingSubmit = $('#instantBookingSubmit');

instantReview(instantBookingSubmit.val())

function instantReview(event) {
    // console.log(event)
    if (event == 0) {
        instantBookingoptions.hide();
        reviewedbookingoptions.show();
        reviewedbooking_onedayresponse.attr('required', 'required')
        reviewedbooking_ranklower.attr('required', 'required')
        reviewedbooking_nohostprotection.attr('required', 'required')
    } else {
        instantBookingoptions.show();
        reviewedbookingoptions.hide();
        reviewedbooking_onedayresponse.removeAttr('required')
        reviewedbooking_ranklower.removeAttr('required')
        reviewedbooking_nohostprotection.removeAttr('required')
        reviewedbooking_onedayresponse.val('')
        reviewedbooking_ranklower.val('')
        reviewedbooking_nohostprotection.val('')
    }
}
// arrival notice
const guestsCheckoutTime = $('.guestsCheckoutTime');

function selectFrom(fromTime) {
    // var fromTime = event.target.value;
    $('#guestsCheckoutTimeSelect').val(0);
    console.log(fromTime)
    guestsCheckoutTime.each(function (index) {
        if ((fromTime + 1) > $(this).val()) {
            $(this).attr('disabled', 'disabled');
        } else {
            $(this).removeAttr('disabled');
        }
    });
    $('#guestsCheckoutTimeSelect').removeAttr('disabled');
    $('#guestsCheckoutTimeSelect').trigger("chosen:updated");
}

// advance booking
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

// max min nights
const nightsmin = $('#nightsmin');

const nightsmax = $('#nightsmax');

function addminNight() {
    nightsmin.val(parseInt(nightsmin.val()) + 1);
}
function removeminNight() {
    if (parseInt(nightsmin.val()) > 1) {
        nightsmin.val(parseInt(nightsmin.val()) - 1);
    }
}
function addmaxNight() {
    if (parseInt(nightsmin.val()) > parseInt(nightsmax.val())) {
        nightsmax.val(parseInt(nightsmin.val()) + 1);
    } else {
        nightsmax.val(parseInt(nightsmax.val()) + 1);
    }
}
function removemaxNight() {
    if (parseInt(nightsmin.val()) == parseInt(nightsmax.val())) {
        nightsmax.val(null);
        return;
    }
    if (parseInt(nightsmax.val()) > parseInt(nightsmin.val())) {
        nightsmax.val(parseInt(nightsmax.val()) - 1);
    }
}

// pricing
// cleaning fee
const showCleaningFee = $('#showCleaningFee');
const cleaning_fee_input = $('#cleaning_fee_input');

$("#cleaning_fee").change(function () {
    if (this.checked) {
        cleaning_fee_input.attr('required', 'required')
        showCleaningFee.show();
    } else {
        cleaning_fee_input.removeAttr('required');
        // cleaning_fee_input.val('');
        showCleaningFee.hide();
    }
});

if ($('#cleaningFeeRequiredData').val() == '1') {
    cleaning_fee_input.attr('required', 'required')
    showCleaningFee.show();
} else {
    cleaning_fee_input.removeAttr('required')
    showCleaningFee.hide();
}

// SAVING FORMS
$('#basic_information').submit(function (event) {
    event.preventDefault();
    startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Basic Information");
})
$('#accomodation').submit(function (event) {
    event.preventDefault();
    // startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Accomodation");
})
$('#location').submit(function (event) {
    event.preventDefault();
    startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Location");
})
$('#amenities_rules').submit(function (event) {
    event.preventDefault();
    startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Amenities & House Rules");
})
$('#gallery').submit(function (event) {
    event.preventDefault();
    // startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Image");
})
$('#booking_settings').submit(function (event) {
    event.preventDefault();
    startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Booking Settings");
})
$('#pricing').submit(function (event) {
    event.preventDefault();
    startLoader();
    var formData = new FormData($(this)[0]);
    console.log(Array.from(formData));
    ajaxFormSubmitions(formData, "Pricing");
})

// console.log(window.location);

async function ajaxFormSubmitions(formData, form_name) {
    $.ajax({
        url: '',
        data: formData,
        type: 'post',
        contentType: false,
        processData: false
    }).done(function (data) {
        // console.log(data)
        // console.log(JSON.parse(data))
        // return;
        // console.log(JSON.parse(data)['success'])
        var response = JSON.parse(data);
        if (response['success']) {
            // console.log('success') else {
            if (form_name == 'Accomodation') {
                showAlert(response['room_error'] ? response['room_error'] : response['message']);
            } else {
                showAlert(form_name + ' update successfully');
            }
            if (form_name == 'Image') {
                window.location.reload();
            }
        } else {
            if (form_name == 'Accomodation') {
                showAlert(response['room_error'] ? response['room_error'] : response['message'], 'Server Errors', 'error');
            } else {
                showAlert('There is some problem saving data, please try again later.', 'Server Errors', 'error');
            }
        }
    }).fail(function (data) {
        console.log(data)
        showAlert('There is some problem saving data, please try again later.', 'Server Errors', 'error');
    })
}
function showAlert(message, title = 'Success', type = 'success') {
    alert(message)
    stopLoader();
    // Alt.alternative({
    //     status: type,
    //     title: title,
    //     text: message
    // });
    // console.log('success alert')
}
$(window).on('load', function () {
    stopLoader();
})