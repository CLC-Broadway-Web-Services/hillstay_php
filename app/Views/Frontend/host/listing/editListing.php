<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<input id="propertytyperoomsData" value="<?= $listing['propertytyperooms'] ?>" class="d-none">
<input id="propertytypeData" value="<?= $listing['propertytype'] ?>" class="d-none">
<input id="stateData" value="<?= $listing['state'] ?>" class="d-none">
<input id="districtData" value="<?= $listing['district'] ?>" class="d-none">
<input id="bedroomsData" value="<?= $listing['bedrooms'] ?>" class="d-none">
<input id="cleaningFeeRequiredData" value="<?= $listing['cleaningFeeRequired'] ?>" class="d-none">

<div class="row">
    <div class="col-lg-12">
        <div id="listing_form_loader" class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
        <div id="edit_listing" class="margin-bottom-45">

            <div class="style-2">
                <!-- Tabs Navigation -->
                <ul class="tabs-nav">
                    <li class="active"><a href="#basic_information" id="basic_information_tab"><i class="sl sl-icon-list"></i> Basic Informations</a></li>
                    <li><a href="#accomodation" id="accomodation_tab"><i class="sl sl-icon-home"></i> Accomodation</a></li>
                    <li><a href="#location" id="location_tab"><i class="sl sl-icon-map"></i> Location</a></li>
                    <li><a href="#amenities_rules" id="amenities_rules_tab"><i class="sl sl-icon-cup"></i> Amenities & Rules</a></li>
                    <li><a href="#gallery" id="gallery_tab"><i class="sl sl-icon-picture"></i> Gallery</a></li>
                    <li><a href="#booking_settings" id="booking_settings_tab"><i class="sl sl-icon-star"></i> Booking Settings</a></li>
                    <li><a href="#pricing" id="pricing_tab"><i class="sl sl-icon-calculator"></i> Pricing</a></li>
                </ul>

                <!-- Tabs Content -->
                <div class="tabs-container">
                    <!-- Basic Information - steps (11,10,1,2) -->
                    <form class="tab-content" id="basic_information">
                        <input class="d-none" name="form_name" value="basic_information">
                        <div class="row with-forms">

                            <!-- Title -->
                            <div class="col-12">
                                <h5>Title <i class="tip" data-tip-content="Catch guests attention with a listing title that highlights what makes your place special."></i></h5>
                                <input class="search-field" name="title" type="text" value="<?= $listing['title'] ?>" />
                            </div>
                            <!-- DETAILS -->
                            <div class="col-12">
                                <h5>Description <i class="tip" data-tip-content="Catch guests attention with a listing title that highlights what makes your place special."></i></h5>
                                <div style="color:crimson;" id="descriptionError"></div>
                                <textarea name="description" id="description" rows="5" class="tinymce" required><?= $listing['description'] ?></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Your Space <i class="tip" data-tip-content="Add other details that can help set guests’ expectations for their stay."></i></h5>
                                <textarea name="yourspace" rows="5" class="tinymce"><?= $listing['yourspace'] ?></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Your neighborhood <i class="tip" data-tip-content="Share what makes your neighborhood special, like a favourite coffee shop, a park, or a unique landmark."></i></h5>
                                <textarea name="yourneighbourhood" rows="5" class="tinymce"><?= $listing['yourneighbourhood'] ?></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Your availability <i class="tip" data-tip-content="Let guests know how available you’ll be during their stay. For your safety, don’t share your phone number or email until you have a confirmed reservation."></i></h5>
                                <textarea name="yourinteraction" rows="5" class="tinymce"><?= $listing['yourinteraction'] ?></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>Getting Around <i class="tip" data-tip-content="Add info about getting around your city or neighborhood such as nearby public transport, driving tips, or good walking routes."></i><br><small></small></h5>
                                <textarea name="gettingaround" rows="5" class="tinymce"><?= $listing['gettingaround'] ?></textarea>
                            </div>
                            <!-- placekind -->
                            <div class="col-md-6 col-12">
                                <h5>Place Kind <i class="tip" data-tip-content="What kind of place are you listing?"></i></h5>
                                <select class="chosen-select-no-single" id="placekind" name="placekind" required>
                                    <option value="">Select Space</option>
                                    <?php foreach ($selectPlaces as $key => $option) : ?>
                                        <option <?= $listing['placekind'] == $option['value'] ? 'selected' : '' ?> value="<?= $option['value'] ?>">
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- guests -->
                            <div class="col-md-6 col-12">
                                <h5>For Guests <i class="tip" data-tip-content="How many guests can you accomodate?"></i></h5>
                                <select class="chosen-select-no-single" id="guests" name="guests" required>
                                    <option value="">Select Guests</option>
                                    <?php foreach ($selectGuests as $key => $option) : ?>
                                        <option <?= $listing['guests'] == $option['value'] ? 'selected' : '' ?> value="<?= $option['value'] ?>">
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- property type -->
                            <div class="col-md-6 col-12">
                                <div id="propertyTypes" class="d-none"><?= json_encode($propertyType) ?></div>
                                <h5>Property Type <i class="tip" data-tip-content="What kind of place are you listing?"></i></h5>
                                <select class="chosen-select-no-single" id="propertytype" name="propertytype" onchange="onChangeProperty(this.value)" required>
                                    <option value="">Property Type</option>
                                    <?php foreach ($propertyType as $key => $type) : ?>
                                        <option <?= $listing['propertytype'] == $type['value'] ? 'selected' : '' ?> value="<?= $type['value'] ?>">
                                            <?= $type['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="mb-3" id="propertyType_description" hidden></p>
                                <div id="haveRooms" hidden>
                                    <label class="mt-3"><strong>How many total rooms does your property have?</strong></label>
                                    <select class="chosen-select-no-single" name="propertytyperooms" id="propertytyperooms">
                                    </select>
                                </div>
                                <div id="showOffBeat" hidden>
                                    <div class="checkboxes in-row margin-bottom-20">
                                        <div>
                                            <input id="offbeat" <?= $listing['offbeat'] ? 'checked' : '' ?> type="checkbox" name="offbeat">
                                            <label for="offbeat">Is your Property Off-Beat?</label>
                                        </div>
                                    </div>
                                    <div id="offBeatSection" style="max-width:400px;" hidden>
                                        <div class="checkboxes in-row margin-bottom-20">
                                            <div>
                                                <input id="offbeatonroad" <?= $listing['offbeatonroad'] ? 'checked' : '' ?> type="checkbox" name="offbeatonroad">
                                                <label for="offbeatonroad">Is your property onroad?</label>
                                            </div>
                                        </div>
                                        <div formGroupName="offbeatdistance">
                                            <div id="onRoadInput" class="kilometers">
                                                <div>
                                                    <label><strong>Walking Distance</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_walking" value="<?= $listing['offbeat_walking'] ?>" name="offbeat_walking" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Market</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_market" value="<?= $listing['offbeat_market'] ?>" name="offbeat_market" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Medical Facility</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_medical" value="<?= $listing['offbeat_medical'] ?>" name="offbeat_medical" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Town</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_town" value="<?= $listing['offbeat_town'] ?>" name="offbeat_town" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                            <div class="kilometers">
                                                <div>
                                                    <label><strong>Nearest Bus Station</strong></label>
                                                </div>
                                                <div class="float-right">
                                                    <input id="offbeat_busstation" value="<?= $listing['offbeat_busstation'] ?>" name="offbeat_busstation" type="number" maxlength="3">
                                                    <small> in km(s)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- What will guests have? -->
                            <div class="col-md-6 col-12">
                                <h5>What will guests have? <i class="tip" data-tip-content="How many guests can you accomodate?"></i></h5>
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="entireF" type="checkbox" name="entire" <?php if ($listing['placekind'] == 'entire') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="entireF">
                                            <?= $guestsHaveradioList[0]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[0]['description'] ?></small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="privateF" type="checkbox" name="private" <?php if ($listing['placekind'] == 'private') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="privateF">
                                            <?= $guestsHaveradioList[1]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[1]['description'] ?></small>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="sharedF" type="checkbox" name="shared" <?php if ($listing['placekind'] == 'shared') echo 'checked readonly onclick="return false;"' ?>>
                                        <label for="sharedF">
                                            <?= $guestsHaveradioList[2]['name'] ?><br>
                                            <small><?= $guestsHaveradioList[2]['description'] ?></small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>

                        </div>
                    </form>
                    <!-- Accomodation - steps (3,4) -->
                    <form class="tab-content" id="accomodation">
                        <input class="d-none" name="form_name" value="accomodation">
                        <div id="sleep_arrangements" class="d-none"><?= json_encode($sleep_arrangements) ?></div>
                        <div class="row with-forms">
                            <div class="col-md-6 col-sm-12 col-xs-12">

                                <div class="mt-2">
                                    <label><strong>How many rooms can guests use?</strong></label>
                                    <select id="sleep_bedrooms" class="chosen-select-no-single" name="bedrooms" onchange="onSelectBedrooms(this.value)" style="max-width: 350px;">
                                        <?php foreach ($bedrooms as $key => $bedroom) : ?>
                                            <option <?= $listing['bedrooms'] == $bedroom['value'] ? 'selected' : '' ?> value="<?= $bedroom['value'] ?>">
                                                <?= $bedroom['name'] ?> Bedroom
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label><strong>How many bathrooms?</strong></label>
                                    <div class="fs1" style="display:flex; padding:5px;max-width: 450px;">
                                        <div style="width: 50%;">
                                            <strong style="font-weight: normal;">Bathrooms</strong>
                                        </div>
                                        <div class="text-right" style="min-width: 50%;">
                                            <i class="fa fa-minus-circle" style="color:#113814" onclick="decreaseBaths()"></i>
                                            <input readonly class="bedvalue guestsvalue" name="bathrooms" id="total_bathrooms" min="1" value="<?= $listing['bathrooms'] ?>">
                                            <!-- <span class="pl-4 pr-4 guestsvalue" style="display:inline-block;width:85px;text-align:center;">{{bathRooms}}</span> -->
                                            <i class="fa fa-plus-circle" style="color:#113814" onclick="increaseBaths()"></i>
                                        </div>
                                    </div>
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
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- Location - steps (5) -->
                    <form class="tab-content" id="location">
                        <input class="d-none" name="form_name" value="location">
                        <div class="row with-forms">
                            <div class="col-md-4 col-12">
                                <h5>Located <i class="tip" data-tip-content="Short location desciption, State or city etc.."></i></h5>
                                <div class="main-search-input-item location">
                                    <div id="autocomplete-container">
                                        <input id="autocomplete-input" value="<?= $listing['location'] ?>" name="location" autocomplete="off" type="text" placeholder="Location" required>
                                    </div>
                                    <a><i class="fa fa-map-marker"></i></a>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <h5>Street Address</h5>
                                <input name="address_full" type="text" value="<?= $listing['address_full'] ?>" placeholder="House name/number + street/road" required>
                            </div>
                            <div class="col-md-4 col-12">
                                <h5>Flat, suite. (optional)</h5>
                                <input name="flat_no" type="text" value="<?= $listing['flat_no'] ? $listing['flat_no'] : '' ?>" placeholder="Flat, suite, building access code">
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>State</h5>
                                <select class="chosen-select" name="state" onchange="onStateSelect(this.value)" required>
                                    <option disabled selected value="">Select State</option>
                                    <?php foreach ($states as $key => $option) : ?>
                                        <option <?= $listing['state'] == $option['id'] ? 'selected' : '' ?> value="<?= $option['id'] ?>">
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>District</h5>
                                <select class="chosen-select" id="district_cities" name="district" onchange="onDistrictSelect()" disabled required>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>Town</h5>
                                <input id="address_town" name="town" value="<?= $listing['town'] ?>" type="text" disabled required>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>Postcode</h5>
                                <input name="postcode" type="text" value="<?= $listing['postcode'] ?>" pattern="[0-9.]+" maxlength="6" minlength="6" required>
                            </div>

                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>

                            <div id="all_cities" class="d-none"><?= json_encode($cities) ?></div>
                        </div>
                    </form>
                    <!-- Amenities & Guest Space & Rules - steps (6,7,8,13) -->
                    <form class="tab-content" id="amenities_rules">
                        <input class="d-none" name="form_name" value="amenities_rules">
                        <div class="row with-forms pb-4">
                            <div class="col-12">
                                <h5>General Amenities <i class="tip" data-tip-content="These are just the amenities guests usually expect, but you can add even more after you publish."></i></h5>
                                <div class="listing-features checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="amenity_essentials" type="checkbox" <?= $listing['amenity_essentials'] ? 'checked' : '' ?> name="amenity_essentials">
                                        <label for="amenity_essentials">
                                            Essentials <i class="tip" data-tip-content="Towels, bed sheets, soap, toilet paper, and pillows"></i>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="amenity_wifi" type="checkbox" <?= $listing['amenity_wifi'] ? 'checked' : '' ?> name="amenity_wifi">
                                        <label for="amenity_wifi">Wifi</label>
                                    </div>
                                    <div>
                                        <input id="amenity_tv" type="checkbox" <?= $listing['amenity_tv'] ? 'checked' : '' ?> name="amenity_tv">
                                        <label for="amenity_tv">TV</label>
                                    </div>
                                    <div>
                                        <input id="amenity_heating" type="checkbox" <?= $listing['amenity_heating'] ? 'checked' : '' ?> name="amenity_heating">
                                        <label for="amenity_heating">Heating</label>
                                    </div>
                                    <div>
                                        <input id="amenity_ac" type="checkbox" <?= $listing['amenity_ac'] ? 'checked' : '' ?> name="amenity_ac">
                                        <label for="amenity_ac">Air conditioning</label>
                                    </div>
                                    <div>
                                        <input id="amenity_iron" type="checkbox" <?= $listing['amenity_iron'] ? 'checked' : '' ?> name="amenity_iron">
                                        <label for="amenity_iron">Iron</label>
                                    </div>
                                    <div>
                                        <input id="amenity_shampoo" type="checkbox" <?= $listing['amenity_shampoo'] ? 'checked' : '' ?> name="amenity_shampoo">
                                        <label for="amenity_shampoo">Shampoo</label>
                                    </div>
                                    <div>
                                        <input id="amenity_hairdryer" type="checkbox" <?= $listing['amenity_hairdryer'] ? 'checked' : '' ?> name="amenity_hairdryer">
                                        <label for="amenity_hairdryer">Hairdryer</label>
                                    </div>
                                    <div>
                                        <input id="amenity_breakfast_coffee_tea" type="checkbox" <?= $listing['amenity_breakfast_coffee_tea'] ? 'checked' : '' ?> name="amenity_breakfast_coffee_tea">
                                        <label for="amenity_breakfast_coffee_tea">Breakfast, coffee, tea</label>
                                    </div>
                                    <div>
                                        <input id="amenity_desk_workspace" type="checkbox" <?= $listing['amenity_desk_workspace'] ? 'checked' : '' ?> name="amenity_desk_workspace">
                                        <label for="amenity_desk_workspace">Desk/workspace</label>
                                    </div>
                                    <div>
                                        <input id="amenity_fireplace" type="checkbox" <?= $listing['amenity_fireplace'] ? 'checked' : '' ?> name="amenity_fireplace">
                                        <label for="amenity_fireplace">Fireplace</label>
                                    </div>
                                    <div>
                                        <input id="amenity_wardrobe_drawers" type="checkbox" <?= $listing['amenity_wardrobe_drawers'] ? 'checked' : '' ?> name="amenity_wardrobe_drawers">
                                        <label for="amenity_wardrobe_drawers">Wardrobe/drawers</label>
                                    </div>
                                    <div>
                                        <input id="amenity_private_entrance" type="checkbox" <?= $listing['amenity_private_entrance'] ? 'checked' : '' ?> name="amenity_private_entrance">
                                        <label for="amenity_private_entrance">Private entrance</label>
                                    </div>
                                    <div>
                                        <input id="amenity_sanitization_kit" type="checkbox" <?= $listing['amenity_sanitization_kit'] ? 'checked' : '' ?> name="amenity_sanitization_kit">
                                        <label for="amenity_sanitization_kit">Sanitization Kit</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5>Safety Amenities</h5>
                                <div class="listing-features checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="safety_smoke_detector" <?= $listing['safety_smoke_detector'] ? 'checked' : '' ?> type="checkbox" name="safety_smoke_detector">
                                        <label for="safety_smoke_detector">
                                            Smoke detector <i class="tip" data-tip-content="Check your local laws, which may require a working smoke detector in every room."></i>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_carbon_monoxide_detector" <?= $listing['safety_carbon_monoxide_detector'] ? 'checked' : '' ?> type="checkbox" name="safety_carbon_monoxide_detector">
                                        <label for="safety_carbon_monoxide_detector">
                                            Carbon monoxide detector <i class="tip" data-tip-content="Check your local laws, which may require a working carbon monoxide detector in every room."></i>
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_first_aid_kit" <?= $listing['safety_first_aid_kit'] ? 'checked' : '' ?> type="checkbox" name="safety_first_aid_kit">
                                        <label for="safety_first_aid_kit">
                                            First aid kit
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_fire_extinguisher" <?= $listing['safety_fire_extinguisher'] ? 'checked' : '' ?> type="checkbox" name="safety_fire_extinguisher">
                                        <label for="safety_fire_extinguisher">
                                            Fire extinguisher
                                        </label>
                                    </div>
                                    <div>
                                        <input id="safety_lock_on_bedroom_door" <?= $listing['safety_lock_on_bedroom_door'] ? 'checked' : '' ?> type="checkbox" name="safety_lock_on_bedroom_door">
                                        <label for="safety_lock_on_bedroom_door">
                                            Lock on bedroom door <i class="tip" data-tip-content="Private room can be locked for safety and privacy."></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5>Common Areas <i class="tip" data-tip-content="Include common areas, but don’t add spaces that aren’t on your property."></i></h5>
                                <div class="listing-features checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input <?= $listing['guestspace_kitchen'] ? 'checked' : '' ?> id="guestspace_kitchen" type="checkbox" name="guestspace_kitchen">
                                        <label for="guestspace_kitchen">Kitchen</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_laundry_washing_machine_dryer'] ? 'checked' : '' ?> id="guestspace_laundry_washing_machine_dryer" type="checkbox" name="guestspace_laundry_washing_machine_dryer">
                                        <label for="guestspace_laundry_washing_machine_dryer">Laundry – washing machine / Dryer</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_parking'] ? 'checked' : '' ?> id="guestspace_parking" type="checkbox" name="guestspace_parking">
                                        <label for="guestspace_parking">Parking</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_gym'] ? 'checked' : '' ?> id="guestspace_gym" type="checkbox" name="guestspace_gym">
                                        <label for="guestspace_gym">Gym</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_pool'] ? 'checked' : '' ?> id="guestspace_pool" type="checkbox" name="guestspace_pool">
                                        <label for="guestspace_pool">Pool</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_hottub'] ? 'checked' : '' ?> id="guestspace_hottub" type="checkbox" name="guestspace_hottub">
                                        <label for="guestspace_hottub">Hot tub</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_prayer_room'] ? 'checked' : '' ?> id="guestspace_prayer_room" type="checkbox" name="guestspace_prayer_room">
                                        <label for="guestspace_prayer_room">Prayer Room - Temple</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_garden'] ? 'checked' : '' ?> id="guestspace_garden" type="checkbox" name="guestspace_garden">
                                        <label for="guestspace_garden">Garden</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_patio'] ? 'checked' : '' ?> id="guestspace_patio" type="checkbox" name="guestspace_patio">
                                        <label for="guestspace_patio">Patio</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_balcony'] ? 'checked' : '' ?> id="guestspace_balcony" type="checkbox" name="guestspace_balcony">
                                        <label for="guestspace_balcony">Balcony</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_lobby'] ? 'checked' : '' ?> id="guestspace_lobby" type="checkbox" name="guestspace_lobby">
                                        <label for="guestspace_lobby">Lobby</label>
                                    </div>
                                    <div>
                                        <input <?= $listing['guestspace_terrace'] ? 'checked' : '' ?> id="guestspace_terrace" type="checkbox" name="guestspace_terrace">
                                        <label for="guestspace_terrace">Terrace</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <h5>House Rules <i class="tip" data-tip-content="Guests must agree to your house rules before they book."></i></h5>
                                <div class="row with-forms">
                                    <div class="ruleblocks col-md-6 col-12">
                                        <span class="h4" style="line-height: 55px;">
                                            Suitable for children (2-12 years)
                                        </span>
                                        <select name="houserules_forchildren" style="width:auto; float:right" required>
                                            <option value="" selected>Select</option>
                                            <option <?= $listing['houserules_forchildren'] == 'yes' ? 'selected' : '' ?> value="yes">Yes</option>
                                            <option <?= $listing['houserules_forchildren'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="ruleblocks col-md-6 col-12">
                                        <span class="h4" style="line-height: 55px;">
                                            Suitable for infants (under 2 years)
                                        </span>
                                        <select name="houserules_forinfants" style="width:auto; float:right" required>
                                            <option value="" selected>Select</option>
                                            <option <?= $listing['houserules_forinfants'] == 'yes' ? 'selected' : '' ?> value="yes">Yes</option>
                                            <option <?= $listing['houserules_forinfants'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="ruleblocks col-md-6 col-12">
                                        <span class="h4" style="line-height: 55px;">
                                            Suitable for pets
                                        </span>
                                        <select name="houserules_forpets" style="width:auto; float:right" required>
                                            <option value="" selected>Select</option>
                                            <option <?= $listing['houserules_forpets'] == 'yes' ? 'selected' : '' ?> value="yes">Yes</option>
                                            <option <?= $listing['houserules_forpets'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="ruleblocks col-md-6 col-12">
                                        <span class="h4" style="line-height: 55px;">
                                            Smoking allowed
                                        </span>
                                        <select name="houserules_smokingallowed" style="width:auto; float:right" required>
                                            <option value="" selected>Select</option>
                                            <option <?= $listing['houserules_smokingallowed'] == 'yes' ? 'selected' : '' ?> value="yes">Yes</option>
                                            <option <?= $listing['houserules_smokingallowed'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="ruleblocks col-md-6 col-12">
                                        <span class="h4" style="line-height: 55px;">
                                            Events or parties allowed
                                        </span>
                                        <select name="houserules_partiesallowed" style="width:auto; float:right" required>
                                            <option value="" selected>Select</option>
                                            <option <?= $listing['houserules_partiesallowed'] == 'yes' ? 'selected' : '' ?> value="yes">Yes</option>
                                            <option <?= $listing['houserules_partiesallowed'] == 'no' ? 'selected' : '' ?> value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6 col-12">
                                <h5>Extras House Rules <i class="tip" data-tip-content="Details guests must know about your home"></i></h5>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_climbstairs'] ? 'checked' : '' ?> id="climbstairs" class="detailsChange" type="checkbox" name="housedetails_climbstairs">
                                        <label for="climbstairs">
                                            Must climb stairs
                                        </label>
                                    </div>
                                    <div id="housedetails_climbstairs_desc" hidden>
                                        <label><strong>Describe the stairs (for example, how many steps)</strong></label>
                                        <input type="text" id="housedetails_climbstairs_input" value="<?= $listing['housedetails_climbstairs_desc'] ?>" name="housedetails_climbstairs_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_noisepotential'] ? 'checked' : '' ?> id="noisepotential" class="detailsChange" type="checkbox" name="housedetails_noisepotential">
                                        <label for="noisepotential">
                                            Potential for noise
                                        </label>
                                    </div>
                                    <div id="housedetails_noisepotential_desc" hidden>
                                        <label><strong>Describe the noise and when it’s likely to take place</strong></label>
                                        <input type="text" id="housedetails_noisepotential_input" value="<?= $listing['housedetails_noisepotential_desc'] ?>" name="housedetails_noisepotential_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_petsonproperty'] ? 'checked' : '' ?> id="petsonproperty" class="detailsChange" type="checkbox" name="housedetails_petsonproperty">
                                        <label for="petsonproperty">
                                            Pet(s) live on property
                                        </label>
                                    </div>
                                    <div id="housedetails_petsonproperty_desc" hidden>
                                        <label><strong>Describe the pets you have</strong></label>
                                        <input type="text" id="housedetails_petsonproperty_input" value="<?= $listing['housedetails_petsonproperty_desc'] ?>" name="housedetails_petsonproperty_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_noparking'] ? 'checked' : '' ?> id="noparking" class="detailsChange" type="checkbox" name="housedetails_noparking">
                                        <label for="noparking">
                                            No parking on property
                                        </label>
                                    </div>
                                    <div id="housedetails_noparking_desc" hidden>
                                        <label><strong>Describe the parking situation around your listing</strong></label>
                                        <input type="text" id="housedetails_noparking_input" value="<?= $listing['housedetails_noparking_desc'] ?>" name="housedetails_noparking_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_sharedspace'] ? 'checked' : '' ?> id="sharedspace" class="detailsChange" type="checkbox" name="housedetails_sharedspace">
                                        <label for="sharedspace">
                                            Some spaces are shared
                                        </label>
                                    </div>
                                    <div id="housedetails_sharedspace_desc" hidden>
                                        <label><strong>Describe the spaces the guests will share</strong></label>
                                        <input type="text" id="housedetails_sharedspace_input" value="<?= $listing['housedetails_sharedspace_desc'] ?>" name="housedetails_sharedspace_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_amenitylimitaion'] ? 'checked' : '' ?> id="amenitylimitaion" class="detailsChange" type="checkbox" name="housedetails_amenitylimitaion">
                                        <label for="amenitylimitaion">
                                            Amenity limitations
                                        </label>
                                    </div>
                                    <div id="housedetails_amenitylimitaion_desc" hidden>
                                        <label><strong>Describe an amenity or service that’s limited, such as weak wifi or limited hot water</strong></label>
                                        <input type="text" id="housedetails_amenitylimitaion_input" value="<?= $listing['housedetails_amenitylimitaion_desc'] ?>" name="housedetails_amenitylimitaion_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_surveillance'] ? 'checked' : '' ?> id="surveillance" class="detailsChange" type="checkbox" name="housedetails_surveillance">
                                        <label for="surveillance">
                                            Surveillance or recording devices on property
                                        </label>
                                    </div>
                                    <div id="housedetails_surveillance_desc" hidden>
                                        <label>
                                            <strong>Describe any device that records or sends video, audio or still images. Specify each device’s location and whether it will be on or off.</strong>
                                        </label>
                                        <input type="text" id="housedetails_surveillance_input" value="<?= $listing['housedetails_surveillance_desc'] ?>" name="housedetails_surveillance_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_weapons'] ? 'checked' : '' ?> id="weapons" class="detailsChange" type="checkbox" name="housedetails_weapons">
                                        <label for="weapons">
                                            Weapons on property
                                        </label>
                                    </div>
                                    <div id="housedetails_weapons_desc" hidden>
                                        <label>
                                            <strong>Describe any weapons (firearms, airguns, tasers, etc.), their location, and how they’re secured</strong>
                                        </label>
                                        <input type="text" id="housedetails_weapons_input" value="<?= $listing['housedetails_weapons_desc'] ?>" name="housedetails_weapons_desc" placeholder="Add your description">
                                    </div>
                                </div>
                                <div class="ruleblocks">
                                    <div class="checkboxes in-row">
                                        <input <?= $listing['housedetails_dangerousaminals'] ? 'checked' : '' ?> id="dangerousaminals" class="detailsChange" type="checkbox" name="housedetails_dangerousaminals">
                                        <label for="dangerousaminals">
                                            Dangerous animals on property
                                        </label>
                                    </div>
                                    <div id="housedetails_dangerousaminals_desc" hidden>
                                        <label>
                                            <strong>Describe any domesticated or wild animals that couldbe a health orsafety risk to guests or other animals</strong>
                                        </label>
                                        <input type="text" id="housedetails_dangerousaminals_input" value="<?= $listing['housedetails_dangerousaminals_desc'] ?>" name="housedetails_dangerousaminals_desc" placeholder="Add your description">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div id="additionalRulesData" class="d-none"><?= json_encode($listing['additoinal_rules']) ?></div>
                                <h5>Additional Rules</h5>
                                <div class="ruleblocks" style="margin-bottom: 10px;" id="additionalRulesInputs">
                                </div>
                                <div class="addAdditionalRrules">
                                    <input type="text" placeholder="Quiet hours? No shoes in the house" value="" id="additionalRulesValue">
                                    <input type="button" class="addButton" value="ADD" onclick="addAditionalRules()">
                                </div>
                                <div class="text-danger h5" id="errorAditionalRules" hidden>You need to enter some rule before add</div>
                            </div>
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- Gallery - steps (9) -->
                    <form class="tab-content" id="gallery" enctype="multipart/form-data">
                        <input class="d-none" name="form_name" value="gallery">
                        <div class="row">
                            <input class="d-none" id="listing_id" value="<?= $listing['listing_id'] ?>" name="listing_id">
                            <div class="col-md-3 col-sm-6 col-12 mb-3">
                                <div class="card gallery-item">
                                    <img src="/public/assets/images/placeholder.jpg" class="card-img-top" id="gallery_image_image" onclick="onClickImage()">
                                    <input class="d-none" type="file" name="image" id="gallery_image" onchange="imagePreview(this, 'gallery_image', '/public/assets/images/placeholder.jpg')">
                                    <small id="gallery_image_error" class="text-danger"></small>
                                    <input class="d-none" name="gid" id="gallery_id" value="0">
                                    <div class="card-body">
                                        <input type="text" class="form-control form-control-sm" name="caption" id="gallery_caption" placeholder="Caption">
                                        <div class="btn-group btn-group-sm w-100" role="group" aria-label="Basic example">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-danger" id="gallery_reset_button" onclick="resetGalleryForm()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($listing['gallery'] as $key => $gallery) : ?>
                                <div class="col-md-3 col-sm-6 col-12 mb-3" id="gallery_image_<?= $key ?>">
                                    <div class="card gallery-item">
                                        <div class="d-none" id="gallery_image_div_<?= $key ?>"><?= json_encode($gallery) ?></div>
                                        <img src="<?= '/' . $gallery['image'] ?>" class="card-img-top">
                                        <?php if ($gallery['isCover']) : ?>
                                            <div class="listing-badge now-open">Cover</div>
                                        <?php endif; ?>
                                        <span class="edit-icon">
                                            <i class="sl sl-icon-pencil" onclick="editGalleryImage('gallery_image_div_<?= $key ?>')"></i>
                                            <?php if (!$gallery['isCover']) : ?>
                                                <i class="sl sl-icon-trash" onclick="deleteGalleryImage('gallery_image_<?= $key ?>', <?= $gallery['gid'] ?>, '<?= $gallery['image'] ?>')"></i>
                                            <?php endif; ?>
                                        </span>
                                        <div class="card-body">
                                            <?= $gallery['caption'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- Booking Settings - steps (12,14,16,17,18) -->
                    <form class="tab-content" id="booking_settings">
                        <input class="d-none" name="form_name" value="booking_settings">
                        <div class="row with-forms checkboxes in-row">
                            <div class="col-md-6 col-12">
                                <input id="requirementsgovtid" type="checkbox" <?= $listing['requirementsgovtid'] ? 'checked' : '' ?> name="requirementsgovtid">
                                <label for="requirementsgovtid">
                                    Government-issued ID submitted to Hillstay
                                </label>
                            </div>
                            <div class="col-md-6 col-12">
                                <input id="requirementspositiveguest" type="checkbox" <?= $listing['requirementspositiveguest'] ? 'checked' : '' ?> name="requirementspositiveguest">
                                <label for="requirementspositiveguest">
                                    Recommended by other hosts and have no negative reviews
                                </label>
                            </div>
                            <hr class="mt-5">
                            <div class="col-md-6 col-12">
                                <h5>
                                    Instant or Reviewd Booking !<br>
                                    <small>Here’s how guests will book with you !</small>
                                </h5>
                                <select class="chosen-select-no-single" name="instantbooking" id="instantBookingSubmit" onchange="instantReview(this.value)">
                                    <option <?= $listing['instantbooking'] ? '' : 'selected' ?> value="0">I want to review every request</option>
                                    <option <?= $listing['instantbooking'] ? 'selected' : '' ?> value="1">Allow instant bookings</option>
                                </select>
                                <div id="reviewedbookingoptions">
                                    <h3>Are you sure you want all guests to send requests?</h3>
                                    <small>Mark the boxes to confirm you understand:</small>
                                    <div class="checkboxes in-row">
                                        <input class="reviewedCheckboxes" id="reviewedbooking_onedayresponse" type="checkbox" <?= $listing['reviewedbooking_onedayresponse'] ? 'checked' : '' ?> name="reviewedbooking_onedayresponse" required="required">
                                        <label for="reviewedbooking_onedayresponse">
                                            You’ll only have 24 hours to respond to requests penalty-free
                                        </label>
                                    </div>
                                    <div class="checkboxes in-row">
                                        <input class="reviewedCheckboxes" id="reviewedbooking_ranklower" type="checkbox" <?= $listing['reviewedbooking_ranklower'] ? 'checked' : '' ?> name="reviewedbooking_ranklower" required="required">
                                        <label for="reviewedbooking_ranklower">
                                            Your listing will be ranked lower in search results, so you may get fewer reservations
                                        </label>
                                    </div>
                                    <div class="checkboxes in-row">
                                        <input class="reviewedCheckboxes" id="reviewedbooking_nohostprotection" type="checkbox" <?= $listing['reviewedbooking_nohostprotection'] ? 'checked' : '' ?> name="reviewedbooking_nohostprotection" required="required">
                                        <label for="reviewedbooking_nohostprotection">
                                            You’ll lose some host protection and controls, including penalty-free cancellations if you’re uncomfortable with a reservation
                                        </label>
                                    </div>
                                </div>
                                <div id="instantBookingoptions">
                                    <div class="instantBooking">
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
                                    <div class="instantBooking">
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
                                    <div class="instantBooking">
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
                                    <div class="instantBooking">
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
                            <div class="col-md-6 col-12">
                                <h5>
                                    Guests Arrival Notice<br>
                                    <small>How much notice do you need before a guest arrives?</small>
                                </h5>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $listing['availabilitydays'] == 0 ? 'checked' : '' ?> type="radio" id="availabilitydays0" name="availabilitydays" value="0" required>
                                    <label class="form-check-label" for="availabilitydays0"> No notice period required</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $listing['availabilitydays'] == 1 ? 'checked' : '' ?> type="radio" id="availabilitydays1" name="availabilitydays" value="1" required>
                                    <label class="form-check-label" for="availabilitydays1"> 1 day</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $listing['availabilitydays'] == 2 ? 'checked' : '' ?> type="radio" id="availabilitydays2" name="availabilitydays" value="2" required>
                                    <label class="form-check-label" for="availabilitydays2"> 2 day</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $listing['availabilitydays'] == 3 ? 'checked' : '' ?> type="radio" id="availabilitydays3" name="availabilitydays" value="3" required>
                                    <label class="form-check-label" for="availabilitydays3"> 3 day</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $listing['availabilitydays'] == 7 ? 'checked' : '' ?> type="radio" id="availabilitydays7" name="availabilitydays" value="7" required>
                                    <label class="form-check-label" for="availabilitydays7"> 7 day</label>
                                </div>
                                <div class="mt-4 mb-4">
                                    <strong>
                                        <span class="text-primary">Tip:</span> At least 2 days’ notice can help you plan
                                        for a guest’s
                                        arrival, but you might miss out on last-minute trips.
                                    </strong>
                                </div>
                                <h5>When can guests check in?</h5>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h6>Check-in:</h6>
                                        <select class="chosen-select-no-single timeSelects" name="checkintiming_from" onchange="selectFrom(this.value)" required>
                                            <option value="0" <?= $listing['checkintiming_to'] == '0' ? 'selected' : '' ?>>Flexible</option>
                                            <option value="08" <?= $listing['checkintiming_to'] == '08' ? 'selected' : '' ?>>8:00 AM</option>
                                            <option value="09" <?= $listing['checkintiming_to'] == '09' ? 'selected' : '' ?>>9:00 AM</option>
                                            <option value="10" <?= $listing['checkintiming_to'] == '10' ? 'selected' : '' ?>>10:00 AM</option>
                                            <option value="11" <?= $listing['checkintiming_to'] == '11' ? 'selected' : '' ?>>11:00 AM</option>
                                            <option value="12" <?= $listing['checkintiming_to'] == '12' ? 'selected' : '' ?>>12:00 PM</option>
                                            <option value="13" <?= $listing['checkintiming_to'] == '13' ? 'selected' : '' ?>>1:00 PM</option>
                                            <option value="14" <?= $listing['checkintiming_to'] == '14' ? 'selected' : '' ?>>2:00 PM</option>
                                            <option value="15" <?= $listing['checkintiming_to'] == '15' ? 'selected' : '' ?>>3:00 PM</option>
                                            <option value="16" <?= $listing['checkintiming_to'] == '16' ? 'selected' : '' ?>>4:00 PM</option>
                                            <option value="17" <?= $listing['checkintiming_to'] == '17' ? 'selected' : '' ?>>5:00 PM</option>
                                            <option value="18" <?= $listing['checkintiming_to'] == '18' ? 'selected' : '' ?>>6:00 PM</option>
                                            <option value="19" <?= $listing['checkintiming_to'] == '19' ? 'selected' : '' ?>>7:00 PM</option>
                                            <option value="20" <?= $listing['checkintiming_to'] == '20' ? 'selected' : '' ?>>8:00 PM</option>
                                            <option value="21" <?= $listing['checkintiming_to'] == '21' ? 'selected' : '' ?>>9:00 PM</option>
                                            <option value="22" <?= $listing['checkintiming_to'] == '22' ? 'selected' : '' ?>>10:00 PM</option>
                                            <option value="23" <?= $listing['checkintiming_to'] == '23' ? 'selected' : '' ?>>11:00 PM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <h6>Check-out:</h6>
                                        <select class="chosen-select-no-single timeSelects" name="checkintiming_to" id="guestsCheckoutTimeSelect" disabled required>
                                            <option value="0" <?= $listing['checkintiming_to'] == '0' ? 'selected' : '' ?>>Flexible</option>
                                            <option value="09" <?= $listing['checkintiming_to'] == '09' ? 'selected' : '' ?> class="guestsCheckoutTime">9:00 AM</option>
                                            <option value="10" <?= $listing['checkintiming_to'] == '10' ? 'selected' : '' ?> class="guestsCheckoutTime">10:00 AM</option>
                                            <option value="11" <?= $listing['checkintiming_to'] == '11' ? 'selected' : '' ?> class="guestsCheckoutTime">11:00 AM</option>
                                            <option value="12" <?= $listing['checkintiming_to'] == '12' ? 'selected' : '' ?> class="guestsCheckoutTime">12:00 PM</option>
                                            <option value="13" <?= $listing['checkintiming_to'] == '13' ? 'selected' : '' ?> class="guestsCheckoutTime">1:00 PM</option>
                                            <option value="14" <?= $listing['checkintiming_to'] == '14' ? 'selected' : '' ?> class="guestsCheckoutTime">2:00 PM</option>
                                            <option value="15" <?= $listing['checkintiming_to'] == '15' ? 'selected' : '' ?> class="guestsCheckoutTime">3:00 PM</option>
                                            <option value="16" <?= $listing['checkintiming_to'] == '16' ? 'selected' : '' ?> class="guestsCheckoutTime">4:00 PM</option>
                                            <option value="17" <?= $listing['checkintiming_to'] == '17' ? 'selected' : '' ?> class="guestsCheckoutTime">5:00 PM</option>
                                            <option value="18" <?= $listing['checkintiming_to'] == '18' ? 'selected' : '' ?> class="guestsCheckoutTime">6:00 PM</option>
                                            <option value="19" <?= $listing['checkintiming_to'] == '19' ? 'selected' : '' ?> class="guestsCheckoutTime">7:00 PM</option>
                                            <option value="20" <?= $listing['checkintiming_to'] == '20' ? 'selected' : '' ?> class="guestsCheckoutTime">8:00 PM</option>
                                            <option value="21" <?= $listing['checkintiming_to'] == '21' ? 'selected' : '' ?> class="guestsCheckoutTime">9:00 PM</option>
                                            <option value="22" <?= $listing['checkintiming_to'] == '22' ? 'selected' : '' ?> class="guestsCheckoutTime">10:00 PM</option>
                                            <option value="23" <?= $listing['checkintiming_to'] == '23' ? 'selected' : '' ?> class="guestsCheckoutTime">11:00 PM</option>
                                            <option value="24" <?= $listing['checkintiming_to'] == '25' ? 'selected' : '' ?> class="guestsCheckoutTime">12:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-5">
                            <div class="col-md-6 col-12">
                                <h5>
                                    Advance Booking<br>
                                    <small>How far in advance can guests book?</small>
                                </h5>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" <?= $listing['advancebooking'] == '-1' ? 'checked' : '' ?> value="-1" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> Any time</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" <?= $listing['advancebooking'] == '90' ? 'checked' : '' ?> value="90" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 3 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" <?= $listing['advancebooking'] == '180' ? 'checked' : '' ?> value="180" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 6 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" <?= $listing['advancebooking'] == '270' ? 'checked' : '' ?> value="270" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 9 months in advance</label>
                                </div>
                                <div style="display: flex;">
                                    <input type="radio" name="advancebooking" <?= $listing['advancebooking'] == '365' ? 'checked' : '' ?> value="365" style="margin:5px;" onchange="advanceBookingChange(this)">
                                    <label> 1 year in advance</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h5>How long can guests stay?</h5>
                                <div class="nightsminmax">
                                    <span>Nights Minimum</span>
                                    <div class="nightsblock">
                                        <input type="number" name="nightsmin" value="<?= $listing['nightsmin'] ?>" id="nightsmin" readonly placeholder="No Min">
                                        <div class="buttonz">
                                            <button class="button" type="button" onclick="removeminNight()"><i class="fa fa-minus"></i></button>
                                            <button class="button" type="button" onclick="addminNight()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <span>Nights Maximum</span>
                                    <div class="nightsblock">
                                        <input type="number" name="nightsmax" value="<?= $listing['nightsmax'] ?>" id="nightsmax" readonly placeholder="No Max">
                                        <div class="buttonz">
                                            <button class="button" type="button" onclick="removemaxNight()"><i class="fa fa-minus"></i></button>
                                            <button class="button" type="button" onclick="addmaxNight()"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- Pricing - steps (19,20,21) -->
                    <form class="tab-content" id="pricing">
                        <input class="d-none" name="form_name" value="pricing">
                        <div class="row with-forms">
                            <div class="col-md-6 col-12">
                                <h5>
                                    Base price<br>
                                    <small>This will be your default price.</small>
                                </h5>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="number" name="price" placeholder="Price per night" value="<?= $listing['price'] ?>" required min="0">
                                <div class="checkboxes in-row margin-bottom-20">
                                    <div>
                                        <input id="cleaning_fee" type="checkbox" <?= $listing['cleaningFeeRequired'] ? 'checked' : '' ?> name="cleaningFeeRequired">
                                        <label for="cleaning_fee">Do you want to add Cleaning fee?</label>
                                    </div>
                                </div>
                                <div id="showCleaningFee" style="display:none;">
                                    <label>This will be your cleaning fee.</label>
                                    <input type="number" name="cleaning_fee" id="cleaning_fee_input" value="<?= $listing['cleaning_fee'] ? $listing['cleaning_fee'] : 0 ?>" placeholder="Cleaning Fee">
                                </div>
                            </div>
                            <hr class="mt-5">
                            <div class="col-12">
                                <h5>
                                    Welcome Offer<br>
                                    <small>Something special for your first guests</small>
                                </h5>
                                <div class="row checkboxes in-row">
                                    <div class="col-md-6 col-12">
                                        <input id="discount" name="welcomeoffer" <?= $listing['welcomeoffer'] == '20' ? 'checked' : '' ?> type="radio" checked value="20">
                                        <label for="discount">
                                            <strong>Offer 20% off to your first guests (RECOMMENDED)</strong><br>
                                            <small>The first 3 guests who book your place will get 20% off the nightly
                                                price. This special offer
                                                can attract new guests and
                                                help you get the 3 reviews you need for a star rating.</small>
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <input id="no_discount" name="welcomeoffer" <?= $listing['welcomeoffer'] == '0' ? 'checked' : '' ?> type="radio" value="0">
                                        <label for="no_discount">
                                            <strong>Don’t add a special offer</strong><br>
                                            <small>Once you publish your listing, you won’t be able to add this
                                                offer.</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-5">
                            <div class="col-12">
                                <h5>
                                    Length-of-stay prices<br>
                                    <small>Encourage travellers to book longer stays by offering a discount.</small>
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label><strong>Weekly discount</strong></label>
                                        <input type="number" placeholder="21 % off (example)" value="<?= $listing['weeklydiscount'] ? $listing['weeklydiscount'] : '' ?>" name="weeklydiscount">
                                        <p>Travellers often search by price. To help increase your chances of getting weekly
                                            stays, try setting a
                                            discount.</p>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label><strong>Monthly discount</strong></label>
                                        <input type="number" placeholder="49 % off (example)" value="<?= $listing['monthlydiscount'] ? $listing['monthlydiscount'] : '' ?>" name="monthlydiscount">
                                        <p>Most travellers staying longer than one month book listings with discounts
                                            greater than 25%.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end formsFooterUpdate">
                                <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="row text-end mb-3 mt-3">
                <div class="col-12 text-end">
                    <button type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </div> -->
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
<script type="text/html" id="sleepBlock">
    <div style="display: flex;" class="custom_sleep_arrangement_box">
        <div style="width: 50%;">
            <span style="font-size:25px;">Room 1</span><br>
            <span style="font-size:18px;">
                <!-- <input class="d-none" value="lsaid_x" name="accomodation[_accindex_][lsaid]"> -->
                <input class="d-none" value="<?= $listing['listing_id'] ?>" name="accomodation[_accindex_][listing_id]">
                <!--oldlsaid-->
                total beds <input name="accomodation[_accindex_][total_beds]" id="sleepbeds_x1" value="total_beds_x" class="bedsbox" readonly required min="1">
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
                    <input id="double_x1" class="bedvalue guestsvalue" value="double_bed_x" readonly name="accomodation[_accindex_][double_bed]">
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
                    <input id="king_x1" class="bedvalue guestsvalue" value="king_bed_x" readonly name="accomodation[_accindex_][king_bed]">
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
                    <input id="queen_x1" class="bedvalue guestsvalue" value="queen_bed_x" readonly name="accomodation[_accindex_][queen_bed]">
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
                    <input id="single_x1" class="bedvalue guestsvalue" value="single_bed_x" readonly name="accomodation[_accindex_][single_bed]">
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
                    <input id="sofabed_x1" class="bedvalue guestsvalue" value="floormat_bed_x" readonly name="accomodation[_accindex_][sofa_bed]">
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
                    <input id="bunkbed_x1" class="bedvalue guestsvalue" value="sofa_bed_x" readonly name="accomodation[_accindex_][bunk_bed]">
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
                    <input id="hammock_x1" class="bedvalue guestsvalue" value="bunk_bed_x" readonly name="accomodation[_accindex_][hammock_bed]">
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
                    <input id="floormat_x1" class="bedvalue guestsvalue" value="hammock_bed_x" readonly name="accomodation[_accindex_][floormat_bed]">
                </span>
                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('floormat', '_x1')"></i>
            </div>
        </div>
    </div>
</script>
<?= $this->endSection(); ?>

<?= $this->section('footerScripts'); ?>

<?= $this->endSection(); ?>