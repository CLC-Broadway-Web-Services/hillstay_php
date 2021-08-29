// step 3
// const sleepArrangementArray = $('#sleepArrangementArray');
const sleepArrangementArray = document.getElementById('sleepArrangementArray');
// var sleepBlockOne = $('#sleepingBlock_x1');
var sleepBlockInitial = `<div class="sleepingblocks" style="padding-top: 15px; padding-bottom: 15px;" id="sleepingBlock_x1" >
                    <div style="display: flex;">
                        <div style="width: 50%;">
                            <span style="font-size:25px;">Room 1</span><br>
                            <span style="font-size:18px;">
                                total beds <input name="sleepbeds_x[0]" id="sleepbeds_x1" value="0" class="bedsbox" readonly required min="1">
                            </span>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <button id="hiddenbuttonstart_x1" type="button" class="button" onclick="showHideContainer('_x1')">Add Beds</button>
                        </div>
                    </div>
                    <div id="hiddencontainer_x1" class="hiddencontainer" hidden> 
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Double</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('double', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="double_x1" class="bedvalue guestsvalue" value="0" readonly name="double_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('double', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">King</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('king', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="king_x1" class="bedvalue guestsvalue" value="0" readonly name="king_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('king', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Queen</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('queen', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="queen_x1" class="bedvalue guestsvalue" value="0" readonly name="queen_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('queen', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Single</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('single', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="single_x1" class="bedvalue guestsvalue" value="0" readonly name="single_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('single', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Sofa bed</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('sofabed', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="sofabed_x1" class="bedvalue guestsvalue" value="0" readonly name="sofabed_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('sofabed', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Bunkbed</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('bunkbed', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="bunkbed_x1" class="bedvalue guestsvalue" value="0" readonly name="bunkbed_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('bunkbed', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Hammock</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('hammock', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="hammock_x1" class="bedvalue guestsvalue" value="0" readonly name="hammock_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('hammock', '_x1')"></i>
                            </div>
                        </div>
                        <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                            <div style="width: 50%;">
                                <strong style="font-weight: normal;">Floor mattress</strong>
                            </div>
                            <div class="text-right" style="width: 50%;">
                                <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('floormat', '_x1')"></i>
                                <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                    <input id="floormat_x1" class="bedvalue guestsvalue" value="0" readonly name="floormat_x[0]">
                                </span>
                                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('floormat', '_x1')"></i>
                            </div>
                        </div>
                    </div>
                </div>`;
var sleepBlock = `<div style="display: flex;">
                    <div style="width: 50%;">
                        <span style="font-size:25px;">Room 1</span><br>
                        <span style="font-size:18px;">
                            total beds <input name="sleepbeds_x[0]" id="sleepbeds_x1" value="0" class="bedsbox" readonly required min="1">
                        </span>
                    </div>
                    <div class="text-right" style="width: 50%;">
                        <button id="hiddenbuttonstart_x1" type="button" class="button" onclick="showHideContainer('_x1')">Add Beds</button>
                    </div>
                </div>
                <div id="hiddencontainer_x1" class="hiddencontainer" hidden> 
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Double</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('double', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="double_x1" class="bedvalue guestsvalue" value="0" readonly name="double_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('double', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">King</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('king', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="king_x1" class="bedvalue guestsvalue" value="0" readonly name="king_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('king', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Queen</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('queen', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="queen_x1" class="bedvalue guestsvalue" value="0" readonly name="queen_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('queen', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Single</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('single', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="single_x1" class="bedvalue guestsvalue" value="0" readonly name="single_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('single', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Sofa bed</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('sofabed', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="sofabed_x1" class="bedvalue guestsvalue" value="0" readonly name="sofabed_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('sofabed', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Bunkbed</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('bunkbed', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="bunkbed_x1" class="bedvalue guestsvalue" value="0" readonly name="bunkbed_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('bunkbed', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Hammock</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('hammock', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="hammock_x1" class="bedvalue guestsvalue" value="0" readonly name="hammock_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('hammock', '_x1')"></i>
                        </div>
                    </div>
                    <div style="max-width: 400px; font-size:22px; padding: 5px; display: flex;">
                        <div style="width: 50%;">
                            <strong style="font-weight: normal;">Floor mattress</strong>
                        </div>
                        <div class="text-right" style="width: 50%;">
                            <i class="fa fa-minus-circle" style="color:#113814;font-size:32px" onclick="decreaseBeds('floormat', '_x1')"></i>
                            <span class="pl-4 pr-4 guestsvalue" style="min-width: 40px;">
                                <input id="floormat_x1" class="bedvalue guestsvalue" value="0" readonly name="floormat_x[0]">
                            </span>
                            <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('floormat', '_x1')"></i>
                        </div>
                    </div>
                </div>`;
// var sleepBlockOne = document.getElementById('sleepingBlock_x1');
var oldBedroomValue = parseInt($('#sleep_bedrooms').val());

if (_step == 3) {
    sleepArrangementArray.innerHTML = sleepBlockInitial;
}
// onSelectBedrooms(oldBedroomValue);

function onSelectBedrooms(bedrooms) {
    bedrooms = parseInt(bedrooms);
    console.log(bedrooms);
    console.log(oldBedroomValue);
    var restValue = parseInt(bedrooms) - parseInt(oldBedroomValue);
    console.log(restValue);
    if (bedrooms > oldBedroomValue) {

        for (var totalBedroom = 0; totalBedroom < restValue; totalBedroom++) {
            var newValue = parseInt(oldBedroomValue) + parseInt(totalBedroom);

            // console.log(oldBedroomValue + ' ' + ' ' + newValue);
            // console.log(bedrooms + ' ' + ' ' + totalBedroom);

            var newDiv = document.createElement('div');
            newDiv.classList.add('sleepingblocks');
            newDiv.style.paddingTop = '15px';
            newDiv.style.paddingBottom = '15px';
            newDiv.id = 'sleepingBlock_x' + (newValue + 1);

            var str = sleepBlock;
            var str2 = str.replace(/_x1/g, '_x' + (newValue + 1));
            var str3 = str2.replace('Room 1', 'Room ' + (newValue + 1));
            var newBlock = str3.replace(/_x\[0\]/g, '_x[' + parseInt(parseInt(totalBedroom) + 1) + ']');

            newDiv.innerHTML = newBlock;

            sleepArrangementArray.appendChild(newDiv);
        }
    } else {
        var restValue = parseInt(oldBedroomValue) - parseInt(bedrooms);
        console.log(restValue);
        for (var totalBedroom = 0; totalBedroom < restValue; totalBedroom++) {
            var removingBlockId = 'sleepingBlock_x' + parseInt(parseInt(oldBedroomValue) - totalBedroom);
            console.log(removingBlockId);
            $('#' + removingBlockId).remove();
        }
    }
    oldBedroomValue = bedrooms;
    return;



    // console.log(sleepBlockOne.html());
    // var newDiv = document.createElement('div');
    // console.log(sleepBlockOne.innerHTML);
    // return;
    // var str = sleepBlockOne.innerHTML;

    // console.log(newBlock);
    // console.log(newDiv);
}

function showHideContainer(index) {
    console.log(index)
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

// step 4