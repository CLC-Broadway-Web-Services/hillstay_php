<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>


<!-- Content
================================================== -->
<div class="container customContainer">
    <div class="row">

        <!-- Search -->
        <!-- <div class="col-md-12">
            <div class="main-search-input gray-style margin-top-0 margin-bottom-10">

                <div class="main-search-input-item">
                    <input type="text" placeholder="What are you looking for?" value="" />
                </div>

                <div class="main-search-input-item location">
                    <div id="autocomplete-container">
                        <input id="autocomplete-input" type="text" placeholder="Location">
                    </div>
                    <a href="#"><i class="fa fa-map-marker"></i></a>
                </div>

                <div class="main-search-input-item">
                    <select data-placeholder="All Categories" class="chosen-select">
                        <option>All Categories</option>
                        <option>Shops</option>
                        <option>Hotels</option>
                        <option>Restaurants</option>
                        <option>Fitness</option>
                        <option>Events</option>
                    </select>
                </div>

                <button class="button">Search</button>
            </div>
        </div> -->
        <form class="col-md-12" id="searchFrom" action="<?= route_to('searchPage') ?>">
            <h2 class="font-weight-bold text-primary2">
                Find More <span class="typed-words"></span>
            </h2>

            <div class="main-search-input">

                <div class="main-search-input-item location">
                    <div id="autocomplete-container">
                        <input id="autocomplete-input" autocomplete type="text" name="location" placeholder="What are you looking for">
                    </div>
                    <a><i class="fa fa-map-marker"></i></a>
                </div>

                <div class="main-search-input-item location">
                    <div id="datepicker-container2">
                        <!-- <input type="text" id="datepicker" placeholder="Checkin - Checkout" readonly="readonly"> -->
                        <input type="text" class="datepicker2" placeholder="Checkin - Checkout" name="date" readonly="readonly">
                    </div>
                    <a><i class="fa fa-calendar"></i></a>
                </div>

                <div class="main-search-input-item" style="user-select:none;">
                    <div class="panel-dropdown" id="date-picker">
                        <a href="#">Guests <span class="qtyTotal" name="qtyTotal">0</span></a>
                        <div class="panel-dropdown-content">

                            <!-- Quantity Buttons -->
                            <div class="qtyButtons">
                                <div class="qtyTitle">Adults</div>
                                <input type="text" class="qtyInput" min="1" max="5" name="qtyInputAdult" value="1">
                            </div>
                            <div class="qtyButtons">
                                <div class="qtyTitle">Children</div>
                                <input type="text" class="qtyInput" min="0" max="3" name="qtyInputChild" value="0">
                            </div>
                            <div class="qtyButtons">
                                <div class="qtyTitle">Infants</div>
                                <input type="text" class="qtyInput" min="0" max="7" name="qtyInputInfant" value="0">
                            </div>

                            <input type="number" value="" name="qtyInputTotal" id="qtyInputTotal" style="display: none;">

                        </div>
                    </div>
                </div>

                <button type="submit" class="button" href="#">Search</button>

            </div>
        </form>
        <!-- Search Section / End -->
        <div class="row mt-2">
            <div class="col-md-10">

            </div>
            <div class="col-md-2">
                <a id="filterButton" href="#filter-in-dialog" class="sign-in popup-with-zoom-anim button">Advanced Search</a>
            </div>
        </div>
        <div class="col-md-12">

            <!-- Sorting - Filtering Section -->
            <div class="row margin-bottom-25 margin-top-30">
                <div class="col-md-3 d-sm-none">
                    <!-- Layout Switcher -->
                    <div class="layout-switcher">
                        <a href="#" class="grid active"><i class="fa fa-th"></i></a>
                        <a href="<?= route_to('searchPageList', 'list') ?>" class="list"><i class="fa fa-align-justify"></i></a>
                    </div>
                </div>
                <div class="col-md-9">
                </div>
            </div>
            <!-- Sorting - Filtering Section / End -->

            <div class="row">
                <?php foreach ($searchList as $listing) : ?>
                    <div class="col-lg-3 col-md-4 col-12 margin-bottom-35">
                        <div class="listing-item-container compact" style="margin-bottom:5px;">
                            <div class="listing-item">
                                <img src="<?= $listing['coverimage'] ?>" onclick="window.location.href='<?= route_to('listingDetailsPage', base64_encode(base64_encode(base64_encode($listing['listing_id'])))) ?>'" style="display: block; width: 100%; min-height: 100%;">
                                <div class="listing-badge now-open"><?= ucfirst($listing['placekind']) ?></div>
                                <span class="like-icon"></span>
                            </div>
                        </div>
                        <a href="<?= route_to('listingDetailsPage', base64_encode(base64_encode(base64_encode($listing['listing_id'])))) ?>">
                            <span class="small">
                                <!-- <span class="superhost-tag">superhost</span> -->
                                <?= ucfirst($listing['placekind']) ?> - <?= $listing['totalBeds'] ?> beds
                            </span>
                            <span class="float-right">
                                <i class="fa fa-star" style="color:#F91942"></i> 4.3
                            </span><br>
                            <p class="listing-name text-dark"><?= $listing['title'] ?> @ <?= $listing['location'] ?>
                            </p>
                            <span><strong>₹ <?= $listing['price'] ?></strong> / night</span>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
            <!-- Pagination -->
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Pagination -->
                    <div class="pagination-container margin-top-20 margin-bottom-40">
                        <nav class="pagination">
                            <ul>
                                <li><a href="#" class="current-page">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Pagination / End -->

        </div>

    </div>
</div>
<div id="filter-in-dialog" class="zoom-anim-dialog mfp-hide">

    <div class="small-dialog-header">
        <h3>More Filter</h3>
    </div>
    <!--Tabs -->
    <div class="sign-in-form style-1">

        <!-- Login -->

        <form class="tab-content" id="amenities_rules">
            <input class="d-none" name="form_name" value="amenities_rules">
            <div class="row with-forms pb-4">
                <div class="col-12">
                    <h5>General Amenities <i class="tip" data-tip-content="These are just the amenities guests usually expect, but you can add even more after you publish."></i></h5>
                    <div class="listing-features checkboxes in-row margin-bottom-20">
                        <div>
                            <input id="amenity_essentials" type="checkbox" name="amenity_essentials">
                            <label for="amenity_essentials">
                                Essentials
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
                            <input id="amenity_wardrobe_drawers" type="checkbox" < name="amenity_wardrobe_drawers">
                            <label for="amenity_wardrobe_drawers">Wardrobe/drawers</label>
                        </div>
                        <div>
                            <input id="amenity_private_entrance" type="checkbox" name="amenity_private_entrance">
                            <label for="amenity_private_entrance">Private entrance</label>
                        </div>
                        <div>
                            <input id="amenity_sanitization_kit" type="checkbox" < name="amenity_sanitization_kit">
                            <label for="amenity_sanitization_kit">Sanitization Kit</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h5>Common Areas <i class="tip" data-tip-content="Include common areas, but don’t add spaces that aren’t on your property."></i></h5>
                    <div class="listing-features checkboxes in-row margin-bottom-20">
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
                            <input < id="guestspace_gym" type="checkbox" name="guestspace_gym">
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
                <div class="col-12 text-end formsFooterUpdate">
                    <button type="submit" class="button preview mt-0">Filter <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* @media (min-width: 768px) {
    .customContainer {
        padding-top: 180px;
        width: 1200px !important;
    }
    } */
    @media (max-width: 500px) {
        .customFilters {
            width: 100vw !important;
            max-width: 100vw !important;
        }

        .customFilters>div {
            width: 100vw !important;
            max-width: 100vw !important;
        }

        .customFilters>div a {
            width: 100vw !important;
            max-width: 100vw !important;
        }

        .customFilters>div>div {
            width: 100vw;
            max-width: 100vw;
        }

        .customFilters>div>div>div {
            width: 100vw;
            max-width: 100vw !important;
        }
    }

    @media (max-width: 768px) {
        .customContainer {
            padding-top: 50px;
        }

        .d-sm-none {
            display: none;
        }
    }

    @media (min-width: 992px) {
        .customContainer {
            padding-top: 180px;
            width: 1200px !important;
        }
    }

    @media (min-width: 1240px) {
        .customContainer {
            padding-top: 180px;
            width: 1200px !important;
        }
    }

    .datepicker2[readonly] {
        background: inherit;
    }

    .panel-dropdown .panel-dropdown-content {
        width: fit-content;
    }

    .panel-dropdown a {
        padding: 9px 14px;
        margin: auto;
        display: block;
        width: 100%;
        height: 44px;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months {
        font-size: 15px;
        width: auto;
        display: inline;
    }

    .panel-dropdown {
        position: relative;
        display: block;
    }

    .homepage_subheading span {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(0, 0, 0, 0.21);
        padding: 4px 12px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .main-search-input .fa {
        color: #123815 !important;
    }
</style>
<?= $this->endSection(); ?>