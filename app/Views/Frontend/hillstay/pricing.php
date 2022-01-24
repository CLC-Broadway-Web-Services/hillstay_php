<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Pricing</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Pricing</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>

<!-- Content
================================================== -->
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8 col-md-8 padding-right-30">

            <div class="pb-2 border-bottom" id="service-fee">
                <h3>Hillstay service fees</h3>
            </div>

            <!-- Overview -->
            <div id="listing-overview" class="listing-section mt-4">

                <!-- Description -->

                <p>
                    To help Hillstay run smoothly and to cover the cost of services like 24/7 customer support, we charge a service fee when a booking is confirmed.</p>
                <p>
                    There are 2 different fee structures for stays: a split fee and a Host-only fee.</p>
                <h2>1. Split fee</h2>
                <p>This fee structure is the most common and is split between the Host and the guest.</p>
                <h3>Host fee</h3>
                <p>Most Hosts pay a 3% fee, but some pay more, including:</p>
                <ul>
                    <li>Hillstay Plus Hosts</li>
                    <li>Hosts with listings in Italy</li>
                    <li>Hosts with Super Strict cancellation policies</li>
                </ul>
                <p>This fee is calculated from the booking subtotal (nightly rate + cleaning fee + additional guest fee if applicable – excluding Hillstay fees and taxes) and is automatically deducted from the Host payout.</p>
                <h3>To review the service fee for a booking:</h3>
                <ol>
                    <li>Go to Transaction history</li>
                    <li>Select the reservation code</li>
                    <li>Under Payout, find the Hillstay Service Fee</li>
                </ol>
                <h4>Guest fee</h4>
                <p>Most guest service fees are under 14.2% of the booking subtotal (nightly rate + cleaning fee + additional guest fee if applicable – excluding Hillstay fees and taxes). This fee varies based on a variety of factors and is shown during checkout before you book so you know what to expect.</p>
                <h3>2. Host-only fee</h3>
                <p>With this structure, the entire fee is deducted from the Host payout. It’s typically 14–16%, though Hillstay Plus Hosts and Hosts with Super Strict cancellation policies may pay more. For listings in mainland China, it’s 10%.</p>

                <p>This fee is mandatory for hotels and a few other types of Hosts, such as software-connected Hosts – unless most of their listings are in the USA, Canada, the Bahamas, Mexico, Argentina, Taiwan, or Uruguay.</p>

                <h4>VAT charges</h4>
                <p>Depending on the laws of the jurisdiction involved, VAT may be charged on top of the above fees. The service fee includes the VAT where applicable.</p>
                <div class="clearfix"></div>
            </div>

            <!-- Listing Nav -->
            <div id="how-price-work" class="pb-2 border-bottom">
                <h3>How pricing works</h3>
            </div>

            <!-- Overview -->
            <div id="listing-overview" class="listing-section mt-4">

                <!-- Description -->

                <p>
                    They say a journey of a thousand miles begins with a single trip request. So, how does the pricing work for all of this? The total price of your Hillstay reservation is based on the nightly rate set by the Host, plus fees or costs determined by either the Host or Hillstay.
                <p>
                    There are 2 different fee structures for stays: a split fee and a Host-only fee.</p>
                <h2>Types of fees</h2>
                <p><b>Hillstay service fee:</b> Guest service fee charged by Hillstay – this provides 24/7 community support and helps ensure the system runs smoothly.</p>
                <p><b>Cleaning fee:</b> Charged by some Hosts to cover the cost of cleaning their space (applicable to all countries except China).</p>
                <p><b>Cleaning fee:</b> Charged by some Hosts to cover the cost of cleaning their space (applicable to all countries except China).</p>
                <p><b>Extra guest fee:</b> Charged by some Hosts for each additional guest beyond a set number.</p>
                <p><b>Security deposit:</b> Some reservations may require a security deposit requested by the Host or Hillstay – find out more about security deposits.</p>
                <p><b>Value Added Tax (VAT, JCT and GST):</b> Charged to guests who live in certain countries – find out more about VAT.</p>
                <p><b>Local taxes:</b> Charged based on the location of the Host's place – find out more about local taxes.</p>
                <h3>Payment</h3>
                <p>You’ll be charged once a Host accepts your reservation request or immediately if you use Instant Book. You may be able to split the total cost of your reservation across multiple payments if your reservation meets specific criteria, or you can pay the full amount in one go.</p>

                <div class="clearfix"></div>
            </div>
            <!-- Listing Nav -->
            <div id="serbvice-refund" class="mt-5 border-bottom">
                <h3>Service fee refunds</h3>
            </div>

            <!-- Overview -->
            <div id="listing-overview" class="listing-section mt-4">

                <!-- Description -->

                <p>If you need to cancel (It’s okay, things happen!), you may be able to receive a refund on your entire reservation, including the service fee. So how does it work? </p>
                <p>Most importantly: check your reservation’s cancellation policy to find out if the service fee is refundable. The service fee is refundable if you cancel before your reservation’s free cancellation period ends (or any time before check-in for reservations in Italy and South Korean travellers in some cases) or if the Host decides to refund you in full after you cancel.</p>
                <h3>Refunds for nightly rates and other fees</h3>
                <p>Your Host’s cancellation policy still applies to any other fees associated with your reservation. Find out how cancellations work for stays to get more details about what's refundable.</p>

                <div class="clearfix"></div>
            </div>
            <!-- Listing Nav -->
            <div id="cleaning" class="mt-5 border-bottom">
                <h3>Cleaning fees</h3>
            </div>

            <!-- Overview -->
            <div id="listing-overview" class="listing-section mt-4">

                <!-- Description -->

                <p>Who doesn’t like arriving at a clean and tidy space? A cleaning fee is a one-off charge for cleaning the space you stay in and is set by the Host. It’s an extra amount on top of the nightly rate when you book a listing. This fee covers the extra expenses Hosts incur when getting their place ready for guests to arrive or after they leave.</p>
                <h3>Things to know about cleaning fees</h3>
                <ul>
                    <li>In the listing search results, you'll notice a nightly rate that includes the cleaning fee divided by the total number of nights of the trip. When you make a trip request, the nightly rate and the cleaning fee will be listed separately in the price breakdown.</li>
                    <li>The cleaning fee is part of the booking total and is not returned to guests at the end of the trip.</li>
                </ul>
                <div class="clearfix"></div>
            </div>

        </div>


        <!-- Sidebar
		================================================== -->
        <div class="col-lg-4 col-md-4">

            <!-- Message Vendor -->
            <div id="booking-widget-anchor" class="boxed-widget booking-widget message-vendor margin-top-35">
                <h3><i class="fa fa-envelope-o"></i><a href="service-fee">Hillstay service fees</a></h3>
                <div class="row with-forms  margin-top-0"></div>
                <h3><i class="fa fa-envelope-o"></i><a href="how-price-work">How pricing works</a></h3>
                <div class="row with-forms  margin-top-0"></div>
                <h3><i class="fa fa-envelope-o"></i><a href="serbvice-refund">Service fee refunds</a></h3>
                <div class="row with-forms  margin-top-0"></div>
                <h3><i class="fa fa-envelope-o"></i><a href="cleaning">Cleaning fees</a></h3>
                <div class="row with-forms  margin-top-0"></div>

                <div class="captcha-holder">
                    <!-- Recaptcha goes here -->
                </div>
            </div>
            <!-- Book Now / End -->

        </div>
        <!-- Sidebar / End -->

    </div>
</div>
<!-- Container / End -->
<?= $this->endSection(); ?>