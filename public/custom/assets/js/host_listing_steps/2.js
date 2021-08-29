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

const propertyTypes = $('#propertyTypes').val();
function onChangeProperty(event) {
    // guestsOptions.removeAttr('hidden');
    console.log(event);
    type = JSON.parse(propertyTypes);
    console.log(type);
    var selectedType = type.filter(type => type.value == event)[0]
    console.log(selectedType);
    propertyType_description.html(selectedType['description']);
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
            console.log('not readonly private')
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
            console.log('not readonly shared')
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

        for (i; i < selectedRooms.length; i++) {
            var roomName = selectedRooms[i]['name'];
            var roonValue = selectedRooms[i]['value'];
            roomOptions += '<option value="' + roonValue + '">' + roomName + '</option>';
        }

        propertytyperooms.html(roomOptions);
        haveRooms.removeAttr('hidden');
    } else {
        propertytyperooms.html('');
        haveRooms.attr('hidden', 'hidden');
    }

    if (selectedType['infoModal']) {
        showPopupStep2();
    }
}

$('#offbeat').change(function () {

    if ($(this).prop('checked') === true) {
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
});
$('#offbeatonroad').change(function () {
    if ($(this).prop('checked') === true) {
        onRoadInput.attr('hidden', 'hidden');
        offbeat_walking.removeAttr('required');
    } else {
        onRoadInput.removeAttr('hidden');
        offbeat_market.attr('required', true);
    }
});

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
