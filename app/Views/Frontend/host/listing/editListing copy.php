<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<style>
    @media only screen and (max-width: 1024px) and (min-width: 501px) {
        .listing-features {
            columns: 2;
            -webkit-columns: 2;
            -moz-columns: 2;
        }
    }

    @media only screen and (max-width: 500px) {
        .listing-features {
            columns: 1;
            -webkit-columns: 1;
            -moz-columns: 1;
        }
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div id="add-listing" class="margin-bottom-45">

            <div class="style-2">
                <!-- Tabs Navigation -->
                <ul class="tabs-nav">
                    <li class="active"><a href="#tab1a"><i class="sl sl-icon-pin"></i> First</a></li>
                    <li><a href="#tab2a"><i class="sl sl-icon-badge"></i> Second</a></li>
                    <li><a href="#tab3a"><i class="sl sl-icon-bubbles"></i> Third</a></li>
                </ul>

                <!-- Tabs Content -->
                <div class="tabs-container">
                    <div class="tab-content" id="tab1a">
                        Lorem ipsum pharetra lorem felis. Aliquam egestas consectetur elementum class aptentea taciti sociosqu ad litora torquent perea conubia nostra lorem consectetur adipiscing elit. Donec vestibulum justo a diam ultricies pellentesque.
                    </div>

                    <div class="tab-content" id="tab2a">Aenean dolor mi, luctus et laoreet hendrerit, condimentum faucibus mi. Nam et sem eros. Sed sed eros nec massa pellentesque accumsan in nec magna. Donec sollicitudin enim nec justo mollis bibendum. Nulla eleifend mollis velit. Ut sed risus eget metus egestas sagittis. Etiam vestibulum interdum turpis.</div>

                    <div class="tab-content" id="tab3a">Suspendisse ut laoreet massa. Etiam vel dolor eu quam varius tempor eu eu mi. Duis auctor interdum ligula ut faucibus. Vivamus lorem ipsum dolor sit amet in tincidunt augue. Aenean at ligula justo, sed gravida metus. </div>
                </div>
            </div>
            <!-- Basic Information - steps (11,10,1,2) -->
            <form class="add-listing-section toggle-wrap" id="basicInformationForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-list"></i> Basic Informations</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">

                    <!-- Row -->
                    <div class="row with-forms">

                        <!-- Title -->
                        <div class="col-12">
                            <h5>Title <i class="tip" data-tip-content="Catch guests attention with a listing title that highlights what makes your place special."></i></h5>
                            <input class="search-field" type="text" value="<?= $listing['title'] ?>" />
                        </div>
                        <!-- DETAILS -->
                        <div class="col-12">
                            <h5>Description <i class="tip" data-tip-content="Catch guests attention with a listing title that highlights what makes your place special."></i></h5>
                            <div style="color:crimson;" id="descriptionError"></div>
                            <textarea name="description" id="description" rows="5" class="tinymce" required><?= $listing['description'] ?></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5>Your Space <br><small>Add other details that can help set guests’ expectations for their stay.</small></h5>
                            <textarea name="yourspace" rows="5" class="tinymce"><?= $listing['yourspace'] ?></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5>Your neighborhood <br><small>Share what makes your neighborhood special, like a favourite coffee shop, a park, or a unique landmark.</small></h5>
                            <textarea name="yourneighbourhood" rows="5" class="tinymce"><?= $listing['yourneighbourhood'] ?></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5>Your availability <br><small>Let guests know how available you’ll be during their stay. For your safety, don’t share your phone number or email until you have a confirmed reservation.</small></h5>
                            <textarea name="yourinteraction" rows="5" class="tinymce"><?= $listing['yourinteraction'] ?></textarea>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5>Getting Around <br><small>Add info about getting around your city or neighborhood such as nearby public transport, driving tips, or good walking routes.</small></h5>
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
                            <input id="propertyTypes" value='<?= json_encode($propertyType) ?>' readonly hidden>
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
                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Accomodation - steps (3,4) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="accomodationForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-home"></i> Accomodation</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <div id="sleep_arrangements" class="d-none"><?= json_encode($sleep_arrangements) ?></div>
                    <!-- Row -->
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
                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Location - steps (5) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="locationForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-map"></i> Location</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <!-- Row -->
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
                            <input name="flat_no" type="text" value="<?= $listing['flat_no'] ?>" placeholder="Flat, suite, building access code">
                        </div>
                        <div class="col-12 col-md-3">
                            <h5>State</h5>
                            <select class="chosen-select-no-single" name="state" onchange="onStateSelect(this.value)" required>
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
                            <select class="chosen-select-no-single" id="district_cities" name="district" onchange="onDistrictSelect()" disabled required>
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

                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                        <div id="all_cities" class="d-none"><?= json_encode($cities) ?></div>
                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Amenities & Guest Space & Rules - steps (6,7,8,13) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="amenitiesForm">
                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-cup"></i> Amenities & Rules</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
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
                    </div>
                </div>
            </form>

            <!-- Gallery - steps (9) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="galleryForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-picture"></i> Gallery</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <!-- Title -->
                    <div class="row with-forms">
                        <div class="col-md-12">
                            <h5>Listing Title <i class="tip" data-tip-content="Name of your business"></i></h5>
                            <input class="search-field" type="text" value="" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">

                        <!-- Status -->
                        <div class="col-md-6">
                            <h5>Category</h5>
                            <select class="chosen-select-no-single">
                                <option label="blank">Select Category</option>
                                <option>Eat & Drink</option>
                                <option>Shops</option>
                                <option>Hotels</option>
                                <option>Restaurants</option>
                                <option>Fitness</option>
                                <option>Events</option>
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>Keywords <i class="tip" data-tip-content="Maximum of 15 keywords related with your business"></i></h5>
                            <input type="text" placeholder="Keywords should be separated by commas">
                        </div>
                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Booking Settings - steps (12,14,16,17,18) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="bookingSettingsForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-star"></i> Booking Settings</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <!-- Title -->
                    <div class="row with-forms">
                        <div class="col-md-12">
                            <h5>Listing Title <i class="tip" data-tip-content="Name of your business"></i></h5>
                            <input class="search-field" type="text" value="" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">

                        <!-- Status -->
                        <div class="col-md-6">
                            <h5>Category</h5>
                            <select class="chosen-select-no-single">
                                <option label="blank">Select Category</option>
                                <option>Eat & Drink</option>
                                <option>Shops</option>
                                <option>Hotels</option>
                                <option>Restaurants</option>
                                <option>Fitness</option>
                                <option>Events</option>
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>Keywords <i class="tip" data-tip-content="Maximum of 15 keywords related with your business"></i></h5>
                            <input type="text" placeholder="Keywords should be separated by commas">
                        </div>
                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Pricing - steps (19,20,21) -->
            <form class="add-listing-section margin-top-45 toggle-wrap" id="pricingSetupForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-calculator"></i> Pricing</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <!-- Title -->
                    <div class="row with-forms">
                        <div class="col-md-12">
                            <h5>Listing Title <i class="tip" data-tip-content="Name of your business"></i></h5>
                            <input class="search-field" type="text" value="" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">

                        <!-- Status -->
                        <div class="col-md-6">
                            <h5>Category</h5>
                            <select class="chosen-select-no-single">
                                <option label="blank">Select Category</option>
                                <option>Eat & Drink</option>
                                <option>Shops</option>
                                <option>Hotels</option>
                                <option>Restaurants</option>
                                <option>Fitness</option>
                                <option>Events</option>
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>Keywords <i class="tip" data-tip-content="Maximum of 15 keywords related with your business"></i></h5>
                            <input type="text" placeholder="Keywords should be separated by commas">
                        </div>
                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                    </div>
                    <!-- Row / End -->
                </div>

            </form>

            <!-- Contact & Payment Modes - steps (22) -->
            <div class="add-listing-section margin-top-45 toggle-wrap" id="contactPaymentModesForm">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-user"></i> Contact & Payment Modes</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>
                <div class="listing-section-content">
                    <!-- Title -->
                    <div class="row with-forms">
                        <div class="col-md-12">
                            <h5>Listing Title <i class="tip" data-tip-content="Name of your business"></i></h5>
                            <input class="search-field" type="text" value="" />
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row with-forms">

                        <!-- Status -->
                        <div class="col-md-6">
                            <h5>Category</h5>
                            <select class="chosen-select-no-single">
                                <option label="blank">Select Category</option>
                                <option>Eat & Drink</option>
                                <option>Shops</option>
                                <option>Hotels</option>
                                <option>Restaurants</option>
                                <option>Fitness</option>
                                <option>Events</option>
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <h5>Keywords <i class="tip" data-tip-content="Maximum of 15 keywords related with your business"></i></h5>
                            <input type="text" placeholder="Keywords should be separated by commas">
                        </div>
                        <div class="col-12 text-end mb-3">
                            <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
                        </div>

                    </div>
                    <!-- Row / End -->
                </div>

            </div>

            <!-- <div class="row text-end mb-3 mt-3">
                <div class="col-12 text-end mb-3">
                    <button href="#" type="submit" class="button preview mt-0">Update <i class="fa fa-arrow-circle-right"></i></button>
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
<div id="listing_form_loader" class="preloader" hidden>
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
    <div class="loading-text">Saving Data ...</div>
</div>
<style>
    .rotated i {
        -webkit-transform: rotate(180deg);
        /* Chrome, Safari 3.1+ */
        -moz-transform: rotate(180deg);
        /* Firefox 3.5-15 */
        -ms-transform: rotate(180deg);
        /* IE 9 */
        -o-transform: rotate(180deg);
        /* Opera 10.50-12.00 */
        transform: rotate(180deg);
        /* Firefox 16+, IE 10+, Opera 12.10+ */
    }

    .toggleTrigger i {
        margin: 0;
        transition: transform 0.3s ease-in;
        -webkit-transition: -webkit-transform 0.3s ease-in;
    }

    .float-right {
        float: right;
    }

    .add-listing-section {
        padding-bottom: 0;
    }

    .switch {
        font-size: 30px;
        color: #123815 !important;
    }

    .add-listing-headline {
        margin-bottom: 0;
    }

    .listing-section-content {
        display: none;
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

    .ruleblocks col-md-6 col-12 select {
        margin-bottom: 0 !important;
    }

    .ruleblocks col-md-6 col-12 {
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
<script type="text/html" id="sleepBlock">
    <div style="display: flex;">
        <div style="width: 50%;">
            <span style="font-size:25px;">Room 1</span><br>
            <span style="font-size:18px;">
                <input class="d-none" value="lsaid_x" name="lsaid[0]">
                total beds <input name="sleepbeds_x[0]" id="sleepbeds_x1" value="total_beds_x" class="bedsbox" readonly required min="1">
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
                    <input id="double_x1" class="bedvalue guestsvalue" value="double_bed_x" readonly name="double_x[0]">
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
                    <input id="king_x1" class="bedvalue guestsvalue" value="king_bed_x" readonly name="king_x[0]">
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
                    <input id="queen_x1" class="bedvalue guestsvalue" value="queen_bed_x" readonly name="queen_x[0]">
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
                    <input id="single_x1" class="bedvalue guestsvalue" value="single_bed_x" readonly name="single_x[0]">
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
                    <input id="sofabed_x1" class="bedvalue guestsvalue" value="floormat_bed_x" readonly name="sofabed_x[0]">
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
                    <input id="bunkbed_x1" class="bedvalue guestsvalue" value="sofa_bed_x" readonly name="bunkbed_x[0]">
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
                    <input id="hammock_x1" class="bedvalue guestsvalue" value="bunk_bed_x" readonly name="hammock_x[0]">
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
                    <input id="floormat_x1" class="bedvalue guestsvalue" value="hammock_bed_x" readonly name="floormat_x[0]">
                </span>
                <i class="fa fa-plus-circle" style="color:#113814;font-size:32px" onclick="increaseBeds('floormat', '_x1')"></i>
            </div>
        </div>
    </div>
</script>
<?= $this->endSection(); ?>

<?= $this->section('footerScripts'); ?>

<script>
    // $(".listing-section-content").hide();
    $(".toggleTrigger, .toggleTrigger.opened").on("click", function(a) {
        $(this).toggleClass("active");
        a.preventDefault();
    });
    $(".toggleTrigger").on("click", function() {
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
            init_instance_callback: function(editor) {
                editor.on("Change", function(e) {
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

    const propertyTypes = $('#propertyTypes').val();

    function onChangeProperty(event) {
        // guestsOptions.removeAttr('hidden');
        // console.log(event);
        type = JSON.parse(propertyTypes);
        // console.log(type);
        var selectedType = type.filter(type => type.value == event)[0]
        // console.log(selectedType);
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

            const listingPropertyTypeRooms = parseInt(<?= $listing['propertytyperooms'] ?>);

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
            propertytyperooms.html('');
            haveRooms.attr('hidden', 'hidden');
        }

        // if (selectedType['infoModal']) {
        //     showPopupStep2();
        // }
    }

    $('#offbeat').change(function() {
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
    $('#offbeatonroad').change(function() {
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
    onChangeProperty('<?= $listing['propertytype'] ?>');
    offBeatOnChange($('#offbeat'));
    offBeatOnRoadOnChange($('#offbeatonroad'));


    // sleeping arrangements functions start
    const sleep_arrangementsData = JSON.parse($('#sleep_arrangements').html());
    const sleepArrangementArray = document.getElementById('sleepArrangementArray');

    var sleepBlock = $('#sleepBlock').html();

    var oldBedroomValue = parseInt(0);

    // if (_step == 3) {
    // sleepArrangementArray.innerHTML = sleepBlockInitial;
    // }

    async function onSelectBedrooms(bedrooms) {
        var sleep_arrangements_array = await JSON.parse($('#sleep_arrangements').html());
        // console.log(sleep_arrangements_array);
        bedrooms = parseInt(bedrooms);
        // console.log(bedrooms);
        // console.log(oldBedroomValue);
        var restValue = parseInt(bedrooms) - parseInt(oldBedroomValue);
        // console.log(restValue);
        if (bedrooms > oldBedroomValue) {
            for (var totalBedroom = 0; totalBedroom < restValue; totalBedroom++) {
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
                var str4 = str3.replace('lsaid_x', String(sleepBedsArray['lsaid']));
                var str5 = str4.replace('total_beds_x', sleepBedsArray['total_beds']);
                var str6 = str5.replace('double_bed_x', sleepBedsArray['double_bed']);
                var str7 = str6.replace('king_bed_x', sleepBedsArray['king_bed']);
                var str8 = str7.replace('queen_bed_x', sleepBedsArray['queen_bed']);
                var str9 = str8.replace('single_bed_x', sleepBedsArray['single_bed']);
                var str10 = str9.replace('floormat_bed_x', sleepBedsArray['floormat_bed']);
                var str11 = str10.replace('sofa_bed_x', sleepBedsArray['sofa_bed']);
                var str12 = str11.replace('bunk_bed_x', sleepBedsArray['bunk_bed']);
                var str13 = str12.replace('hammock_bed_x', sleepBedsArray['hammock_bed']);

                // replace total & all bed types

                var newBlock = str13.replace(/_x\[0\]/g, '_x[' + parseInt(parseInt(totalBedroom) + 1) + ']');

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

    onSelectBedrooms("<?= $listing['bedrooms'] ?>")
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

    // location
    const all_cities = JSON.parse($('#all_cities').html());
    var district_cities = $('#district_cities');
    var address_town = $('#address_town');

    async function onStateSelect(state_id) {
        var districtSelected = parseInt('<?= $listing["district"] ?>');
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
        } else {
            district_cities.attr('disabled', 'disabled');
            district_cities.removeAttr('required');
            address_town.removeAttr('disabled');
        }
    }

    function onDistrictSelect() {
        address_town.removeAttr('disabled');
    }
    onStateSelect(<?= $listing['state'] ?>)
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
    detailsChange.change(function() {
        var desc = this.name + '_desc';
        if (this.checked) {
            $('#' + desc).attr('required', 'required')
            $('#' + desc).removeAttr('hidden')
        } else {
            $('#' + desc).removeAttr('required')
            $('#' + desc).attr('hidden', 'hidden')
        }
    });

    detailsChange.each(function() {
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
</script>

<?= $this->endSection(); ?>