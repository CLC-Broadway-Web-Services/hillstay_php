<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>

<!-- Stats blocks -->
<div class="row">

    <!-- Item -->
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-stat color-4">
            <div class="dashboard-stat-content">
                <h4><?= $totalListings ?></h4> <span>Total Listings</span>
            </div>
            <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
        </div>
    </div>

    <!-- Item -->
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-stat color-1">
            <div class="dashboard-stat-content">
                <h4><?= $activeListings ?></h4> <span>Active Listings</span>
            </div>
            <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>
        </div>
    </div>

    <!-- Item -->
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-stat color-2">
            <div class="dashboard-stat-content">
                <h4></h4> <span>Total Reservations</span>
            </div>
            <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
        </div>
    </div>

    <!-- Item -->
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-stat color-3">
            <div class="dashboard-stat-content">
                <h4><?= $activeListings ?></h4> <span>Total Reviews</span>
            </div>
            <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
        </div>
    </div>

</div>

<!-- Content blocks -->
<div class="row mb-5">

    <div class="col-lg-8 col-md-12">
        <!-- Requests with Filters  -->
        <div class="dashboard-list-box margin-top-20">

            <!-- <div class="booking-requests-filter">

                <div class="sort-by">
                    <div class="sort-by-select">

                        <select data-placeholder="Default order" class="chosen-select-no-single">
                            <option>All Listings</option>
                            <option>Burger House</option>
                            <option>Tom's Restaurant</option>
                            <option>Hotel Govendor</option>
                        </select>

                    </div>
                </div>

            </div> -->

            <!-- Reply to review popup -->
            <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                <div class="small-dialog-header">
                    <h3>Send Message</h3>
                </div>
                <div class="message-reply margin-top-0">
                    <textarea cols="40" rows="3" placeholder="Your Message to Kathy"></textarea>
                    <button class="button">Send</button>
                </div>
            </div>

            <h4>Latest Requests</h4>
            <ul>

                <?php
                // echo '<pre>';
                // print_r($booking);
                // echo '</pre>';
                ?>
              

            </ul>
        </div>
        <!-- Reservations with Filters  -->
        <!-- <div class="dashboard-list-box margin-top-20">

            <div class="booking-requests-filter">

                <div class="sort-by">
                    <div class="sort-by-select">
                        <select data-placeholder="Default order" class="chosen-select-no-single">
                            <option>All Listings</option>
                            <option>Burger House</option>
                            <option>Tom's Restaurant</option>
                            <option>Hotel Govendor</option>
                        </select>
                    </div>
                </div>

            </div>

            <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                <div class="small-dialog-header">
                    <h3>Send Message</h3>
                </div>
                <div class="message-reply margin-top-0">
                    <textarea cols="40" rows="3" placeholder="Your Message to Kathy"></textarea>
                    <button class="button">Send</button>
                </div>
            </div>

            <h4>Reservations</h4>
            <ul>

                <li class="approved-booking">
                    <div class="list-box-listing bookings">
                        <div class="list-box-listing-img"><img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt="">
                        </div>
                        <div class="list-box-listing-content">
                            <div class="inner">
                                <h3>Burger House <span class="booking-status">Approved</span></h3>

                                <div class="inner-booking-list">
                                    <h5>Booking Date:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">10.12.2019 at 12:30 pm - 13:30 pm</li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Booking Details:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">2 Adults, 2 Children</li>
                                    </ul>
                                </div>

                                <div class="inner-booking-list">
                                    <h5>Client:</h5>
                                    <ul class="booking-list">
                                        <li>Kathy Brown</li>
                                        <li><a href="http://www.vasterad.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="573c36233f2e17322f363a273b327934383a">[email&#160;protected]</a>
                                        </li>
                                        <li>123-456-789</li>
                                    </ul>
                                </div>

                                <a href="#small-dialog" class="rate-review popup-with-zoom-anim"> View All</a>

                            </div>
                        </div>
                    </div>
                    <div class="buttons-to-right">
                        <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> Cancel</a>
                    </div>
                </li>

            </ul>
        </div> -->
    </div>

    <!-- Invoices -->
    <div class="col-lg-4 col-md-12">
        <!-- Notifications -->
        <div class="dashboard-list-box with-icons margin-top-20">
            <h4>Notifications</h4>
            <ul>
                <li>
                    <i class="list-box-icon sl sl-icon-layers"></i> Your listing <strong>
                        <a href="#">Hotel Govendor</a></strong>
                    has been approved!
                    <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                </li>

                <li>
                    <i class="list-box-icon sl sl-icon-star"></i> Kathy Brown left a review <div class="numerical-rating high">5.0</div> on <strong><a href="#">Burger House</a></strong>
                    <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                </li>

                <li>
                    <i class="list-box-icon sl sl-icon-heart"></i> Someone bookmarked your <strong><a href="#">Burger
                            House</a></strong> listing!
                    <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                </li>
            </ul>
        </div>
        <!-- <div class="dashboard-list-box invoices with-icons margin-top-20">
                    <h4>Invoices</h4>
                    <ul>

                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Professional Plan</strong>
                            <ul>
                                <li class="unpaid">Unpaid</li>
                                <li>Order: #00124</li>
                                <li>Date: 20/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Extended Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00108</li>
                                <li>Date: 14/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Extended Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00097</li>
                                <li>Date: 10/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Basic Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00091</li>
                                <li>Date: 30/06/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                    </ul>
                </div> -->
    </div>

</div>

<!-- <style>
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
</style> -->

<?= $this->endSection(); ?>