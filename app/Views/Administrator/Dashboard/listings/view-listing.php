<?= $this->extend('Administrator/layouts/main_user') ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-content-wrap">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">View Listing / <strong class="text-primary small"><?= $name['firstName'] . ' ' . $name['lastname'] ?></strong></h3>
                                <div class="nk-block-des text-soft">
                                </div>

                            </div>
                            <div class="nk-block-head-content">
                                <a href="html/user-list-regular.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="html/user-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-2">
                                <div class="card card-bordered card-full">
                                    <div class="nk-wg1">
                                        <div class="nk-wg1-block">
                                            <div class="nk-wg1-text">
                                                <h5 class="title">Total Booking</h5>
                                                <h1><?= $totalBooking ?></h1>
                                            </div>
                                        </div>
                                        <div class="nk-wg1-action">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-2">
                                <div class="card card-bordered card-full">
                                    <div class="nk-wg1">
                                        <div class="nk-wg1-block">
                                            <div class="nk-wg1-text">
                                                <h5 class="title">Pending Booking</h5>
                                                <h1><?= $pendingBooking ?></h1>
                                            </div>
                                        </div>
                                        <div class="nk-wg1-action">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-2">
                                <div class="card card-bordered card-full">
                                    <div class="nk-wg1">
                                        <div class="nk-wg1-block">
                                            <div class="nk-wg1-text">
                                                <h5 class="title">Rejected Booking</h5>
                                                <h1><?= $bookingReject ?></h1>
                                            </div>
                                        </div>
                                        <div class="nk-wg1-action">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-2">
                                <div class="card card-bordered card-full">
                                    <div class="nk-wg1">
                                        <div class="nk-wg1-block">
                                            <div class="nk-wg1-text">
                                                <h5 class="title">Approved Booking</h5>
                                                <h1><?= $bookingAccepted ?></h1>
                                            </div>
                                        </div>
                                        <div class="nk-wg1-action">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="nk-wg1">
                                        <div class="nk-wg1-block">
                                            <div class="nk-wg1-text">
                                                <h5 class="title">Total Revenue</h5>
                                                <h1>&#x20B9; <?= $totalRevenue['total'] ?></h1>
                                            </div>
                                        </div>
                                        <div class="nk-wg1-action">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .row -->
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">

                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card pl-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#"><em class="icon ni ni-user-circle "></em><span>Personal</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#generalAmenities"><em class="icon ni ni-repeat"></em><span>General Amenities</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#houseRules"><em class="icon ni ni-home-fill"></em><span>House Rules</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#guestsArrivalNotice"><em class="icon ni ni-user-alt-fill"></em><span>Guests Arrival Notice</span></a>
                                </li>
                            </ul>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Listing Information</h5>
                                        <p>Basic information, like your title and address mentioned here.</p>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Title</span>
                                                <span class="profile-ud-value"><?= $listingView['title'] ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Place Kind</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['placekind']) ?> Space</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">For Guests</span>
                                                <span class="profile-ud-value"><?= ($listingView['guests']) ?> Guests</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Property Type</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['propertytype']) ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">What will guests have</span>
                                                <span class="profile-ud-value"><?= $listingView['title'] ?> </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">How many rooms can guests use</span>
                                                <span class="profile-ud-value"><?= $listingView['bedrooms'] ?> Rooms</span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-block">
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">How many bathrooms</span>
                                                <span class="profile-ud-value"><?= $listingView['bathrooms'] ?> Bathrooms</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Located</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['location']) ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Street Address</span>
                                                <span class="profile-ud-value"><?= $listingView['address_full'] ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Flat, suite. (optional)</span>
                                                <span class="profile-ud-value"><?= $listingView['flat_no'] ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">State</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['state']) ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">District</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['district']) ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Town</span>
                                                <span class="profile-ud-value"><?= ucfirst($listingView['town']) ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Postcode</span>
                                                <span class="profile-ud-value"><?= $listingView['postcode'] ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Description</h5>
                                    </div>
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <p><?= $listingView['description'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Your Space</h5>
                                    </div>
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <p><?= $listingView['yourspace'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Your neighborhood</h5>
                                    </div>
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <p><?= $listingView['yourneighbourhood'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Your availability</h5>
                                    </div>
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <p><?= $listingView['yourinteraction'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Getting Around</h5>
                                    </div>
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <p><?= $listingView['gettingaround'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card-inner -->
                            <div class="card-inner" id="generalAmenities">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">General Amenities</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Essentials</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_essentials'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Wifi</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_wifi'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">TV</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_tv'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Heating</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_heating'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Air conditioning</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_ac'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Iron</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_iron'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-block">
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Shampoo</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_shampoo'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Hairdryer</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_hairdryer'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Breakfast, coffee, tea</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_breakfast_coffee_tea'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Desk/workspace</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_desk_workspace'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Fireplace</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_fireplace'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Wardrobe/drawers</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_wardrobe_drawers'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Private entrance</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_private_entrance'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Sanitization Kit</span>
                                                <span class="profile-ud-value"><?= $listingView['amenity_sanitization_kit'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-divider divider md"></div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Safety Amenities</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Smoke detector</span>
                                                <span class="profile-ud-value"><?= $listingView['safety_smoke_detector'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Carbon monoxide detector</span>
                                                <span class="profile-ud-value"><?= $listingView['safety_carbon_monoxide_detector'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">First aid kit</span>
                                                <span class="profile-ud-value"><?= $listingView['safety_first_aid_kit'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Fire extinguisher</span>
                                                <span class="profile-ud-value"><?= $listingView['safety_fire_extinguisher'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Lock on bedroom door</span>
                                                <span class="profile-ud-value"><?= $listingView['safety_lock_on_bedroom_door'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div>
                                <div class="nk-divider divider md"></div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Common Areas</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Kitchen</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_kitchen'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Laundry – washing machine / Dryer</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_laundry_washing_machine_dryer'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Parking</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_parking'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Gym</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_gym'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Pool</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_pool'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Hot tub</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_hottub'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Prayer Room - Temple</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_prayer_room'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Garden</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_garden'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Patio</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_patio'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Balcony</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_balcony'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Lobby</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_lobby'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Terrace</span>
                                                <span class="profile-ud-value"><?= $listingView['guestspace_terrace'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div>
                                <div class="nk-divider divider md" id="houseRules"></div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">House Rules</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Suitable for children (2-12 years)</span>
                                                    <span class="profile-ud-value"><?= ucfirst($listingView['houserules_forchildren'])  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Suitable for pets</span>
                                                    <span class="profile-ud-value"><?= ucfirst($listingView['houserules_forpets'])  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Events or parties allowed</span>
                                                    <span class="profile-ud-value"><?= ucfirst($listingView['houserules_partiesallowed'])  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Suitable for infants (under 2 years)</span>
                                                    <span class="profile-ud-value"><?= ucfirst($listingView['houserules_forinfants'])  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Smoking allowed</span>
                                                    <span class="profile-ud-value"><?= ucfirst($listingView['houserules_smokingallowed'])  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="nk-divider divider md"></div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Extras House Rules</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Must climb stairs</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_climbstairs'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Potential for noise</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_noisepotential'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Pet(s) live on property</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_petsonproperty'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">No parking on property</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_noparking'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Some spaces are shared</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_sharedspace'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Amenity limitations</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_amenitylimitaion'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Surveillance or recording devices on property</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_surveillance'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Weapons on property</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_weapons'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Dangerous animals on property</span>
                                                    <span class="profile-ud-value"><?= $listingView['housedetails_dangerousaminals'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Images</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="bq-note">
                                        <div class="bq-note-item">
                                            <div class="bq-note-text">
                                                <img src="/public/images/listing/41/1642768730_30d7d8afe5ebebf26514.jpg" width="100px">
                                            </div>
                                        </div>
                                    </div><!-- .bq-note -->
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Government-issued ID submitted to Hillstay</span>
                                                    <span class="profile-ud-value"><?= $listingView['requirementsgovtid'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Recommended by other hosts and have no negative reviews</span>
                                                    <span class="profile-ud-value"><?= $listingView['requirementspositiveguest'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Instant or Reviewd Booking</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Here’s how guests will book with you</span>
                                                    <span class="profile-ud-value"><?= $listingView['instantbooking'] == 1 ? 'Allow instant bookings' : 'I want to review every request'  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Are you sure you want all guests to send requests</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">You’ll only have 24 hours to respond to requests penalty-free</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Your listing will be ranked lower in search results, so you may get fewer reservations</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">You’ll lose some host protection and controls, including penalty-free cancellations if you’re uncomfortable with a reservation</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner" id="guestsArrivalNotice">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Guests Arrival Notice</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">No notice period required</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 0 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">1 day</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">2 day</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 2 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">3 day</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 3 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>' ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">7 day</span>
                                                    <span class="profile-ud-value"><?= $listingView['reviewedbooking_onedayresponse'] == 7 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Advance Booking</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">How far in advance can guests book</span>
                                                    <span class="profile-ud-value"><?php if ($listingView['advancebooking'] == '-1') {
                                                                                        echo 'any time';
                                                                                    } elseif ($listingView['advancebooking'] == '90') {
                                                                                        echo '3 months in advance';
                                                                                    } elseif ($listingView['advancebooking'] == '180') {
                                                                                        echo '6 months in advance';
                                                                                    } elseif ($listingView['advancebooking'] == '270') {
                                                                                        echo '9 months in advance';
                                                                                    } elseif ($listingView['advancebooking'] == '365') {
                                                                                        echo '1 year in advance';
                                                                                    }
                                                                                    ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">How long can guests stay</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nights Minimum</span>
                                                    <span class="profile-ud-value"><?= $listingView['nightsmin']  ?> Nights</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Nights Maximum</span>
                                                    <span class="profile-ud-value"><?= $listingView['nightsmax']  ?> Nights</span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Base price</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">This will be your default price</span>
                                                    <span class="profile-ud-value">&#x20B9; <?= $listingView['price']  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Do you want to add Cleaning fee</span>
                                                    <span class="profile-ud-value"><?= $listingView['cleaningFeeRequired'] == 1 ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">This will be your cleaning fee</span>
                                                    <span class="profile-ud-value">&#x20B9; <?= $listingView['cleaning_fee']  ?></span>
                                                </div>
                                            </div>
                                        </div><!-- .profile-ud-list -->
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Welcome Offer</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Offer 20% off to your first three guests (RECOMMENDED)</span>
                                                    <span class="profile-ud-value"><?= $listingView['welcomeoffer'] == '20' ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Don’t add a special offer.</span>
                                                    <span class="profile-ud-value"><?= $listingView['welcomeoffer'] == '0' ? '<em class="icon ni ni-check-fill-c text-success"></em>' : '<em class="icon ni ni-cross-fill-c text-danger"></em>'  ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Length-of-stay prices</h5>
                                        </div><!-- .nk-block-head -->
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Weekly discount</span>
                                                    <span class="profile-ud-value"><?= $listingView['weeklydiscount'] ? $listingView['weeklydiscount'] : 'Not Available'  ?> %</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Monthly discount</span>
                                                    <span class="profile-ud-value"><?= $listingView['monthlydiscount']  ? $listingView['monthlydiscount'] : 'Not Available'  ?> %</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-divider divider md"></div>
                                </div>
                            </div>

                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Container END -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>