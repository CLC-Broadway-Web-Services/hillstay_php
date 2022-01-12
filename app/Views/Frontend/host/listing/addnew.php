<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<div class="row" style="margin-bottom:50px">
    <div class="col-12 mt-3">
        <div class="progress" style="height: 5px;">
            <div id="formProgressBar" class="progress-bar  bg-success" role="progressbar" style="width: <?= $_formProgress ?>%;"></div>
            <!-- <div id="formProgressBar" class="progress-bar bg-success" role="progressbar">
            </div> -->
        </div>
        <div id="add-listing">
            <div class="add-listing-section">
                <form id="_listingForm" action="<?= $_SERVER['REQUEST_URI'] ?>" onsubmit="return validate();" method="post" enctype="multipart/form-data" style="user-select: none !important;">
                    <input id="_step" name="_step" value="<?= $_steps ?>" readonly hidden>
                    <input id="user_id" name="user_id" value="<?= $user_id ?>" readonly hidden>
                    <input id="_mode" name="mode" value="<?= $mode ?>" readonly hidden>
                    <?php if ($_lastid > 0) { ?>
                        <input id="listing_id" name="listing_id" value="<?= $_lastid ?>" readonly hidden>
                    <?php } ?>
                    <!-- Let’s start listing your space. -->
                    <?php if ($_steps == 1) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Let’s start listing your Hillstay.</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>What kind of place are you listing?</label>
                                <select class="" id="placekind" name="placekind" required>
                                    <option value="">Select Space</option>
                                    <?php foreach ($selectPlaces as $key => $option) : ?>
                                        <option value="<?= $option['value'] ?>">
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div style="color:crimson;" id="placekind_error" hidden>
                                    Select place type is required.
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>How many guests can you accomodate?</label>
                                <select class="" name="guests" id="guests" required>
                                    <option value="">Select Guests</option>
                                    <?php foreach ($selectGuests as $key => $option) : ?>
                                        <option value="<?= $option['value'] ?>">
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div style="color:crimson;" id="guests_error" hidden>
                                    Guests is required.
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>Where are you located?</label>
                                <div class="main-search-input-item location">
                                    <div id="autocomplete-container">
                                        <input id="autocomplete-input" name="location" autocomplete="off" type="text" placeholder="Location" required>
                                    </div>
                                    <a><i class="fa fa-map-marker"></i></a>
                                </div>
                                <div style="color:crimson;" id="location_error" hidden>
                                    Location is required.
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- What kind of hillstay are you listing? -->
                    <?php if ($_steps == 2) : ?>
                        <input id="propertyTypes" value='<?= json_encode($propertyType) ?>' readonly hidden>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> What kind of hillstay are you listing?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label><strong>Select your property type</strong></label>
                                <select class="" name="propertytype" onchange="onChangeProperty(this.value)" required>
                                    <option value="">Property Type</option>
                                    <?php foreach ($propertyType as $key => $type) : ?>
                                        <option value='<?= $type['value'] ?>'>
                                            <?= $type['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="mb-3" id="propertyType_description" hidden></p>
                                <div id="haveRooms" hidden>
                                    <label class="mt-3"><strong>How many total rooms does your property have?</strong></label>
                                    <select name="propertytyperooms" id="propertytyperooms">
                                    </select>
                                </div>
                                <div id="showOffBeat" hidden>
                                    <div class="checkboxes in-row margin-bottom-20">
                                        <div>
                                            <input id="offbeat" type="checkbox" name="offbeat">
                                            <label for="offbeat">Is your Property Off-Beat?</label>
                                        </div>
                                    </div>
                                    <div id="offBeatSection" style="max-width:400px;" hidden>
                                        <div class="checkboxes in-row margin-bottom-20">
                                            <div>
                                                <input id="offbeatonroad" type="checkbox" name="offbeatonroad">
                                                <label for="offbeatonroad">Is your property onroad?</label>
                                            </div>
                                        </div>
                                        <div formGroupName="offbeatdistance">
                                            <div id="onRoadInput" class="kilometers">
                                                <div>
                                                    <label><strong>Walking Distance</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_walking" name="offbeat_walking" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Market</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_market" name="offbeat_market" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Medical Facility</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_medical" name="offbeat_medical" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Town</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_town" name="offbeat_town" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Bus Station</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_busstation" name="offbeat_busstation" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="guestsOptions">
                                <label><strong>What will guests have?</strong></label>
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="entireF" type="checkbox" name="entire" <?php if ($listing_data['placekind'] == 'entire') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="entireF">
                                            <?= $guestsHaveradioList[0]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[0]['description'] ?></small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="privateF" type="checkbox" name="private" <?php if ($listing_data['placekind'] == 'private') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="privateF">
                                            <?= $guestsHaveradioList[1]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[1]['description'] ?></small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="sharedF" type="checkbox" name="shared" <?php if ($listing_data['placekind'] == 'shared') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="sharedF">
                                            <?= $guestsHaveradioList[2]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[2]['description'] ?></small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Sleeping Arrangements -->
                    <?php if ($_steps == 3) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> How many guests can your place accommodate?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div>
                                    <p style="max-width: 350px;">Check that you have enough beds to accommodate all your
                                        guests comfortably
                                    </p>
                                </div>

                                <div class="mt-5">
                                    <label><strong>How many rooms can guests use?</strong></label>
                                    <select id="sleep_bedrooms" name="bedrooms" onchange="onSelectBedrooms(this.value)" style="max-width: 350px;">
                                        <?php foreach ($bedrooms as $key => $bedroom) : ?>
                                            <option value="<?= $bedroom['value'] ?>">
                                                <?= $bedroom['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div>
                                    <div class="sleepingblocks">
                                        <h3>Sleeping Arrangements</h3>
                                        <p>Sharing the types of beds in each room can help people understand the
                                            sleeping arrangements.</p>
                                    </div>
                                    <div id="sleepArrangementArray">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                    <!-- How many bathrooms? -->
                    <?php if ($_steps == 4) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> How many bathrooms?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="fs1" style="display:flex; padding:5px;max-width: 450px;">
                                    <div style="width: 50%;">
                                        <strong style="font-weight: normal;">Bathrooms</strong>
                                    </div>
                                    <div class="text-right" style="min-width: 50%;">
                                        <i class="fa fa-minus-circle" style="color:#113814" onclick="decreaseBaths()"></i>
                                        <input readonly class="bedvalue guestsvalue" name="bathrooms" id="total_bathrooms" value="1">
                                        <!-- <span class="pl-4 pr-4 guestsvalue" style="display:inline-block;width:85px;text-align:center;">{{bathRooms}}</span> -->
                                        <i class="fa fa-plus-circle" style="color:#113814" onclick="increaseBaths()"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Address -->
                    <?php if ($_steps == 5) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Where’s your place located?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12" formGroupName="locationfull">
                                <p>Guests will only get your exact address once they’ve booked a reservation.</p>
                                <div>
                                    <label>Street Address</label>
                                    <input name="address_full" type="text" placeholder="House name/number + street/road" required>
                                </div>
                                <div>
                                    <label>Flat, suite. (optional)</label>
                                    <input name="flat_no" type="text" placeholder="Flat, suite, building access code">
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>State</label>
                                        <select class="" name="state" onchange="onStateSelect(this.value)" required>
                                            <option disabled selected value="">Select State</option>
                                            <?php foreach ($states as $key => $option) : ?>
                                                <option value="<?= $option['id'] ?>">
                                                    <?= $option['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>District</label>
                                        <select id="district_cities" name="district" onchange="onDistrictSelect()" disabled required>
                                            <!-- <option disabled value="null">Select District</option>
                                            <option *ngFor="let option of districts; let i = index" value="i">
                                                {{option.district}}
                                            </option> -->
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>Town</label>
                                        <input id="address_town" name="town" type="text" disabled required>
                                        <!-- <select class="" name="town">
                                            <option disabled value="null">Select Town</option>
                                            <option *ngFor="let option of towns" value="option.town">
                                                {{option.town}}
                                            </option>
                                        </select> -->
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>Postcode</label>
                                        <input name="postcode" type="text" pattern="[0-9.]+" maxlength="6" minlength="6" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input id="all_cities" value='<?= json_encode($cities) ?>' hidden>
                    <?php endif; ?>
                    <!-- Amenities -->
                    <?php if ($_steps == 6) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> What amenities do you offer?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p>These are just the amenities guests usually expect, but you can add even more after
                                    you publish.</p>
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="amenity_essentials" type="checkbox" name="amenity_essentials">
                                        <label for="amenity_essentials">
                                            Essentials<br>
                                            <small>Towels, bed sheets, soap, toilet paper, and pillows</small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="amenity_wifi" type="checkbox" name="amenity_wifi">
                                        <label for="amenity_wifi">Wifi</label>
                                    </div>
                                    <div>
                                        <input id="amenity_tv" type="checkbox" name="amenity_tv">
                                        <label for="amenity_tv">TV</label>
                                    </div>
                                    <div>
                                        <input id="amenity_heating" type="checkbox" name="amenity_heating">
                                        <label for="amenity_heating">Heating</label>
                                    </div>
                                    <div>
                                        <input id="amenity_ac" type="checkbox" name="amenity_ac">
                                        <label for="amenity_ac">Air conditioning</label>
                                    </div>
                                    <div>
                                        <input id="amenity_iron" type="checkbox" name="amenity_iron">
                                        <label for="amenity_iron">Iron</label>
                                    </div>
                                    <div>
                                        <input id="amenity_shampoo" type="checkbox" name="amenity_shampoo">
                                        <label for="amenity_shampoo">Shampoo</label>
                                    </div>
                                    <div>
                                        <input id="amenity_hairdryer" type="checkbox" name="amenity_hairdryer">
                                        <label for="amenity_hairdryer">Hairdryer</label>
                                    </div>
                                    <div>
                                        <input id="amenity_breakfast_coffee_tea" type="checkbox" name="amenity_breakfast_coffee_tea">
                                        <label for="amenity_breakfast_coffee_tea">Breakfast, coffee, tea</label>
                                    </div>
                                    <div>
                                        <input id="amenity_desk_workspace" type="checkbox" name="amenity_desk_workspace">
                                        <label for="amenity_desk_workspace">Desk/workspace</label>
                                    </div>
                                    <div>
                                        <input id="amenity_fireplace" type="checkbox" name="amenity_fireplace">
                                        <label for="amenity_fireplace">Fireplace</label>
                                    </div>
                                    <div>
                                        <input id="amenity_wardrobe_drawers" type="checkbox" name="amenity_wardrobe_drawers">
                                        <label for="amenity_wardrobe_drawers">Wardrobe/drawers</label>
                                    </div>
                                    <div>
                                        <input id="amenity_private_entrance" type="checkbox" name="amenity_private_entrance">
                                        <label for="amenity_private_entrance">Private entrance</label>
                                    </div>
                                    <div>
                                        <input id="amenity_sanitization_kit" type="checkbox" name="amenity_sanitization_kit">
                                        <label for="amenity_sanitization_kit">Sanitization Kit</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Safety Amenities -->
                    <?php if ($_steps == 7) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Safety amenities</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="safety_smoke_detector" type="checkbox" name="safety_smoke_detector">
                                        <label for="safety_smoke_detector">
                                            Smoke detector<br>
                                            <small>Check your local laws, which may require a working smoke detector in
                                                every room.</small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_carbon_monoxide_detector" type="checkbox" name="safety_carbon_monoxide_detector">
                                        <label for="safety_carbon_monoxide_detector">
                                            Carbon monoxide detector<br>
                                            <small>Check your local laws, which may require a working carbon monoxide
                                                detector in every
                                                room.</small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_first_aid_kit" type="checkbox" name="safety_first_aid_kit">
                                        <label for="safety_first_aid_kit">
                                            First aid kit
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_fire_extinguisher" type="checkbox" name="safety_fire_extinguisher">
                                        <label for="safety_fire_extinguisher">
                                            Fire extinguisher
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_lock_on_bedroom_door" type="checkbox" name="safety_lock_on_bedroom_door">
                                        <label for="safety_lock_on_bedroom_door">
                                            Lock on bedroom door<br>
                                            <small>Private room can be locked for safety and privacy</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Guest/shared Space -->
                    <?php if ($_steps == 8) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> What spaces can guests use?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p>Include common areas, but don’t add spaces that aren’t on your property.</p>
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="guestspace_kitchen" type="checkbox" name="guestspace_kitchen">
                                        <label for="guestspace_kitchen">Kitchen</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_laundry_washing_machine_dryer" type="checkbox" name="guestspace_laundry_washing_machine_dryer">
                                        <label for="guestspace_laundry_washing_machine_dryer">Laundry – washing machine / Dryer</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_parking" type="checkbox" name="guestspace_parking">
                                        <label for="guestspace_parking">Parking</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_gym" type="checkbox" name="guestspace_gym">
                                        <label for="guestspace_gym">Gym</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_pool" type="checkbox" name="guestspace_pool">
                                        <label for="guestspace_pool">Pool</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_hottub" type="checkbox" name="guestspace_hottub">
                                        <label for="guestspace_hottub">Hot tub</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_prayer_room" type="checkbox" name="guestspace_prayer_room">
                                        <label for="guestspace_prayer_room">Prayer Room - Temple</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_garden" type="checkbox" name="guestspace_garden">
                                        <label for="guestspace_garden">Garden</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_patio" type="checkbox" name="guestspace_patio">
                                        <label for="guestspace_patio">Patio</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_balcony" type="checkbox" name="guestspace_balcony">
                                        <label for="guestspace_balcony">Balcony</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_lobby" type="checkbox" name="guestspace_lobby">
                                        <label for="guestspace_lobby">Lobby</label>
                                    </div>
                                    <div>
                                        <input id="guestspace_terrace" type="checkbox" name="guestspace_terrace">
                                        <label for="guestspace_terrace">Terrace</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Cover and Gallery -->
                    <?php if ($_steps == 9) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> How your listing looks.</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-12">
                                <div class="filescontainer">
                                    <input type="file" name="gallery_files[]" id="image_files" multiple onchange="galleryFiles()" />
                                    <h3>Drag and drop file here</h3>
                                    <h3>or</h3>
                                    <label for="fileDropRef">Browse for file</label>
                                </div>
                            </div>
                            <div style="margin-bottom: 12px;" id="listing_gallery">
                            </div>
                            <!-- <div *ngIf="galleryImagesError" class="text-danger">
                                Please select images and make a default cover image before continue.
                            </div> -->
                        </div>
                    <?php endif; ?>
                    <!-- Description -->
                    <?php if ($_steps == 10) : ?>
                        <!-- Headline -->
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Describe your place to guests</h3>
                        </div>
                        <div class="row with-forms" style="margin-bottom: 20px;">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>
                                            Write a quick summary of your place. You can highlight what’s special about your space, the neighborhood, and how you’ll interact with guests.
                                        </label>
                                        <div style="color:crimson;" id="descriptionError"></div>
                                        <textarea name="description" id="description" rows="5" class="tinymce" required>
                                        </textarea>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-5">
                                        <h3>Want to add more info? (optional)</h3>
                                        <p>Use the additional fields below to share more details.</p>
                                        <label>
                                            <strong>Your Space</strong><br>
                                            Add other details that can help set guests’ expectations for their stay.
                                        </label>
                                        <textarea name="yourspace" rows="5" class="tinymce">
                                        </textarea>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <label>
                                            <strong>Your availability</strong><br>
                                            Let guests know how available you’ll be during their stay. For your safety,
                                            don’t share your
                                            phone number or email until
                                            you have a confirmed reservation.
                                        </label>
                                        <textarea name="yourinteraction" rows="5" class="tinymce">
                                        </textarea>
                                        <!-- <div style="color:crimson;" *ngIf="_listingForm.get('yourinteraction').invalid && (_listingForm.get('yourinteraction').dirty || _listingForm.get('yourinteraction').touched)">
                                            <div *ngIf="_listingForm.get('yourinteraction').errors.minlength">
                                                Min Characters length must be 300.
                                            </div>
                                            <div *ngIf="_listingForm.get('yourinteraction').errors.maxlength">
                                                Max length not above 10,000 Characters.
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-12 mt-5">
                                        <label>
                                            <strong>Your neighborhood</strong><br>
                                            Share what makes your neighborhood special, like a favourite coffee shop, a
                                            park, or a
                                            unique landmark.
                                        </label>
                                        <textarea name="yourneighbourhood" rows="5" class="tinymce">
                                        </textarea>
                                        <!-- <div style="color:crimson;" *ngIf="_listingForm.get('yourneighbourhood').invalid && (_listingForm.get('yourneighbourhood').dirty || _listingForm.get('yourneighbourhood').touched)">
                                            <div *ngIf="_listingForm.get('yourneighbourhood').errors.minlength">
                                                Min Characters length must be 300.
                                            </div>
                                            <div *ngIf="_listingForm.get('yourneighbourhood').errors.maxlength">
                                                Max length not above 10,000 Characters.
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-12 mt-5">
                                        <label>
                                            <strong>Getting around</strong><br>
                                            Add info about getting around your city or neighborhood such as nearby
                                            public transport,
                                            driving tips, or good walking
                                            routes.
                                        </label>
                                        <textarea name="gettingaround" rows="5" class="tinymce">
                                        </textarea>
                                        <!-- <div style="color:crimson;" *ngIf="_listingForm.get('gettingaround').invalid && (_listingForm.get('gettingaround').dirty || _listingForm.get('gettingaround').touched)">
                                            <div *ngIf="_listingForm.get('gettingaround').errors.minlength">
                                                Min Characters length must be 300.
                                            </div>
                                            <div *ngIf="_listingForm.get('gettingaround').errors.maxlength">
                                                Max length not above 10,000 Characters.
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Title -->
                    <?php if ($_steps == 11) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Create a title for your listing.</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>Catch guests attention with a listing title that highlights what makes your place
                                    special.</label>
                                <input class="" name="title" type="text" required>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Review Requirements -->
                    <?php if ($_steps == 12) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Review Hillstay's guest requirements</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>
                                            Hillstay has requirements that all guests must meet before they book.
                                        </label>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-5">
                                        <p>All Hillstay guests must provide:</p>
                                        <div class="list-2">
                                            <ul>
                                                <li>Email address</li>
                                                <li>Confirmed phone number</li>
                                                <li>Payment information</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-5">
                                        <p>Before booking your home, each guest must:</p>
                                        <div class="list-2">
                                            <ul>
                                                <li>Agree to your House Rules</li>
                                                <li>Message you about their trip</li>
                                                <li>Let you know how many guests are coming</li>
                                                <li>Confirm their check-in time if they’re arriving within 2 days</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-5">
                                        <a onclick="_addAdditionalRequirements()" style="cursor:pointer;">
                                            <h4>Add additional requirements</h4>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-5 checkboxes in-row margin-bottom-20" *ngIf="addAdditionalRequirements">
                                        <div>
                                            <input id="requirementsgovtid" type="checkbox" name="requirementsgovtid">
                                            <label for="requirementsgovtid">
                                                Government-issued ID submitted to Hillstay
                                            </label>
                                        </div>
                                        <div>
                                            <input id="requirementspositiveguest" type="checkbox" name="requirementspositiveguest">
                                            <label for="requirementspositiveguest">
                                                Recommended by other hosts and have no negative reviews
                                            </label>
                                        </div>
                                        <small>More requirements can mean fewer reservations.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                    <!-- House Rules -->
                    <?php if ($_steps == 13) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Set house rules for your guests</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>
                                            Guests must agree to your house rules before they book.
                                        </label>
                                    </div>

                                    <hr>
                                    <div class="col-12 mt-5">
                                        <div formGroupName="houserules">
                                            <div class="ruleblocks">
                                                <span class="h4" style="line-height: 55px;">
                                                    Suitable for children (2-12 years)
                                                </span>
                                                <select name="houserules_forchildren" style="width:auto; float:right" required>
                                                    <option value="" selected>Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <!-- <div *ngIf="forchildren.invalid && (forchildren.dirty || forchildren.touched)" class="text-danger h4">Required</div> -->
                                            <hr>
                                            <div class="ruleblocks">
                                                <span class="h4" style="line-height: 55px;">
                                                    Suitable for infants (under 2 years)
                                                </span>
                                                <select name="houserules_forinfants" style="width:auto; float:right" required>
                                                    <option value="" selected>Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <!-- <div *ngIf="forinfants.invalid && (forinfants.dirty || forinfants.touched)" class="text-danger h4">Required</div> -->
                                            <hr>
                                            <div class="ruleblocks">
                                                <span class="h4" style="line-height: 55px;">
                                                    Suitable for pets
                                                </span>
                                                <select name="houserules_forpets" style="width:auto; float:right" required>
                                                    <option value="" selected>Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <!-- <div *ngIf="forpets.invalid && (forpets.dirty || forpets.touched)" class="text-danger h4">Required</div> -->
                                            <hr>
                                            <div class="ruleblocks">
                                                <span class="h4" style="line-height: 55px;">
                                                    Smoking allowed
                                                </span>
                                                <select name="houserules_smokingallowed" style="width:auto; float:right" required>
                                                    <option value="" selected>Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <!-- <div *ngIf="smokingallowed.invalid && (smokingallowed.dirty || smokingallowed.touched)" class="text-danger h4">Required</div> -->
                                            <hr>
                                            <div class="ruleblocks">
                                                <span class="h4" style="line-height: 55px;">
                                                    Events or parties allowed
                                                </span>
                                                <select name="houserules_partiesallowed" style="width:auto; float:right" required>
                                                    <option value="" selected>Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <!-- <div *ngIf="partiesallowed.invalid && (partiesallowed.dirty || partiesallowed.touched)" class="text-danger h4">Required</div> -->
                                        </div>
                                        <hr>
                                        <h4><strong>Additional rules</strong></h4>
                                        <!-- <div class="ruleblocks" style="margin-bottom: 10px;height: 55px;">
                                            <span class="h4" style="line-height: 55px;display: block; width:100%;" id="additionalRulesImputs">
                                                <input type="text" placeholder="input" readonly style="display: inline; width:100%;">
                                                <i class="fa fa-close" onclick="removeRule(i)" style="color:#113814;font-size:32px;line-height: 53px;display: inline;float:right;"></i>
                                            </span>
                                        </div> -->
                                        <div class="ruleblocks" style="margin-bottom: 10px;" id="additionalRulesInputs">
                                        </div>
                                        <div class="addAdditionalRrules">
                                            <input type="text" placeholder="Quiet hours? No shoes in the house" value="" id="additionalRulesValue">
                                            <input type="button" class="addButton" value="ADD" onclick="addAditionalRules()">
                                        </div>
                                        <div class="text-danger h5" id="errorAditionalRules" hidden>You need to enter some rule before add</div>
                                        <hr>
                                        <h4><strong>Details guests must know about your home</strong></h4>
                                        <div formGroupName="housedetails">
                                            <div formGroupName="climbstairs">
                                                <div class="checkboxes in-row">
                                                    <input id="climbstairs" class="detailsChange" type="checkbox" name="housedetails_climbstairs">
                                                    <label for="climbstairs">
                                                        Must climb stairs
                                                    </label>
                                                </div>
                                                <div id="housedetails_climbstairs_desc" hidden>
                                                    <label><strong>Describe the stairs (for example, how many steps)</strong></label>
                                                    <input type="text" id="housedetails_climbstairs_input" name="housedetails_climbstairs_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="noisepotential">
                                                <div class="checkboxes in-row">
                                                    <input id="noisepotential" class="detailsChange" type="checkbox" name="housedetails_noisepotential">
                                                    <label for="noisepotential">
                                                        Potential for noise
                                                    </label>
                                                </div>
                                                <div id="housedetails_noisepotential_desc" hidden>
                                                    <label><strong>Describe the noise and when it’s likely to take place</strong></label>
                                                    <input type="text" id="housedetails_noisepotential_input" name="housedetails_noisepotential_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="petsonproperty">
                                                <div class="checkboxes in-row">
                                                    <input id="petsonproperty" class="detailsChange" type="checkbox" name="housedetails_petsonproperty">
                                                    <label for="petsonproperty">
                                                        Pet(s) live on property
                                                    </label>
                                                </div>
                                                <div id="housedetails_petsonproperty_desc" hidden>
                                                    <label><strong>Describe the pets you have</strong></label>
                                                    <input type="text" id="housedetails_petsonproperty_input" name="housedetails_petsonproperty_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="noparking">
                                                <div class="checkboxes in-row">
                                                    <input id="noparking" class="detailsChange" type="checkbox" name="housedetails_noparking">
                                                    <label for="noparking">
                                                        No parking on property
                                                    </label>
                                                </div>
                                                <div id="housedetails_noparking_desc" hidden>
                                                    <label><strong>Describe the parking situation around your listing</strong></label>
                                                    <input type="text" id="housedetails_noparking_input" name="housedetails_noparking_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="sharedspace">
                                                <div class="checkboxes in-row">
                                                    <input id="sharedspace" class="detailsChange" type="checkbox" name="housedetails_sharedspace">
                                                    <label for="sharedspace">
                                                        Some spaces are shared
                                                    </label>
                                                </div>
                                                <div id="housedetails_sharedspace_desc" hidden>
                                                    <label><strong>Describe the spaces the guests will share</strong></label>
                                                    <input type="text" id="housedetails_sharedspace_input" name="housedetails_sharedspace_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="amenitylimitaion">
                                                <div class="checkboxes in-row">
                                                    <input id="amenitylimitaion" class="detailsChange" type="checkbox" name="housedetails_amenitylimitaion">
                                                    <label for="amenitylimitaion">
                                                        Amenity limitations
                                                    </label>
                                                </div>
                                                <div id="housedetails_amenitylimitaion_desc" hidden>
                                                    <label><strong>Describe an amenity or service that’s limited, such as weak wifi or limited hot water</strong></label>
                                                    <input type="text" id="housedetails_amenitylimitaion_input" name="housedetails_amenitylimitaion_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="surveillance">
                                                <div class="checkboxes in-row">
                                                    <input id="surveillance" class="detailsChange" type="checkbox" name="housedetails_surveillance">
                                                    <label for="surveillance">
                                                        Surveillance or recording devices on property
                                                    </label>
                                                </div>
                                                <div id="housedetails_surveillance_desc" hidden>
                                                    <label>
                                                        <strong>Describe any device that records or sends video, audio or still images. Specify each device’s location and whether it will be on or off.</strong>
                                                    </label>
                                                    <input type="text" id="housedetails_surveillance_input" name="housedetails_surveillance_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="weapons">
                                                <div class="checkboxes in-row">
                                                    <input id="weapons" class="detailsChange" type="checkbox" name="housedetails_weapons">
                                                    <label for="weapons">
                                                        Weapons on property
                                                    </label>
                                                </div>
                                                <div id="housedetails_weapons_desc" hidden>
                                                    <label>
                                                        <strong>Describe any weapons (firearms, airguns, tasers, etc.), their location, and how they’re secured</strong>
                                                    </label>
                                                    <input type="text" id="housedetails_weapons_input" name="housedetails_weapons_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                            <div formGroupName="dangerousaminals">
                                                <div class="checkboxes in-row">
                                                    <input id="dangerousaminals" class="detailsChange" type="checkbox" name="housedetails_dangerousaminals">
                                                    <label for="dangerousaminals">
                                                        Dangerous animals on property
                                                    </label>
                                                </div>
                                                <div id="housedetails_dangerousaminals_desc" hidden>
                                                    <label>
                                                        <strong>Describe any domesticated or wild animals that couldbe a health orsafety risk to guests or other animals</strong>
                                                    </label>
                                                    <input type="text" id="housedetails_dangerousaminals_input" name="housedetails_dangerousaminals_desc" placeholder="Add your description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Instant & Reviewd Booking -->
                    <?php if ($_steps == 14) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Here’s how guests will book with you</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-6 col-xs-12">
                                <div class="row">

                                    <div class="col-12 mt-5">
                                        <select name="instantbooking" id="instantBookingSubmit" onchange="instantReview(this.value)">
                                            <option selected value="0">I want to review every request</option>
                                            <option value="1">Allow instant bookings</option>
                                        </select>
                                        <div class="row" id="reviewedbookingoptions">
                                            <h3>
                                                Are you sure you want all guests to send requests?
                                            </h3>
                                            <small>
                                                Mark the boxes to confirm you understand:
                                            </small>
                                            <div class="checkboxes in-row">
                                                <input class="reviewedCheckboxes" id="reviewedbooking_onedayresponse" type="checkbox" name="reviewedbooking_onedayresponse" required="required">
                                                <label for="reviewedbooking_onedayresponse">
                                                    You’ll only have 24 hours to respond to requests penalty-free
                                                </label>
                                            </div>
                                            <div class="checkboxes in-row">
                                                <input class="reviewedCheckboxes" id="reviewedbooking_ranklower" type="checkbox" name="reviewedbooking_ranklower" required="required">
                                                <label for="reviewedbooking_ranklower">
                                                    Your listing will be ranked lower in search results, so you may get fewer reservations
                                                </label>
                                            </div>
                                            <div class="checkboxes in-row">
                                                <input class="reviewedCheckboxes" id="reviewedbooking_nohostprotection" type="checkbox" name="reviewedbooking_nohostprotection" required="required">
                                                <label for="reviewedbooking_nohostprotection">
                                                    You’ll lose some host protection and controls, including penalty-free cancellations if you’re uncomfortable with a reservation
                                                </label>
                                            </div>
                                        </div>
                                        <div class="instantBooking" style="display:none;">
                                            <span class="instantCol">
                                                <strong class="numberList">1</strong>
                                            </span>
                                            <div class="instantCol" style="padding-left:10px;">
                                                <h4><strong>Qualified guests find your listing</strong></h4>
                                                <p>Anyone who wants to book with you needs to confirm their contact
                                                    information, provide
                                                    payment details, and tell you about their trip.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="instantBooking" style="display:none;">
                                            <span class="instantCol">
                                                <strong class="numberList">2</strong>
                                            </span>
                                            <div class="instantCol" style="padding-left:10px;">
                                                <h4><strong>You set controls for who can book</strong></h4>
                                                <p>To book available dates without having to send a request, guests must
                                                    agree to your
                                                    rules and meet all the requirements
                                                    you set.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="instantBooking" style="display:none;">
                                            <span class="instantCol">
                                                <strong class="numberList">3</strong>
                                            </span>
                                            <div class="instantCol" style="padding-left:10px;">
                                                <h4><strong>Once a guest books, you get notified</strong></h4>
                                                <p>
                                                    You’ll immediately get a confirmation email with information like
                                                    why they’re
                                                    coming, when they’re arriving, and who
                                                    they’re coming with.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="instantBooking" style="display:none;">
                                            <span class="instantCol">
                                                <strong class="numberList"><i class="fa fa-shield"></i></strong>
                                            </span>
                                            <div class="instantCol" style="padding-left:10px;">
                                                <h4><strong>You’re protected throughout</strong></h4>
                                                <p>
                                                    In the rare event that there are issues, Hillstay has you covered with
                                                    24/7 customer
                                                    support, a ₹60,000,000 Host
                                                    Guarantee, and completely penalty-free cancellations if you’re
                                                    uncomfortable with a
                                                    reservation.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                    <!-- Host details -->
                    <?php if ($_steps == 15) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Two questions to get started with your settings</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <div>
                                    <strong>
                                        <h4>Have you rented out your place before?</h4>
                                    </strong>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="rentedbefore" value="0" style="margin:5px;" required>
                                    <label> I’m new to this</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="rentedbefore" value="1" style="margin:5px;" required>
                                    <label> I have</label>
                                </div>
                                <div class="margin-bottom"></div>
                                <div>
                                    <strong>
                                        <h4>How often do you want to have guests?</h4>
                                    </strong>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="neededguests" value="parttime" style="margin:5px;" required>
                                    <label> Part-time</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="neededguests" value="soon" style="margin:5px;" required>
                                    <label> As often as possible</label>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Arrival Notice -->
                    <?php if ($_steps == 16) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> How much notice do you need before a guest arrives?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <div>
                                    <strong>
                                        <h4>Select days for guest arrival</h4>
                                    </strong>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="availabilitydays" value="0" style="margin:5px;" required>
                                    <label> No notice period required</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="availabilitydays" value="1" style="margin:5px;" required>
                                    <label> 1 day</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="availabilitydays" value="2" style="margin:5px;" required>
                                    <label> 2 day</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="availabilitydays" value="3" style="margin:5px;" required>
                                    <label> 3 day</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="availabilitydays" value="7" style="margin:5px;" required>
                                    <label> 7 day</label>
                                </div>
                                <div class="margin-bottom margin-top">
                                    <strong>
                                        <span class="text-primary">Tip:</span> At least 2 days’ notice can help you plan
                                        for a guest’s
                                        arrival, but you might miss out on last-minute trips.
                                    </strong>
                                </div>
                                <div>
                                    <strong>
                                        <h4>When can guests check in?</h4>
                                    </strong>
                                </div>
                                <div class="row" formGroupName="checkintiming">
                                    <div class="col-md-6 col-sm-12">
                                        <label>Check-in:</label>
                                        <select name="checkintiming_from" class="timeSelects" onchange="selectFrom(event)" required>
                                            <option value="0">Flexible</option>
                                            <option value="08">8:00 AM</option>
                                            <option value="09">9:00 AM</option>
                                            <option value="10">10:00 AM</option>
                                            <option value="11">11:00 AM</option>
                                            <option value="12">12:00 PM</option>
                                            <option value="13">1:00 PM</option>
                                            <option value="14">2:00 PM</option>
                                            <option value="15">3:00 PM</option>
                                            <option value="16">4:00 PM</option>
                                            <option value="17">5:00 PM</option>
                                            <option value="18">6:00 PM</option>
                                            <option value="19">7:00 PM</option>
                                            <option value="20">8:00 PM</option>
                                            <option value="21">9:00 PM</option>
                                            <option value="22">10:00 PM</option>
                                            <option value="23">11:00 PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Check-out:</label>
                                        <select name="checkintiming_to" id="guestsCheckoutTimeSelect" class="timeSelects" disabled required>
                                            <option value="0" selected>Flexible</option>
                                            <option value="09" class="guestsCheckoutTime">9:00 AM</option>
                                            <option value="10" class="guestsCheckoutTime">10:00 AM</option>
                                            <option value="11" class="guestsCheckoutTime">11:00 AM</option>
                                            <option value="12" class="guestsCheckoutTime">12:00 PM</option>
                                            <option value="13" class="guestsCheckoutTime">1:00 PM</option>
                                            <option value="14" class="guestsCheckoutTime">2:00 PM</option>
                                            <option value="15" class="guestsCheckoutTime">3:00 PM</option>
                                            <option value="16" class="guestsCheckoutTime">4:00 PM</option>
                                            <option value="17" class="guestsCheckoutTime">5:00 PM</option>
                                            <option value="18" class="guestsCheckoutTime">6:00 PM</option>
                                            <option value="19" class="guestsCheckoutTime">7:00 PM</option>
                                            <option value="20" class="guestsCheckoutTime">8:00 PM</option>
                                            <option value="21" class="guestsCheckoutTime">9:00 PM</option>
                                            <option value="22" class="guestsCheckoutTime">10:00 PM</option>
                                            <option value="23" class="guestsCheckoutTime">11:00 PM</option>
                                            <option value="24" class="guestsCheckoutTime">12:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Advance Booking -->
                    <?php if ($_steps == 17) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Advance Booking</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <div>
                                    <strong>
                                        <h4>How far in advance can guests book?</h4>
                                    </strong>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="-1" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> Any time</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="90" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 3 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="180" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 6 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="270" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 9 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="365" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 1 year in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" value="0" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> Dates unavailable by default</label>
                                </div>
                                <p class="text-primary" id="defaultUnavailableDesc" style="display:none;">
                                    <!-- Your entire calendar will be blocked by default, which means you’ll have to manually unblock dates to get booked. -->
                                    Your entire calendar will be blocked by default, which means you’ll have to manually response to bookings.
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Nights -->
                    <?php if ($_steps == 18) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> How long can guests stay?</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <div class="nightsminmax">
                                    <label>Nights Minimum</label>
                                    <div class="nightsblock">
                                        <input type="number" name="nightsmin" value="0" id="nightsmin" readonly placeholder="No Min">
                                        <div class="buttonz">
                                            <button class="button" type="button" onclick="removeminNight()"><i class="fa fa-minus"></i></button>
                                            <button class="button" type="button" onclick="addminNight()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <label>Nights Maximum</label>
                                    <div class="nightsblock">
                                        <input type="number" name="nightsmax" value="0" id="nightsmax" readonly placeholder="No Max">
                                        <div class="buttonz">
                                            <button class="button" type="button" onclick="removemaxNight()"><i class="fa fa-minus"></i></button>
                                            <button class="button" type="button" onclick="addmaxNight()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Price -->
                    <?php if ($_steps == 19) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Price your space</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <div>
                                    <strong>
                                        <h4>Set up the base price for each night</h4>
                                    </strong>
                                </div>
                                <div>
                                    <strong>Base price</strong>
                                    <label>This will be your default price.</label>
                                    <input type="number" name="price" placeholder="Price per night" required min="0">
                                </div>
                                <!-- <div style="color:crimson;" *ngIf="_listingForm.get('price').invalid && (_listingForm.get('price').dirty || _listingForm.get('price').touched)">
                                    <div *ngIf="_listingForm.get('price').errors.required">
                                        Enter per night charges.
                                    </div>
                                </div> -->
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="cleaning_fee" type="checkbox" name="cleaningFeeRequired">
                                        <label for="cleaning_fee">Do you want to add Cleaning fee?</label>
                                    </div>
                                </div>
                                <div id="showCleaningFee" style="display:none;">
                                    <label>This will be your cleaning fee.</label>
                                    <input type="number" name="cleaning_fee" id="cleaning_fee_input" placeholder="Cleaning Fee">
                                </div>
                                <!-- <div style="color:crimson;" *ngIf="_listingForm.get('cleaning_fee').invalid && (_listingForm.get('cleaning_fee').dirty || _listingForm.get('cleaning_fee').touched)">
                                    <div *ngIf="_listingForm.get('guests').errors.required">
                                        Please enter cleaning fee
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Welcome Offer -->
                    <?php if ($_steps == 20) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Welcome Offer</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <h2>Something special for your first guests</h2>
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="discount" name="welcomeoffer" type="radio" checked value="20">
                                        <label for="discount">
                                            <strong>Offer 20% off to your first guests (RECOMMENDED)</strong><br>
                                            <small>The first 3 guests who book your place will get 20% off the nightly
                                                price. This special offer
                                                can attract new guests and
                                                help you get the 3 reviews you need for a star rating.</small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="no_discount" name="welcomeoffer" type="radio" value="0">
                                        <label for="no_discount">
                                            <strong>Don’t add a special offer</strong><br>
                                            <small>Once you publish your listing, you won’t be able to add this
                                                offer.</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Long Discounts -->
                    <?php if ($_steps == 21) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Length-of-stay prices</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12">
                                <h3 class="mb-3">Encourage travellers to book longer stays by offering a discount.</h3>
                                <div class="mb-4">
                                    <label><strong>Weekly discount</strong></label>
                                    <input type="number" placeholder="21 % off (example)" name="weeklydiscount">
                                    <p>Travellers often search by price. To help increase your chances of getting weekly
                                        stays, try setting a
                                        discount.</p>
                                </div>
                                <div class="mb-4">
                                    <label><strong>Monthly discount</strong></label>
                                    <input type="number" placeholder="49 % off (example)" name="monthlydiscount">
                                    <p>Most travellers staying longer than one month book listings with discounts
                                        greater than 25%.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Payment & Contact Mode -->
                    <?php if ($_steps == 22) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Payout & Contact Info</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <?php if ($payment_methods) { ?>
                                    <h3><strong>Your currect payment methods:-</strong></h3>

                                    <?php foreach ($payment_methods as $method) : ?>
                                        <div class="toggle-wrap">
                                            <span class="trigger "><a href="#"> Method:- <?= $method['method'] ?> <?php if ($method['isDefault']) echo ' <b>Default</b>' ?><i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container">
                                                <?php if ($method['method'] == 'UPI') { ?>
                                                    <p class="form-row form-row-wide">
                                                        UPI-ID:- <?= $method['upi_number'] ?>
                                                    </p>
                                                <?php } else { ?>
                                                    <p class="form-row form-row-wide">
                                                        Name on Bank:- <?= $method['bank_user_name'] ?>
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        Acc Number:- <?= $method['bank_acc_number'] ?>
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        Bank Name:- <?= $method['bank_name'] ?>
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        IFSC:- <?= $method['bank_ifsc'] ?>
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        Branch:- <?= $method['bank_branch'] ?>
                                                    </p>
                                                <?php } ?>
                                                <?php if (!$method['isDefault']) { ?>
                                                    <p class="form-row form-row-wide">
                                                        <button type="button" onclick="set_default_method('<?= $method['id'] ?>')" class="button border margin-top-5">Mark Default</button>
                                                    </p>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <h3><strong>Do you want to set up your payout method now?</strong></h3>
                                    <p>
                                        To get paid, you’ll need to add a payout method. You can add a payout method now or complete this step later – we’ll send you a reminder.
                                    </p>
                                    <p>No Methods found,</p>
                                <?php } ?>
                                <a href="#add_payment_method" class="button sign-in popup-with-zoom-anim mt-2">
                                    <?php if ($payment_methods) {
                                        echo 'Add Another Payment Method';
                                    } else {
                                        echo 'Add Payment Method';
                                    } ?>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <?php if ($contact_info) { ?>
                                    <h3><strong>Your currect contact info:-</strong></h3>

                                    <?php foreach ($contact_info as $contact) : ?>
                                        <div class="toggle-wrap">
                                            <span class="trigger "><a href="#"> Contact:- <?= $contact['contact_person'] ?> <?php if ($contact['isDefault']) echo ' <b>Default</b>' ?><i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container">
                                                <p class="form-row form-row-wide">
                                                    Primary:- <?= $contact['primary_number'] ?>
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    Secondary:- <?= $contact['alternate_number'] ?>
                                                </p>
                                                <?php if (!$contact['isDefault']) { ?>
                                                    <p class="form-row form-row-wide">
                                                        <button type="button" onclick="set_default_contact('<?= $contact['id'] ?>')" class="button border margin-top-5">Make Contact Default</button>
                                                    </p>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <h3><strong>Contact information is compulsory for complete listing</strong></h3>
                                    <p>No Contact information found,</p>
                                <?php } ?>
                                <a href="#add_contact_info" class="button sign-in popup-with-zoom-anim mt-2">
                                    <?php if ($contact_info) {
                                        echo 'Add Another Contact';
                                    } else {
                                        echo 'Add Contact';
                                    } ?>
                                </a>
                            </div>
                            <!-- <div class="col-12"></div> -->
                        </div>
                    <?php endif; ?>
                    <!-- Summary -->
                    <?php if ($_steps == 23) : ?>
                        <div id="add-listing-headline" class="add-listing-headline">
                            <h3><i class="sl sl-icon-doc"></i> Summary & Local Laws</h3>
                        </div>
                        <div class="row with-forms">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <h3 class="pb-4"><strong>Based on your settings, here’s what you could expect</strong>
                                </h3>
                                <div class="mb-4">
                                    <img src="/public/assets/images/231.png">
                                    <div>
                                        <strong>You’re available to host starting after your listing verified</strong>
                                        <p>Lou is planning her trip and thinks your listing is perfect.</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <img src="/public/assets/images/232.png">
                                    <div>
                                        <strong>Guests who have provided their government-issued ID can instantly
                                            book.</strong>
                                        <p>In addition to meeting guest requirements, Lou agrees to your House Rules.
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <img src="/public/assets/images/233.png">
                                    <div>
                                        <strong>Guests send a message with their booking confirmation.</strong>
                                        <p>Lou says she’ll be in town for work and she’d love to stay with you.</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <img src="/public/assets/images/234.png">
                                    <div>
                                        <strong>Welcome guests to your space</strong>
                                        <p>Before Lou arrives, coordinate details like check-in time and key exchange.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                                <div class="mb-4">
                                    <h3><strong>Your local laws and taxes</strong></h3>
                                    <div style="font-size:21px !important;">
                                        <p>
                                            <strong>
                                                Make sure you familiarise yourself with your local laws as well as <br>
                                                <a routerLink="#">Hillstay Nondiscrimination Policy.</a>
                                            </strong>
                                        </p>
                                        <p>
                                            Take a moment to review the local laws that apply to your listing. We want
                                            to make sure you have
                                            everything you need to et off to a great start.
                                        </p>
                                        <p>
                                            Most cities have rules covering home sharing, and the specific codes and
                                            ordinances can appear in
                                            many places (such as zoning, building, licensing or tax codes). In most
                                            places, you must register,
                                            get a permit, or obtain a licence before you list your property or accept
                                            guests. You may also be
                                            responsible for collecting and remitting certain taxes. In some places,
                                            short-term rentals could be
                                            prohibited altogether.
                                        </p>
                                        <p>
                                            Since you are responsible for your own decision to list, you should get
                                            comfortable with the
                                            applicable rules before listing on Hillstay. To get you started, we offer some
                                            helpful resources under
                                            "Your City Laws".<br>
                                            <a routerLink="#"><strong>Learn more about responsible hosting</strong></a>
                                        </p>
                                        <p>
                                            By accepting our Terms of Service and listing your space, you certify that
                                            you will follow
                                            applicable laws and regulations.
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div id="form_navigation" class="form-navigation mt-4" style="min-height:70px;">
                        <?php if ($_steps != 1) : ?>
                            <button onclick="_previousStep()" type="button" class="button float-left">
                                <i class="fa fa-arrow-circle-left"></i> Previous
                            </button>
                        <?php endif; ?>
                        <?php if ($_steps == 1) : ?>
                            <button onclick="window.location.href = '<?= route_to('hosting_listings_all') ?>'" type="button" class="button float-left">
                                <i class="fa fa-arrow-circle-left"></i> Cancel
                            </button>
                        <?php endif; ?>
                        <?php if ($_steps != 23) : ?>
                            <button type="submit" id="formNextButton" class="button" style="float:right;">
                                Next <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        <?php endif; ?>
                        <?php if ($_steps == 23) : ?>
                            <button type="submit" class="button" style="float:right;">
                                Finish <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add_payment_method" class="zoom-anim-dialog mfp-hide">
    <div class="sign-in-form style-2">
        <div class="tabs-container alt">
            <div class="tab-content" id="tab1">
                <form method="post" class="" action="" id="payment_method_form">

                    <p class="form-row form-row-wide">
                        <label for="username">
                            <select data-placeholder="All Categories" name="method" class="chosen-select" onchange="selectPaymentMethod(this)">
                                <option>Select Method</option>
                                <option value="UPI">UPI</option>
                                <option value="BANK">BANK</option>
                            </select>
                        </label>
                    </p>
                    <!-- <input hidden name="paymentMethod" value="true"> -->

                    <div id="UPI_DIV" style="display:none;">
                        <p class="form-row form-row-wide">
                            <label for="upi_number">UPI:
                                <!-- <input class="input-text" type="email" name="upi_number" id="upi_number" pattern="/[a-zA-Z0-9_]{3,}@[a-zA-Z]{3,}/" /> -->
                                <input class="input-text" type="email" name="upi_number" id="upi_number" />
                            </label>
                        </p>
                    </div>
                    <div id="BANK_DIV" style="display:none;">
                        <p class="form-row form-row-wide">
                            <label for="bank_user_name">Name on Bank:
                                <input class="input-text BANK_INPUTS" type="text" name="bank_user_name" id="bank_user_name" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="bank_acc_number">Account Number:
                                <input class="input-text BANK_INPUTS" type="number" minlength="9" maxlength="18" name="bank_acc_number" id="bank_acc_number" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="bank_name">Bank Name:
                                <input class="input-text BANK_INPUTS" type="text" name="bank_name" id="bank_name" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="password">Bank Branch:
                                <input class="input-text BANK_INPUTS" type="text" name="bank_branch" id="bank_branch" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="bank_ifsc">Bank IFSC:
                                <input class="input-text BANK_INPUTS" type="text" minlength="11" maxlength="11" name="bank_ifsc" id="bank_ifsc" />
                            </label>
                        </p>
                    </div>

                    <div class="form-row">
                        <button type="submit" class="button border margin-top-5">Add Method</button>
                        <!-- <button type="button" onclick="submit_payment_method()" class="button border margin-top-5">Add Method</button> -->
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div id="add_contact_info" class="zoom-anim-dialog mfp-hide">
    <div class="sign-in-form style-2">
        <div class="tabs-container alt">
            <div class="tab-content" id="tab1">
                <form method="post" class="" action="" id="payment_method_form">
                    <input hidden value="contact_add" name="contact_add" />

                    <div id="BANK_DIV">
                        <p class="form-row form-row-wide">
                            <label for="contact_person">Contact Person:
                                <input class="input-text BANK_INPUTS" type="text" name="contact_person" id="contact_person" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="primary_number">Primary Number:
                                <input class="input-text BANK_INPUTS" type="tel" minlength="9" maxlength="18" name="primary_number" id="primary_number" />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="alternate_number">Secondary Number:
                                <input class="input-text BANK_INPUTS" type="tel" minlength="9" maxlength="18" name="alternate_number" id="alternate_number" />
                            </label>
                        </p>
                    </div>

                    <div class="form-row">
                        <button type="submit" class="button border margin-top-5">Add Contact</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div id="listing_form_loader" class="preloader" hidden>
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
    <div class="loading-text">Submiting Data</div>
</div>
<style>
    .float-right {
        float: right;
    }

    #add_payment_method,
    #add_contact_info {
        background: #fff;
    }

    #add_payment_method .mfp-close,
    #add_contact_info .mfp-close {
        color: #3d3d3d;
        top: -13px;
        right: 0;
    }

    .timeSelects option:disabled {
        background: #d6d6d6;
    }

    @media only screen and (max-width: 600px) {
        .add-listing-headline {
            display: block;
            justify-content: space-between;
        }

        .add-listing-headline select {
            max-width: 100%;
            margin-bottom: 0;
        }
    }

    @media only screen and (min-width: 601px) {
        .add-listing-headline {
            display: flex;
            justify-content: space-between;
        }

        .add-listing-headline select {
            max-width: 250px;
            margin-bottom: 0;
        }
    }

    .preloader {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    .preloader .sk-chase {
        left: 46%;
        top: 45%;
    }

    .preloader .loading-text {
        left: 39%;
        top: 55%;
    }

    .loading-text {
        height: 40px;
        font-size: 30px;
        position: relative;
        color: #fff;
    }

    .sk-chase {
        width: 40px;
        height: 40px;
        position: relative;
        animation: sk-chase 2.5s infinite linear both;
    }

    .sk-chase-dot {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        animation: sk-chase-dot 2s infinite ease-in-out both;
    }

    .sk-chase-dot:before {
        content: "";
        display: block;
        width: 25%;
        height: 25%;
        background-color: #123815;
        border-radius: 100%;
        animation: sk-chase-dot-before 2s infinite ease-in-out both;
    }

    .sk-chase-dot:nth-child(1) {
        animation-delay: -1.1s;
    }

    .sk-chase-dot:nth-child(2) {
        animation-delay: -1s;
    }

    .sk-chase-dot:nth-child(3) {
        animation-delay: -0.9s;
    }

    .sk-chase-dot:nth-child(4) {
        animation-delay: -0.8s;
    }

    .sk-chase-dot:nth-child(5) {
        animation-delay: -0.7s;
    }

    .sk-chase-dot:nth-child(6) {
        animation-delay: -0.6s;
    }

    .sk-chase-dot:nth-child(1):before {
        animation-delay: -1.1s;
    }

    .sk-chase-dot:nth-child(2):before {
        animation-delay: -1s;
    }

    .sk-chase-dot:nth-child(3):before {
        animation-delay: -0.9s;
    }

    .sk-chase-dot:nth-child(4):before {
        animation-delay: -0.8s;
    }

    .sk-chase-dot:nth-child(5):before {
        animation-delay: -0.7s;
    }

    .sk-chase-dot:nth-child(6):before {
        animation-delay: -0.6s;
    }

    @keyframes sk-chase {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes sk-chase-dot {

        80%,
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes sk-chase-dot-before {
        50% {
            transform: scale(0.4);
        }

        100%,
        0% {
            transform: scale(1);
        }
    }

    .checkboxdiv {
        display: flex;
    }

    .checkboxdiv .checkboxinput {
        border: 0;
        height: 16px;
        width: 16px;
        margin: 5px;
        box-shadow: none;
        padding: 5px;
    }

    .kilometers {
        margin-bottom: 15px;
    }

    .kilometers input[type=number]::-webkit-inner-spin-button,
    .kilometers input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .kilometers input[type=number] {
        padding: 0;
        text-align: center;
        max-width: 50px;
        margin: 0 15px 0 0;
        margin-bottom: 0 !important;
        max-height: 40px;
    }

    .kilometers input {
        -moz-appearance: textfield;
    }

    .kilometers label {
        line-height: 40px;
        display: inline;
    }

    .kilometers div {
        display: inline;
    }

    .kilometers div input {
        display: inline;
    }

    .form-row {
        display: block;
    }

    /* #sign-in-dialog,
    #small-dialog {
        margin: 0;
    } */

    /* #sign-in-dialog {
        padding-bottom: 0;
    } */

    /* .small-dialog-header {
        margin-bottom: 15px;
    } */

    .guestsvalue {
        user-select: none;
    }

    .sleepingblocks:not(:last-child) {
        border-bottom: #dbdbdb solid 1px;
    }

    input.guestsvalue {
        user-select: none !important;
        max-width: 50px !important;
        padding: 0;
        left: 50%;
        margin: auto;
        text-align: center;
        display: inline;
        border: 0;
        font-size: 22px;
        border: none;
        box-shadow: none;
    }

    input.bedvalue {
        user-select: none !important;
    }

    input.bedsbox {
        max-width: 50px;
        display: inline;
        height: 21px;
        padding: 0;
        text-align: center;
        border: none;
        box-shadow: none;
        font-size: 18px;
        user-select: none !important;
    }

    .hiddencontainer input {
        margin-bottom: 0;
        line-height: 28px;
        height: 32px;
        font-size: 28px;
    }

    .filescontainer {
        width: 100%;
        height: 200px;
        padding: 2rem;
        text-align: center;
        border: dashed 1px #979797;
        position: relative;
        margin: 0 auto;
    }

    .filescontainer input {
        opacity: 0;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .filescontainer label {
        color: white;
        width: 183px;
        height: 44px;
        border-radius: 21.5px;
        background-color: #db202f;
        padding: 8px 16px;
        margin: auto;
    }

    .filescontainer h3 {
        font-size: 20px;
        font-weight: 600;
        color: #38424c;
    }

    .fileover {
        animation: shake 1s;
        animation-iteration-count: infinite;
    }

    .files-list {
        margin-top: 1.5rem;
    }

    .files-list .single-file {
        display: flex;
        padding: 0.5rem;
        justify-content: space-between;
        align-items: center;
        border: dashed 1px #979797;
        margin-bottom: 1rem;
        display: flex;
        flex-grow: 1;
    }

    .files-list .single-file img.delete {
        margin-left: 0.5rem;
        cursor: pointer;
        align-self: flex-end;
    }

    .files-list .single-file .name {
        font-size: 14px;
        font-weight: 500;
        color: #353f4a;
        margin: 0;
    }

    .files-list .single-file .size {
        font-size: 12px;
        font-weight: 500;
        color: #a4a4a4;
        margin: 0;
        margin-bottom: 0.25rem;
    }

    .files-list .single-file .info {
        width: 100%;
    }

    .gallery_image_block {
        display: inline-block;
        max-width: 300px;
        max-height: 300px;
        padding: 15px;
    }

    /* Shake animation */
    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    .nightsblock {
        position: relative;
    }

    .nightsblock .buttonz {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
    }

    .buttonz button {
        margin: 0;
        height: 50px;
        border-radius: 0;
        margin-left: 1px;
    }

    .numberList {
        color: #fff;
        background-color: #123815;
        font-size: 32px;
        line-height: 50px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-block;
        margin: auto;
        text-align: center;
    }

    .ruleblocks select {
        margin-bottom: 0 !important;
    }

    .ruleblocks {
        margin-bottom: 10px;
    }

    .addAdditionalRrules input.addButton {
        position: absolute;
        width: 80px;
        border-radius: 3px;
        right: 0;
        margin: 0;
    }

    .addAdditionalRrules {
        position: relative;
    }

    .main-search-input-item {
        padding: 0;
    }

    progress {
        vertical-align: baseline
    }

    @-webkit-keyframes progress-bar-stripes {
        from {
            background-position: 1rem 0
        }

        to {
            background-position: 0 0
        }
    }

    @keyframes progress-bar-stripes {
        from {
            background-position: 1rem 0
        }

        to {
            background-position: 0 0
        }
    }

    .progress {
        display: -ms-flexbox;
        display: flex;
        height: 1rem;
        overflow: hidden;
        font-size: .75rem;
        background-color: #e9ecef;
        border-radius: .25rem
    }

    .progress-bar {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        background-color: #007bff;
        transition: width .6s ease
    }

    @media screen and (prefers-reduced-motion:reduce) {
        .progress-bar {
            transition: none
        }
    }

    .progress-bar-striped {
        background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        background-size: 1rem 1rem
    }

    .progress-bar-animated {
        -webkit-animation: progress-bar-stripes 1s linear infinite;
        animation: progress-bar-stripes 1s linear infinite
    }

    .inputInput {
        display: inline;
    }

    .inputIcon {
        color: #113814;
        font-size: 32px;
        line-height: 53px;
        float: right;
        position: absolute;
        right: 0;
        padding-right: 5px;
        padding-left: 5px;
        cursor: pointer;
        z-index: 999;
    }

    .instantBooking {
        display: flex;
    }
</style>

<?= $this->endSection(); ?>