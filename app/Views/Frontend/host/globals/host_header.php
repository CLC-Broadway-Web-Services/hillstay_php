<header id="header-container" class="fixed fullwidth">
    <!-- Header -->
    <div id="header" class="not-sticky">
        <div class="container">
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="/"><img src="/public/assets/images/logo.png" alt="" /></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li>
                            <a href="<?= route_to('hosting_dashboard_index') ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= route_to('hosting_inbox_index') ?>">Inbox</a>
                        </li>
                        <li>
                            <a href="<?= route_to('hosting_dashboard_reservations') ?>">Reservations</a>
                        </li>
                        <!-- <li>
                            <a href="<?= route_to('hosting_dashboard_calendar') ?>">Calendar</a>
                        </li> -->
                        <li>
                            <a href="<?= route_to('hosting_listings_all') ?>">Listings</a>
                        </li>
                        <!-- <li>
                            <a href="<?= route_to('hosting_dashboard_stats') ?>">Progress</a>
                        </li> -->
                        <li><a href="<?= route_to('account_help') ?>">Help</a></li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
            </div>

            <!-- Right Side Content / End -->
            <div class="right-side">
                <!-- Header Widget -->
                <div class="header-widget">

                    <div class="user-menu" id="userdropdownmenu" style="margin-right: 0">
                        <div class="user-name">
                            <span><img src="/public/assets/images/dashboard-avatar.jpg" alt="" /></span>Account
                        </div>
                        <ul>
                            <li>
                                <a href="/user/"><i class="sl sl-icon-settings"></i> Profile</a>
                            </li>
                            <li>
                                <a href="<?= route_to('account_settings') ?>"><i class="sl sl-icon-envelope-open"></i> Account</a>
                            </li>
                            <li>
                                <a href="<?= route_to('account_transaction_history') ?>"><i class="fa fa-calendar-check-o"></i> Transaction History</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="<?= route_to('hosting_listing_add_new') ?>"><i class="sl sl-icon-settings"></i> Add New Listing</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="<?= route_to('home_page') ?>"><i class="sl sl-icon-settings"></i> Switch to Travelling</a>
                            </li>
                            <li>
                                <a href="<?= route_to('logout_user') ?>"><i class="sl sl-icon-power"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <a style="margin-left: 25px; font-size: 30px; line-height: 50px" href="<?= route_to('hosting_listing_add_new') ?>" class="with-icon" title="Addd new listing" alt="Add new listing">
                        <i class="sl sl-icon-plus"></i>
                    </a>
                </div>
                <!-- Header Widget / End -->
            </div>
            <!-- Right Side Content / End -->
        </div>
    </div>
    <!-- Header / End -->
</header>