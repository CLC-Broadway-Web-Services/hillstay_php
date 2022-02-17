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

            <div class="main-search-input">

                <div class="main-search-input-item location">
                    <div id="autocomplete-container">
                        <input id="autocomplete-input" autocomplete type="text" name="location" placeholder="Location">
                    </div>
                    <a><i class="fa fa-map-marker"></i></a>
                </div>

                <div class="main-search-input-item location">
                    <div id="datepicker-container2">
                        <!-- <input type="text" id="datepicker" placeholder="Checkin - Checkout" readonly="readonly"> -->
                        <input type="text" class="datepicker2" placeholder="Checkin - Checkout" readonly="readonly">
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

                <button type="submit" class="button" routerLink="#">Search</button>
                <!-- <a href="" class="button ml-2" routerLink="#">More Filter</a> -->

            </div>
        </form>
        <!-- Search Section / End -->

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
                    <div class="fullwidth-filters customFilters">

                        <!-- Panel Dropdown / End -->
                        <!-- <div class="panel-dropdown">
                            <a href="#">Categories</a>
                            <div class="panel-dropdown-content checkboxes categories">

                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="check-1" type="checkbox" name="check" checked class="all">
                                        <label for="check-1">All Categories</label>

                                        <input id="check-2" type="checkbox" name="check">
                                        <label for="check-2">Shops</label>

                                        <input id="check-3" type="checkbox" name="check">
                                        <label for="check-3">Hotels</label>
                                    </div>

                                    <div class="col-md-6">
                                        <input id="check-4" type="checkbox" name="check">
                                        <label for="check-4">Eat & Drink</label>

                                        <input id="check-5" type="checkbox" name="check">
                                        <label for="check-5">Fitness</label>

                                        <input id="check-6" type="checkbox" name="check">
                                        <label for="check-6">Events</label>
                                    </div>
                                </div>

                                <div class="panel-buttons">
                                    <button class="panel-cancel">Cancel</button>
                                    <button class="panel-apply">Apply</button>
                                </div>

                            </div>
                        </div> -->
                        <!-- Panel Dropdown / End -->
                        <!-- Panel Dropdown -->
                        <div class="panel-dropdown wide float-right">
                            <a href="#">More Filters</a>
                            <div class="panel-dropdown-content checkboxes">

                                <!-- Checkboxes -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="check-a" type="checkbox" name="check">
                                        <label for="check-a">Elevator in building</label>

                                        <input id="check-b" type="checkbox" name="check">
                                        <label for="check-b">Friendly workspace</label>

                                        <input id="check-c" type="checkbox" name="check">
                                        <label for="check-c">Instant Book</label>

                                        <input id="check-d" type="checkbox" name="check">
                                        <label for="check-d">Wireless Internet</label>
                                    </div>

                                    <div class="col-md-6">
                                        <input id="check-e" type="checkbox" name="check">
                                        <label for="check-e">Free parking on premises</label>

                                        <input id="check-f" type="checkbox" name="check">
                                        <label for="check-f">Free parking on street</label>

                                        <input id="check-g" type="checkbox" name="check">
                                        <label for="check-g">Smoking allowed</label>

                                        <input id="check-h" type="checkbox" name="check">
                                        <label for="check-h">Events</label>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="panel-buttons">
                                    <button class="panel-cancel">Cancel</button>
                                    <button class="panel-apply">Apply</button>
                                </div>

                            </div>
                        </div>
                        <!-- Panel Dropdown / End -->

                        <!-- Panel Dropdown-->
                        <div class="panel-dropdown float-right">
                            <a href="#">Distance Radius</a>
                            <div class="panel-dropdown-content">
                                <input class="distance-radius" type="range" min="1" max="100" step="1" value="50" data-title="Radius around selected destination">
                                <div class="panel-buttons">
                                    <button class="panel-cancel">Disable</button>
                                    <button class="panel-apply">Apply</button>
                                </div>
                            </div>
                        </div>
                        <!-- Panel Dropdown / End -->

                        <!-- Sort by -->
                        <div class="sort-by">
                            <div class="sort-by-select">
                                <select data-placeholder="Default order" class="chosen-select-no-single">
                                    <option>Default Order</option>
                                    <option>Highest Rated</option>
                                    <option>Most Reviewed</option>
                                    <option>Newest Listings</option>
                                    <option>Oldest Listings</option>
                                </select>
                            </div>
                        </div>
                        <!-- Sort by / End -->

                    </div>
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
</style>
<?= $this->endSection(); ?>