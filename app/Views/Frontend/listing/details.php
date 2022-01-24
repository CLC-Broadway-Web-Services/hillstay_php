<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>

<input hidden id="current_listing_id" value="<?= $listing['listing_id'] ?>" />
<input hidden id="listing_guests" value="<?= $listing['guests'] ?>" />
<input hidden id="listing_requirementsgovtid" value="<?= $listing['requirementsgovtid'] ?>" />
<input hidden id="listing_requirementspositiveguest" value="<?= $listing['requirementspositiveguest'] ?>" />
<input hidden id="listing_instantbooking" value="<?= $listing['instantbooking'] ?>" />
<input hidden id="listing_reviewedbooking" value="<?= $listing['reviewedbooking'] ?>" />
<input hidden id="listing_reviewedbooking_onedayresponse" value="<?= $listing['reviewedbooking_onedayresponse'] ?>" />
<input hidden id="listing_reviewedbooking_ranklower" value="<?= $listing['reviewedbooking_ranklower'] ?>" />
<input hidden id="listing_reviewedbooking_nohostprotection" value="<?= $listing['reviewedbooking_nohostprotection'] ?>" />
<input hidden id="listing_availabilitydays" value="<?= $listing['availabilitydays'] ?>" />
<input hidden id="listing_bookbefore" value="<?= $listing['bookbefore'] ?>" />
<input hidden id="listing_checkintiming_from" value="<?= $listing['checkintiming_from'] ?>" />
<input hidden id="listing_checkintiming_to" value="<?= $listing['checkintiming_to'] ?>" />
<input hidden id="listing_advancebooking" value="<?= $listing['advancebooking'] ?>" />
<input hidden id="listing_nightsmin" value="<?= $listing['nightsmin'] ?>" />
<input hidden id="listing_nightsmax" value="<?= $listing['nightsmax'] ?>" />
<input hidden id="listing_calendardatesblock" value="<?= $listing['calendardatesblock'] ?>" />
<input hidden id="listing_is_disabled" value="<?= $listing['is_disabled'] ?>" />
<input hidden id="listing_disabled_dates" value="<?= $listing['disabled_dates'] ?>" />
<input hidden id="listing_enabled_dates" value="<?= $listing['enabled_dates'] ?>" />
<input hidden id="listing_price" value="<?= $listing['price'] ?>" />
<input hidden id="listing_cleaningFeeRequired" value="<?= $listing['cleaningFeeRequired'] ?>" />
<input hidden id="listing_cleaning_fee" value="<?= $listing['cleaning_fee'] ?>" />
<input hidden id="listing_welcomeoffer" value="<?= $listing['welcomeoffer'] ?>" />
<input hidden id="listing_weeklydiscount" value="<?= $listing['weeklydiscount'] ?>" />
<input hidden id="listing_monthlydiscount" value="<?= $listing['monthlydiscount'] ?>" />
<input hidden id="listing_is_sanitized" value="<?= $listing['is_sanitized'] ?>" />
<input hidden id="listing_sanitisation_data" value="<?= $listing['sanitisation_data'] ?>" />

<input hidden id="listing_bookings_count" value="<?= $listing['oldBookingsCount'] ?>" />
<input hidden id="listing_bookings_data" value="<?= json_encode($listing['oldBookingDates']) ?>" />

<!-- Slider -->
<div class="listing-slider mfp-gallery-container margin-bottom-0">
    <?php foreach ($listing['gallery'] as $image) : ?>
        <a href="<?= $image['image'] ?>" data-background-image="<?= $image['image'] ?>" class="item mfp-gallery" title="<?= $image['caption'] ?>"></a>
    <?php endforeach; ?>
</div>

<!-- Content -->
<div class="container">
    <div class="row sticky-wrapper">
        <div class="col-lg-8 col-md-8 padding-right-30 margin-bottom-30">
            <!-- Titlebar -->
            <div id="titlebar" class="listing-titlebar">
                <div class="listing-titlebar-title">
                    <h2><?= $listing['title'] ?></h2>
                    <span>
                        <a href="/f/<?= urlencode($listing['location']) ?>/hillstay">
                            <span class="listing-tag" style="cursor:pointer;margin-left:0;margin-right:5px;position:inherit;">
                                <i class="im im-icon-Map-Marker2"></i> <?= $listing['location'] ?>
                            </span>
                        </a>
                        <!-- <span> -->
                        <span data-bs-toggle="tooltip" data-bs-html="true" title="Covid-19 Certificate Required">
                            <img src="/public/assets/images/icons/mask.svg" style="max-height:30px;"> Covid-19
                        </span>
                        <!-- </span> -->
                    </span>
                    <div class="star-rating" data-rating="5">
                        <div class="rating-counter"><a href="#listing-reviews">(31 reviews)</a></div>
                    </div>
                    <div class="featured-icons">
                        <?php if ($listing['amenity_wifi']) : ?>
                            <span class="customtooltip">
                                <i class="im im-icon-Wifi" data-bs-toggle="tooltip" data-bs-html="true" title="WiFi"></i>
                            </span>
                        <?php endif; ?>

                        <?php if ($listing['amenity_breakfast_coffee_tea']) : ?>
                            <span class="customtooltip">
                                <i class="im im-icon-Coffee" data-bs-toggle="tooltip" data-bs-html="true" title="Breakfast"></i>
                            </span>
                        <?php endif; ?>

                        <?php if ($listing['amenity_sanitization_kit']) : ?>
                            <span class="customtooltip">
                                <i class="im im-icon-First-Aid" data-bs-toggle="tooltip" data-bs-html="true" title="Sanitization Kit"></i>
                            </span>
                        <?php endif; ?>

                        <?php if ($listing['offbeat']) : ?>
                            <span class="customtooltip">
                                <i class="im im-icon-Aim" data-bs-toggle="tooltip" data-bs-html="true" title="Off-Beat"></i>
                            </span>
                        <?php endif; ?>

                        <?php if ($listing['guestspace_parking']) : ?>
                            <span class="customtooltip">
                                <i class="im im-icon-Car-2" data-bs-toggle="tooltip" data-bs-html="true" title="Parking"></i>
                            </span>
                        <?php endif; ?>

                    </div>
                    <?php if ($listing['price']) : ?>
                        <!-- <div class="not-width-480">
                            <h6 style="margin:0;">
                                INR <?= $listing['price'] ?> &#8377 avg/night
                            </h6>
                        </div> -->
                    <?php endif; ?>
                    <h3 class="margin-top:5px !important;"><?= $placeKind['name'] ?> in <?= $propertyType['name'] ?></h3>
                    <p class="miniDetails"><?= $listing['guests'] ?> guests · <?= $listing['bedrooms'] ?> bedroom · <?= $listing['totalbeds'] ?> beds · <?= $listing['bathrooms'] ?> bathrooms</p>
                </div>
            </div>
            <!-- Listing Nav -->
            <div id="listing-nav" class="listing-nav-container">
                <ul class="listing-nav">
                    <li><a href="#listing-sleeparrangement">Sleeping Arrangements</a></li>
                    <li><a href="#listing-overview">Overview</a></li>
                    <li><a href="#listing-amenities">Amenities</a></li>
                    <li><a href="#listing-details">Details</a></li>
                    <?php if ($listing['rating']) : ?>
                        <li><a href="#listing-reviews">Reviews</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- sleeparrangement -->
            <div id="listing-sleeparrangement" class="listing-section">
                <!-- <h3 class="listing-desc-headline">Sleeping Arrangements</h3> -->
                <!-- <div class="clearfix mhl ptl">
                    <div class="col-md-4 col-12 fs1">
                        <div class="clearfix bshadow0 pbs">
                            <span class="im"><?= $listing['bedrooms'] ?></span>
                            <span class="mls"> Bedroom/s</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 fs1">
                        <div class="clearfix bshadow0 pbs">
                            <span class="im"><?= $listing['totalbeds'] ?></span>
                            <span class="mls"> Bed/s</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 fs1">
                        <div class="clearfix bshadow0 pbs">
                            <span class="im"><?= $listing['bathrooms'] ?></span>
                            <span class="mls"> Bathroom/s</span>
                        </div>
                    </div>
                </div> -->
                <div class="row mt-3">
                    <?php foreach ($listing['sleeping_arrangement'] as $key => $sleeps) : ?>
                        <div class="col-md-6 col-12 mb-3">
                            <div class="sleepingBody p-3 card">
                                <div class="svgBeds">
                                    <?php
                                    for ($i = 0; $i < $sleeps['total_beds']; $i++) {
                                        echo $svgBedIcon;
                                    } ?>
                                </div>
                                <h3 class="listing-desc-headline m-0">Bedroom <?= intval($key + 1) ?></h3>
                                <div class="text-bold sleepingBeds">
                                    <?php if ($sleeps['double_bed']) : ?>
                                        <span><b><?= $sleeps['double_bed'] ?></b> Double Bed</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['king_bed']) : ?>
                                        <span><b><?= $sleeps['king_bed'] ?></b> King Sized</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['queen_bed']) : ?>
                                        <span><b><?= $sleeps['queen_bed'] ?></b> Queen Bed</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['single_bed']) : ?>
                                        <span><b><?= $sleeps['single_bed'] ?></b> Single Bed</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['bunk_bed']) : ?>
                                        <span><b><?= $sleeps['bunk_bed'] ?></b> Bunkbed</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['sofa_bed']) : ?>
                                        <span><b><?= $sleeps['sofa_bed'] ?></b> Sofabed</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['hammock_bed']) : ?>
                                        <span><b><?= $sleeps['hammock_bed'] ?></b> Hammock</span>
                                    <?php endif; ?>
                                    <?php if ($sleeps['floormat_bed']) : ?>
                                        <span><b><?= $sleeps['floormat_bed'] ?></b> Floormat</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <!-- Off BEAT -->
            <?php if ($listing['offbeat']) : ?>
                <div id="off-beat" class="listing-section">
                    <h3 class="listing-desc-headline">Off-Beat Distance</h3>
                    <?php if (!$listing['offbeatonroad']) : ?>
                        <div>
                            <span><i class="im im-icon-Aim"></i> Walking: <?= $listing['offbeat_walking'] ?> Km</span>
                        </div>
                    <?php endif; ?>
                    <div>
                        <span><i class="im im-icon-Full-Cart"></i> Market: <?= $listing['offbeat_market'] ?> Km</span>
                    </div>
                    <div>
                        <span><i class="im im-icon-Clinic"></i> Medical: <?= $listing['offbeat_medical'] ?> Km</span>
                    </div>
                    <div>
                        <span><i class="im im-icon-Building"></i> Nearby Town: <?= $listing['offbeat_town'] ?> Km</span>
                    </div>
                    <div>
                        <span><i class="im im-icon-Bus"></i> Bus Station: <?= $listing['offbeat_busstation'] ?> Km</span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
            <!-- overview -->
            <div id="listing-overview" class="listing-section">
                <h3 class="listing-desc-headline mt-2">Description</h3>
                <div class="readMore">
                    <?= $listing['description'] ?>
                </div>
                <?php if ($listing['yourspace']) : ?>
                    <h3 class="listing-desc-headline">Your Space</h3>
                    <div class="readMore">
                        <?= $listing['yourspace'] ?>
                    </div>
                <?php endif; ?>
                <?php if ($listing['yourinteraction']) : ?>
                    <h3 class="listing-desc-headline">Interaction</h3>
                    <div class="readMore">
                        <?= $listing['yourinteraction'] ?>
                    </div>
                <?php endif; ?>
                <?php if ($listing['yourneighbourhood']) : ?>
                    <h3 class="listing-desc-headline">Neighbourhood</h3>
                    <div class="readMore">
                        <?= $listing['yourneighbourhood'] ?>
                    </div>
                <?php endif; ?>
                <?php if ($listing['gettingaround']) : ?>
                    <h3 class="listing-desc-headline">Getting Around</h3>
                    <div class="readMore">
                        <?= $listing['gettingaround'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Amenities -->
            <div id="listing-amenities" class="listing-section">
                <h3 class="listing-desc-headline">Basic Amenities</h3>
                <ul class="listing-features checkboxes margin-top-0">
                    <li class="<?php if (!$listing['amenity_ac']) echo 'no-amenity' ?>">Air Condition</li>
                    <li class="<?php if (!$listing['amenity_breakfast_coffee_tea']) echo 'no-amenity' ?>">Breakfast, coffee, tea
                    </li>
                    <li class="<?php if (!$listing['amenity_desk_workspace']) echo 'no-amenity' ?>">Desk/workspace</li>
                    <li class="<?php if (!$listing['amenity_fireplace']) echo 'no-amenity' ?>">Fireplace</li>
                    <li class="<?php if (!$listing['amenity_hairdryer']) echo 'no-amenity' ?>">Hairdryer</li>
                    <li class="<?php if (!$listing['amenity_heating']) echo 'no-amenity' ?>">Heating</li>
                    <li class="<?php if (!$listing['amenity_iron']) echo 'no-amenity' ?>">Iron</li>
                    <li class="<?php if (!$listing['amenity_private_entrance']) echo 'no-amenity' ?>">Private entrance</li>
                    <li class="<?php if (!$listing['amenity_sanitization_kit']) echo 'no-amenity' ?>">Sanitization Kit</li>
                    <li class="<?php if (!$listing['amenity_tv']) echo 'no-amenity' ?>">TV</li>
                    <li class="<?php if (!$listing['amenity_wardrobe_drawers']) echo 'no-amenity' ?>">Wardrobe/drawers</li>
                    <li class="<?php if (!$listing['amenity_wifi']) echo 'no-amenity' ?>">WiFi</li>
                    <li class="<?php if (!$listing['amenity_essentials']) echo 'no-amenity' ?>">
                        Essentials <small>(Towels, bed sheets, soap, toilet paper, and pillows)</small>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <h3 class="listing-desc-headline">Safety Amenities</h3>
                <ul class="listing-features checkboxes margin-top-0">
                    <li class="<?php if (!$listing['safety_first_aid_kit']) echo 'no-amenity' ?>">First aid kit</li>
                    <li class="<?php if (!$listing['safety_fire_extinguisher']) echo 'no-amenity' ?>">Fire extinguisher</li>
                    <li class="<?php if (!$listing['safety_smoke_detector']) echo 'no-amenity' ?>">Smoke detector</li>
                    <li class="<?php if (!$listing['safety_carbon_monoxide_detector']) echo 'no-amenity' ?>">Carbon monoxide
                        detector</li>
                    <li class="<?php if (!$listing['safety_lock_on_bedroom_door']) echo 'no-amenity' ?>">Lock on bedroom doors</li>
                </ul>
                <div class="clearfix"></div>
                <h3 class="listing-desc-headline">Common Areas</h3>
                <ul class="listing-features checkboxes margin-top-0">
                    <li class="<?php if (!$listing['guestspace_kitchen']) echo 'no-amenity' ?>">Kitchen</li>
                    <li class="<?php if (!$listing['guestspace_laundry_washing_machine_dryer']) echo 'no-amenity' ?>">Laundry</li>
                    <li class="<?php if (!$listing['guestspace_parking']) echo 'no-amenity' ?>">Parking</li>
                    <li class="<?php if (!$listing['guestspace_gym']) echo 'no-amenity' ?>">Gym</li>
                    <li class="<?php if (!$listing['guestspace_pool']) echo 'no-amenity' ?>">Pool</li>
                    <li class="<?php if (!$listing['guestspace_hottub']) echo 'no-amenity' ?>">Hot Tub</li>
                    <li class="<?php if (!$listing['guestspace_prayer_room']) echo 'no-amenity' ?>">Prayer Room / Temple</li>
                    <li class="<?php if (!$listing['guestspace_garden']) echo 'no-amenity' ?>">Garden</li>
                    <li class="<?php if (!$listing['guestspace_patio']) echo 'no-amenity' ?>">Patio</li>
                    <li class="<?php if (!$listing['guestspace_balcony']) echo 'no-amenity' ?>">Balcony</li>
                    <li class="<?php if (!$listing['guestspace_lobby']) echo 'no-amenity' ?>">Lobby</li>
                    <li class="<?php if (!$listing['guestspace_terrace']) echo 'no-amenity' ?>">Terrace</li>
                </ul>
            </div>
            <!-- Details -->
            <div id="listing-details" class="listing-section">
                <div class="clearfix mhl ptl">
                    <h3 class="listing-desc-headline">Rules</h3>
                    <ul class="listing-features checkboxes margin-top-0">
                        <li class="<?php if ($listing['houserules_forchildren'] == 'no') echo 'no-amenity' ?>">Suitable for children</li>
                        <li class="<?php if ($listing['houserules_forinfants'] == 'no') echo 'no-amenity' ?>">Suitable for infants</li>
                        <li class="<?php if ($listing['houserules_forpets'] == 'no') echo 'no-amenity' ?>">Suitable for pets</li>
                        <li class="<?php if ($listing['houserules_smokingallowed'] == 'no') echo 'no-amenity' ?>">Smoking allowed</li>
                        <li class="<?php if ($listing['houserules_partiesallowed'] == 'no') echo 'no-amenity' ?>">Events or Parties allowed</li>
                    </ul>
                </div>
                <?php if (count($listing['additional_rules']) > 0) : ?>
                    <div class="clearfix mhl ptl">
                        <h3 class="listing-desc-headline">Additional rules</h3>
                        <ul class="listing-features checkboxes margin-top-0">
                            <?php foreach ($listing['additional_rules'] as $key => $rules) : ?>
                                <li><?= $rules['rule'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($listing['housedetails_climbstairs'] || $listing['housedetails_noisepotential'] || $listing['housedetails_petsonproperty'] || $listing['housedetails_noparking'] || $listing['housedetails_sharedspace'] || $listing['housedetails_amenitylimitaion'] || $listing['housedetails_surveillance'] || $listing['housedetails_weapons'] || $listing['housedetails_dangerousaminals']) : ?>
                    <div class="clearfix mhl ptl">
                        <h3 class="listing-desc-headline">Other Details</h3>
                        <ul class="listing-features checkboxes margin-top-0">
                            <?php if ($listing['housedetails_climbstairs']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_climbstairs_desc'] ?>">Climb Stairs</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_noisepotential']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_noisepotential_desc'] ?>">Noise Potential</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_petsonproperty']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_petsonproperty_desc'] ?>">Have Pets</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_noparking']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_noparking_desc'] ?>">No Parking</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_sharedspace']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_sharedspace_desc'] ?>">Shared Spaces</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_amenitylimitaion']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_amenitylimitaion_desc'] ?>">Amenities Limitations</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_surveillance']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_surveillance_desc'] ?>">Have Surveillance</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_weapons']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_weapons_desc'] ?>">Have Weapons</li>
                            <?php endif; ?>
                            <?php if ($listing['housedetails_dangerousaminals']) : ?>
                                <li data-bs-toggle="tooltip" data-bs-html="true" title="<?= $listing['housedetails_dangerousaminals_desc'] ?>">Have Dangerous Animals</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($listing['rating']) : ?>
                <div id="listing-reviews" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>
                    <!-- Rating Overview -->
                    <div class="rating-overview">
                        <div class="rating-overview-box">
                            <span class="rating-overview-box-total">4.2</span>
                            <span class="rating-overview-box-percent">out of 5.0</span>
                            <div class="star-rating" data-rating="5"></div>
                        </div>
                        <div class="rating-bars">
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Service <i class="tip" data-tip-content="Quality of customer service and attitude to work with you"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.2">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.2</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Value for Money <i class="tip" data-tip-content="Overall experience received for the amount spent"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.8">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.8</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Location <i class="tip" data-tip-content="Visibility, commute or nearby parking spots"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="3.7">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>3.7</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Cleanliness <i class="tip" data-tip-content="The physical condition of the business"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.0">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.0</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Rating Overview / End -->
                    <div class="clearfix"></div>
                    <!-- Reviews -->
                    <section class="comments listing-reviews">
                        <ul>
                            <li>
                                <div class="avatar">
                                    <img src="/assets/images/dashboard-avatar.jpg" />
                                </div>
                                <div class="comment-content">
                                    <div class="arrow-comment"></div>
                                    <div class="comment-by">Kathy Brown <i class="tip" data-tip-content="Person who left this review actually was a customer"></i>
                                        <span class="date">June 2019</span>
                                        <div class="star-rating" data-rating="5"></div>
                                    </div>
                                    <p>
                                        Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere
                                        tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non
                                        metus
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="/assets/images/dashboard-avatar.jpg" />
                                </div>
                                <div class="comment-content">
                                    <div class="arrow-comment"></div>
                                    <div class="comment-by">John Doe<span class="date">May 2019</span>
                                        <div class="star-rating" data-rating="4"></div>
                                    </div>
                                    <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem
                                        felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus
                                        sollicitudin mauris.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="/assets/images/dashboard-avatar.jpg" />
                                </div>
                                <div class="comment-content">
                                    <div class="arrow-comment"></div>
                                    <div class="comment-by">Kathy Brown<span class="date">June 2019</span>
                                        <div class="star-rating" data-rating="5"></div>
                                    </div>
                                    <p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere
                                        tristique
                                        sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus
                                    </p>

                                </div>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="/assets/images/dashboard-avatar.jpg" />
                                </div>
                                <div class="comment-content">
                                    <div class="arrow-comment"></div>
                                    <div class="comment-by">John Doe<span class="date">May 2019</span>
                                        <div class="star-rating" data-rating="5"></div>
                                    </div>
                                    <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem
                                        felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus
                                        sollicitudin mauris.
                                    </p>
                                </div>

                            </li>
                        </ul>
                    </section>
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-4 sticky listing-column margin-top-75">
            <div class="verified-badge with-tip" *ngIf="is_sanitized" data-tip-content="Listing has been verified and belongs the business owner or manager.">
                <i class="sl sl-icon-check"></i> Verified Listing
            </div>
            <!-- Book Now -->
            <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-5" #bookNowWidget>

                <!-- ajax pricing should here -->
                <div id="selectionPrice" hidden>
                    <h3 *ngIf="discountedPriceNight < price">
                        <small><del>INR <?= $listing['price'] ?> &#8377</del></small>
                        {{discountedPriceNight | currency:'INR':'&#8377; '}} <small>avg/night</small>
                    </h3>
                </div>
                <!-- ajax pricing else -->
                <div id="bookingHeading">
                    <h3>INR <?= $listing['price'] ?> &#8377 <small>avg/night</small></h3>
                </div>
                <form class="row with-forms  margin-top-0" id="_bookingForm">
                    <div class="col-12">
                        <!-- ajax IF NIGHTS MIN OR MAX SHOULD BE DIFFERENTIATE -->
                        <small class="text-danger" hidden>
                            Should be minimum <?= $listing['nightsmin'] ?> nights
                        </small>

                        <input name="bookingdate" id="bookingdate" placeholder="Checkin - Checkout" readonly class="datepicker2" style="border: 0;box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);">

                        <div class="panel-dropdown" id="date-picker">
                            <a href="#">Guests <span class="qtyTotal" name="qtyTotal">0</span></a>
                            <div class="panel-dropdown-content">

                                <!-- Quantity Buttons -->
                                <div class="qtyButtons">
                                    <div class="qtyTitle">Adults</div>
                                    <input type="text" class="qtyInput" name="qtyInputAdult" id="qtyInputAdult" value="1">
                                </div>
                                <?php if ($listing['houserules_forchildren'] != 'no') { ?>
                                    <div class="qtyButtons">
                                        <div class="qtyTitle">Children</div>
                                        <input type="text" class="qtyInput" name="qtyInputChild" id="qtyInputChild" value="0">
                                    </div>
                                <?php } else { ?>
                                    <div class="qtyButtons">
                                        <div>No Children Allowed</div>
                                    </div>
                                <?php } ?>
                                <?php if ($listing['houserules_forchildren'] != 'no') { ?>
                                    <div class="qtyButtons">
                                        <div class="qtyTitle">Infants</div>
                                        <input type="text" class="qtyInput" name="qtyInputInfant" id="qtyInputInfant" value="0">
                                    </div>
                                <?php } else { ?>
                                    <div class="qtyButtons">
                                        <div>No Infants Allowed</div>
                                    </div>
                                <?php } ?>

                                <input type="number" max="<?= $listing['guests'] ?>" value="" name="qtyInputTotal" id="qtyInputTotal" style="display: none;">

                            </div>
                        </div>
                        <!-- show after calculated -->
                        <div class="panel-dropdown selectiondropdown-input" id="showPriceBreakdownPanel" style="display: none;">
                            <div class="price-breakdown" style="width: 100%;padding:10px;">
                                <div style="display:flex;line-height:initial;">
                                    <span style="flex-grow: 1;">
                                        <b>Total</b><br>
                                        <small>includes taxes & fees</small>
                                    </span>
                                    <span style="text-align:right;">
                                        <b>&#8377; <span id="totalPriceHtml">500</span></b><br>
                                        <!-- <small style="cursor:pointer;"><span href="#pricingBreakdownModal" class="sign-in popup-with-zoom-anim" style="color:blue;">View Details</span></small> -->
                                    </span>
                                </div>
                            </div>
                            <p id="discount_weekly_panel" style="display: none;">
                                <span style="flex-grow: 1;">Weekly Discount</span>
                                <span style="float:right;">&#8377; <span id="weeklyPrice">500</span></span>
                            </p>
                            <p id="discount_monthly_panel" style="display: none;">
                                <span style="flex-grow: 1;">Monthly Discount </span>
                                <span style="float:right;">&#8377; <span id="monthlyPrice">500</span></span>
                            </p>
                            <p id="discount_welcome_panel" style="display: none;">
                                <span style="flex-grow: 1;">Welcome Bonus </span>
                                <span style="float:right;">&#8377; <span id="welcomePrice">500</span></span>
                            </p>
                        </div>
                    </div>
                    <!-- Book Now -->
                    <div>
                        <?php if ($user_id) : ?>
                            <button type="button" id="calculatePriceButton" onclick="calculate()" class="button book-now fullwidth margin-top-5 book_now_button">
                                Calculate
                            </button>
                            <a type="button" href="#guestsData" id="openGuestFormButton" class="popup-with-zoom-anim button book-now fullwidth margin-top-5 book_now_button" style="display:none;">
                                Request to book
                            </a>
                            <button type="button" id="resetCalculatebutton" onclick="checkAdvanceBooking()" class="button book-now fullwidth margin-top-5 book_now_button" style="display:none;">
                                Reset
                            </button>
                            <!-- <a id="openGuestFormButton" (click)="openGuestsForm()" class="button book-now fullwidth margin-top-5" style="display:none;">
                                Request to book
                            </a> -->
                        <?php else : ?>
                            <a href="#sign-in-dialog" class="popup-with-zoom-anim button book-now fullwidth margin-top-5 book_now_button" style="color:#fff">
                                Login to continue
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- show after calculated -->
                    <div id="afterCalculateDiv">
                    </div>

                </form>
            </div>
            <!-- Book Now / End -->
            <!-- Host -->
            <div class="boxed-widget margin-top-35 margin-bottom-40 no-border">
                <div class="hosted-by-title">
                    <h4><span>Hosted by</span> <a href="<?= route_to('public_profile_page', base64_encode(base64_encode(base64_encode($listing['uid'])))) ?>"><?= $listing['host']['firstName'] . ' ' . $listing['host']['lastname'] ?></a>
                    </h4>
                    <a href="<?= route_to('public_profile_page', base64_encode(base64_encode(base64_encode($listing['uid'])))) ?>" class="hosted-by-avatar">
                        <img src="<?= $listing['host']['photoURL'] ?>" [alt]="<?= $listing['host']['firstName'] . ' ' . $listing['host']['lastname'] ?>">
                    </a>
                </div>
                <?php if ($listing['host']['aboutuser']) : ?>
                    <div class="listing-details-sidebar mb-3 readMore">
                        <?= $listing['host']['aboutuser'] ?>
                    </div>
                <?php endif; ?>

                <?php if ($user_id) : ?>
                    <a href="#contactHost" class="popup-with-zoom-anim button book-now fullwidth margin-top-5 book_now_button" style="color:#fff">
                        <i class="sl sl-icon-envelope-open"></i> Send Message
                    </a>
                <?php else : ?>
                    <a href="#sign-in-dialog" class="popup-with-zoom-anim button book-now fullwidth margin-top-5 book_now_button" style="color:#fff">
                        Login to Message Host
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Sidebar / End -->

    </div>
</div>

<div id="contactHost" class="zoom-anim-dialog mfp-hide customMfp">

    <div class="small-dialog-header">
        <h3><?= $listing['host']['firstName'] . ' ' . $listing['host']['lastname'] ?></h3>
    </div>

    <div class="modal-content">

        <form id="contactHostForm">

            <div class="message-reply margin-top-0" [formGroup]="_hostContactForm">
                <input hidden name="listing_id" value="<?= $listing['listing_id'] ?>" />
                <input hidden name="listing_name" value="<?= $listing['title'] ?>" />
                <input hidden name="hostid" value="<?= $listing['host']['uid'] ?>" />
                <input hidden name="hostName" value="<?= $listing['host']['firstName'] . ' ' . $listing['host']['lastname'] ?>" />
                <textarea name="message" id="messageToHost" cols="40" rows="3" placeholder="Your message to <?= $listing['host']['firstName'] . ' ' . $listing['host']['lastname'] ?>"></textarea>
                <button type="submit" class="button">Send Message</button>
            </div>

        </form>

    </div>
</div>

<div id="pricingBreakdownModal" class="zoom-anim-dialog mfp-hide customMfp">

    <div class="small-dialog-header">
        <h3>Booking summary</h3>
    </div>

    <div class="modal-content">

        <div class="modal-body" style="line-height:1.5rem;font-size:16px;color:#292929 !important;">
            <h5 style="margin-top:15px;">Price Breakdown</h5>
            <p class="d-flex">
                <span style="flex-grow: 1;">&#8377; <span id="pricePanel_discountedPriceNight"></span> x <span id="pricePanel_totalNights"></span> nights</span>
                <span style="text-align:right;">&#8377; {{discountedPriceNight*totalNights | currency:'INR':'&#8377; '}}</span>
            </p>
            <p class="d-flex">
                <span style="flex-grow: 1;">Cleaning Fee</span>
                <span style="text-align:right;">&#8377; {{cleaingFee | currency:'INR':'&#8377; '}}</span>
            </p>
            <p class="d-flex">
                <span style="flex-grow: 1;">Service Fee ({{serviceFee}} %)</span>
                <span style="text-align:right;">&#8377; {{(((discountedPriceNight*totalNights)+cleaingFee)/100)*serviceFee | currency:'INR':'&#8377; '}}</span>
            </p>
            <p class="d-flex">
                <span style="flex-grow: 1;">Lodging Tax ({{lodgingTax}} %)</span>
                <span style="text-align:right;">&#8377; {{(((discountedPriceNight*totalNights)+cleaingFee)/100)*lodgingTax | currency:'INR':'&#8377; '}}</span>
            </p>
            <p class="d-flex" style="border-top:rgb(44, 44, 44) dotted 1px;border-bottom:rgb(44, 44, 44) dotted 1px;">
                <span style="flex-grow: 1;"><b>Total</b></span>
                <span style="text-align:right;">&#8377; {{(discountedPriceNight*totalNights)+cleaingFee+((((discountedPriceNight*totalNights)+cleaingFee)/100)*serviceFee)+((((discountedPriceNight*totalNights)+cleaingFee)/100)*lodgingTax) | currency:'INR':'&#8377; '}}</span>
            </p>
        </div>
        <div class="modal-footer" style="border:0;">
            <button type="button" class="button fullwidth" (click)="modalRef.hide()">Continue</button>
        </div>

    </div>
</div>
<form id="guestsData" class="zoom-anim-dialog mfp-hide customMfp" enctype="multipart/form-data">

    <div class="modal-body" id="_bookingFormGuestData">
        <input type="number" name="user_id" value="<?= $user_id ?>" hidden>
        <input type="number" name="host_id" value="<?= $listing['uid'] ?>" hidden>
        <input type="number" name="listing_id" value="<?= $listing['listing_id'] ?>" hidden>

        <div class="col-md-12">
            <div class="style-2" id="guestsAccordion">

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send request</button>
    </div>
</form>
<style>
    .personalGuestsDetails input,
    .personalGuestsDetails select {
        display: inline;
        padding-left: 10px;
        padding-right: 10px;
    }

    .personalGuestsDetails select {
        max-width: 24%;
    }

    .personalGuestsDetails input.guestAge {
        max-width: 13%;
        text-align: center;
    }

    .personalGuestsDetails input.guestName {
        max-width: 60%;
    }

    /* Chrome, Safari, Edge, Opera */
    input.guestAge::-webkit-outer-spin-button,
    input.guestAge::-webkit-inner-spin-button,
    .personalGuestsDetails input[name="age"]::-webkit-outer-spin-button,
    .personalGuestsDetails input[name="age"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input.guestAge,
    .personalGuestsDetails input[name="age"][type=number] {
        -moz-appearance: textfield;
    }

    .og-close,
    button.mfp-close {
        position: absolute;
        width: 45px;
        height: 45px;
        top: -10;
        display: block;
        right: 0;
        cursor: pointer !important;
        z-index: 9999;
        color: initial;
    }

    .mfp-close:hover {
        transform: none
    }

    .mfp-close:hover {
        color: initial;
    }

    .modal-body {
        padding-top: 50px;
    }

    #calculatePriceButton[disabled] {
        background-color: #e9ecef !important;
        border: 1px solid #dbdbdb !important;
    }

    .sleepingBody {
        height: 100%;
    }

    .sleepingBeds span:not(:last-child):after {
        content: ' · ';
    }

    span.svgBed {
        display: inline-block !important;
        margin-right: 8px !important;
    }

    p.miniDetails {
        font-size: 20px;
    }

    .price-breakdown {
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
        height: auto;
        padding: 10px 16px;
        background-color: #fff;
        color: #888;
        display: block;
        width: 100%;
        transition: color 0.3s;
        margin-bottom: 15px;
    }

    .customMfp {
        background-color: #fff;
        border-radius: 15px;
    }

    .customMfp .small-dialog-header {
        width: 100%;
        left: 0;
    }

    .customMfp .modal-content {
        padding: 19px;
        border: 0;
    }

    .panel-dropdown .panel-dropdown-content {
        width: inherit;
    }

    .panel-dropdown a {
        padding: 9px 14px;
        margin: auto;
        display: block;
        width: 100%;
        height: 44px;
    }

    .listing-nav li {
        cursor: pointer;
    }

    .featured-icons i {
        font-size: 35px;
        padding: 15px;
    }

    .featured-icons {
        padding: 15px 0;
    }

    .listing-tag {
        color: #fff !important;
        background-color: #294C2C !important;
    }

    .listing-tag i {
        color: #fff !important;
        padding: 0 0 8px 0 !important;
    }

    .listing-features.checkboxes li.no-amenity::before {
        content: "" !important;
        background-color: #d9534f !important;
    }

    .listing-features.checkboxes li::before {
        background-color: #5cb85c !important;
    }

    .listing-titlebar {
        padding-bottom: 30px !important;
    }
    .price-breakdown {
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
        height: auto;
        padding: 10px 16px;
        background-color: #fff;
        color: #888;
        display: block;
        width: 100%;
        transition: color 0.3s;
        margin-bottom: 15px;
    }

    #titlebar {
        /* padding-top: 0; */
        padding-bottom: 5px;
    }

    #booking-widget-anchor {
        user-select: none !important;
    }

    a.book_now_button,
    button.book_now_button {
        border: none !important;
        cursor: pointer !important;
        border-radius: 5px !important;
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
        font-size: 16px !important;
        font-weight: 600 !important;
        height: auto;
        padding: 10px 16px !important;
        line-height: 30px;
        margin: 0 0 15px;
        background-color: #fff !important;
        color: #888 !important;
        display: block;
        width: 100% !important;
        transition: color 0.3s !important;
        text-align: center;
    }

    .sticky-book-now {
        display: none !important;
        align-items: center;
        z-index: 9999999;
        min-height: 80px;
        background-color: white !important;
        box-shadow: rgba(0, 0, 0, 0.28) 0px 8px 28px !important;
        position: fixed;
        width: 100%;
        bottom: 0;
        padding: 5px 10px;
    }

    .sticky-book-now .sticky-book-price {
        flex-grow: 1;
        font-size: 22px;
        line-height: 22px;
    }

    .sticky-book-now .sticky-book-price .small {
        font-size: 14px;
    }

    .sticky-book-now .sticky-book-button {
        text-align: right;
    }

    .sticky-book-now .sticky-book-button .button {
        background-color: #113814;
        color: #fff;
        border: none !important;
        cursor: pointer !important;
        border-radius: 5px !important;
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
    }

    .form-row {
        display: block;
    }

    #sign-in-dialog,
    #small-dialog {
        margin: 0;
    }

    #sign-in-dialog {
        padding-bottom: 0;
    }

    .small-dialog-header {
        margin-bottom: 15px;
    }

    .myAccordian>div.panel-heading {
        border: none !important;
        margin: 0 !important;
        font-size: 17px !important;
        background-color: transparent !important;
        color: #333 !important;
        font-weight: 400 !important;
        display: block !important;
        cursor: pointer !important;
        position: relative !important;
        line-height: 26px !important;
        transition: background-color 0.2s, color 0.2s !important;
        padding: 0 !important;
    }

    @media only screen and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait) {
        .listing-column {
            padding: 0 !important;
        }

        .listing-column>div {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .sticky-book-now {
            display: flex !important;
        }

        .listing-desc-headline {
            margin-top: 10px;
        }

        .not-width-480 {
            display: none;
        }

        .listing-titlebar {
            padding-bottom: 5px !important;
        }

        .personalGuestsDetails select {
            max-width: 68%;
        }

        .personalGuestsDetails input.guestAge {
            max-width: 30%;
            text-align: center;
        }

        .personalGuestsDetails input.guestName {
            max-width: none;
        }
    }

    .readMore {
        text-align: justify;
        overflow: hidden;
    }

    a.readMoreLink {
        color: inherit;
    }

    a.readMoreLink:hover {
        color: blue;
    }
    .form-control {
        height: auto;
    }
</style>

<?= $this->endSection(); ?>