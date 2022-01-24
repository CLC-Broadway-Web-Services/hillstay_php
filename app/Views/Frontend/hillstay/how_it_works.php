<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>

<!-- Container -->
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <h3 class="headline centered margin-bottom-35 margin-top-70">How It Works <span>Know more about how it works</span></h3>
        </div>

        <div class="col-md-4">

            <!-- Image Box -->
            <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="images/popular-location-01.jpg">
                <div class="img-box-content visible">
                    <h4>New York </h4>
                    <span>14 Listings</span>
                </div>
            </a>

        </div>

        <div class="col-md-8">

            <!-- Image Box -->
            <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="images/popular-locion-02.jpg">
                <div class="img-box-content visible text-white">
                <p class="mx-5">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                     specimen book. It has survived not only five centuries, but also the leap into
                      electronic typesetting, remaining essentially unchanged. It was popularised
                       in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus 
                        PageMaker including versions of Lorem Ipsum.
                  </p>
                </div>
            </a>

        </div>

        <div class="col-md-8">

            <!-- Image Box -->
            <a href="listings-list-with-sidebar.html" class="img-box" data-background-image="images/popular-lation-03.jpg">
                <div class="img-box-content visible">
                <p class="mx-5">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                     specimen book. It has survived not only five centuries, but also the leap into
                      electronic typesetting, remaining essentially unchanged. It was popularised
                       in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus 
                        PageMaker including versions of Lorem Ipsum.
                  </p>
                </div>
            </a>

        </div>

        <div class="col-md-4">

            <!-- Image Box -->
            <a href="#" class="img-box" data-background-image="images/popular-location-04.jpg">
                <div class="img-box-content visible">
                    <h4>Miami</h4>
                    <span>9 Listings</span>
                </div>
            </a>

        </div>

    </div>
</div>
<!-- Container / End -->


<!-- Flip banner -->
<a href="listings-half-screen-map-list.html" class="flip-banner parallax margin-top-65" data-background="images/slider-bg-02.jpg" data-color="#f91942" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
    <div class="flip-banner-content">
        <h2 class="flip-visible">Expolore top-rated attractions nearby</h2>
        <h2 class="flip-hidden">Browse Listings <i class="sl sl-icon-arrow-right"></i></h2>
    </div>
</a>
<!-- Flip banner / End -->
<?= $this->endSection(); ?>