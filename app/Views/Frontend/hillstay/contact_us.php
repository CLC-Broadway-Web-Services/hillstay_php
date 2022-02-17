<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="clearfix"></div>

<!-- Map Container -->
<div class="contact-map margin-bottom-60">

    <!-- Google Maps -->
    <div id="singleListingMap-container">
        <div id="singleListingMap" data-latitude="40.70437865245596" data-longitude="-73.98674011230469" data-map-icon="im im-icon-Map2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7009.43155024753!2d77.2972729228145!3d28.548261629804227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sG-79%2C%20Abul%20Fazal%2C%20Enclave-II%2C!5e0!3m2!1sen!2sin!4v1642012551663!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <a href="#" id="streetView">Street View</a>
    </div>

    <!-- Google Maps / End -->


    <!-- Office -->
    <div class="address-box-container">
        <div class="address-container" data-background-image="images/our-office.jpg">
            <div class="office-address">
                <h3>Our Office</h3>
                <ul>
                    <li>G-79, Abul Fazal, Enclave-II </li>
                    <li>Kalandi Kunj Road, New Delhi</li>
                    <li>Phone +91 9818745989 </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Office / End -->

</div>

<div class="clearfix"></div>

<!-- Map Container / End -->


<!-- Container / Start -->
<div class="container">

    <div class="row">

        <!-- Contact Details -->
        <div class="col-md-4">

            <h4 class="headline margin-bottom-30">Find Us There</h4>

            <!-- Contact Details -->
            <div class="sidebar-textbox">
                <p>To travel is to live, and so we believe in at Hillstay Tours, We complete 20 successful years in the travel industry<a href="<?= route_to('about_us') ?>"> read more...</a></p>

                <ul class="contact-details">
                    <li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong><a href="tel:+91 1234567891"> <span>+91 9818745989 </span></a></li>
                    <li><i class="im im-icon-Fax"></i> <strong>Fax:</strong> <span>+91 9818745989 </span></li>
                    <li><i class="im im-icon-Globe"></i> <strong>Web:</strong> <span><a href="#">www.example.com</a></span></li>
                    <li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="mailto:info@hillstay.in"><span class="__cf_email__" data-cfemail="a2cdc4c4cbc1c7e2c7dac3cfd2cec78cc1cdcf">info@hillstay.in</span></a></span></li>
                </ul>
            </div>

        </div>

        <!-- Contact Form -->
        <div class="col-md-8">

            <section id="contact">
                <h4 class="headline margin-bottom-35">Contact Form</h4>

                <div id="contact-message"></div>

                <form method="post" action="<?= route_to('contact_us') ?>" name="contactform" id="contactform" autocomplete="on">

                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <input name="name" type="text" id="name" placeholder="Your Name" required="required" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <input name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <input name="mobile" type="number" id="mobile" placeholder="Mobile" maxlength="10" minlength="10" required="required" />
                    </div>
                    <div>
                        <input name="subject" type="text" id="subject" placeholder="Subject" required="required" />
                    </div>

                    <div>
                        <textarea name="comments" cols="40" rows="3" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
                    </div>

                    <input type="submit" class="submit button" id="liveToastBtn" value="Submit Message" />

                </form>
            </section>
        </div>
        <!-- Contact Form / End -->

    </div>

</div>
<!-- Container / End -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    <?php if (session()->getFlashdata("contact")) { ?>
        swal({
            title: "Saved",
            text: "Details saved",
            icon: "success",
        });

    <?php } ?>
</script>
<?= $this->endSection() ?>