<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">

        <div id="add-listing">

            <div class="add-listing-section toggle-wrap">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-doc"></i> Basic Informations</h3>
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

                    </div>
                    <!-- Row / End -->
                </div>

            </div>

            <div class="add-listing-section margin-top-45 toggle-wrap">

                <div class="add-listing-headline">
                    <h3><i class="sl sl-icon-location"></i> Location</h3>
                    <label class="switch toggleTrigger"><i class="im im-icon-Arrow-DowninCircle"></i></label>
                </div>

                <div class="listing-section-content">
                    <div class="submit-section">

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>City</h5>
                                <select class="chosen-select-no-single">
                                    <option label="blank">Select City</option>
                                    <option>New York</option>
                                    <option>Los Angeles</option>
                                    <option>Chicago</option>
                                    <option>Houston</option>
                                    <option>Phoenix</option>
                                    <option>San Diego</option>
                                    <option>Austin</option>
                                </select>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <h5>Address</h5>
                                <input type="text" placeholder="e.g. 964 School Street">
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <h5>State</h5>
                                <input type="text">
                            </div>

                            <!-- Zip-Code -->
                            <div class="col-md-6">
                                <h5>Zip-Code</h5>
                                <input type="text">
                            </div>

                        </div>
                        <!-- Row / End -->

                    </div>
                </div>
            </div>

            <a href="#" class="button preview float-right">Update Listing <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>

    <!-- Copyrights -->
    <div class="col-md-12">
        <div class="copyrights">© 2019 Listeo. All Rights Reserved.</div>
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
</script>

<?= $this->endSection(); ?>