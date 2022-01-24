<!-- Scripts -->
<script type="text/javascript" src="/public/assets/scripts/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="/public/assets/css/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/public/assets/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/chosen.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/slick.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/waypoints.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/counterup.min.js"></script>
<!-- <script type="text/javascript" src="/public/assets/scripts/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="/public/assets/scripts/tooltips.min.js"></script>
<!-- <script type="text/javascript" src="/public/assets/scripts/lottie.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/alt-alert.min.js"></script> -->
<script type="text/javascript" src="/public/assets/scripts/custom.js"></script>



<?php if (isset($leafletScripts)) : ?>
    <!-- Leaflet // Docs: https://leafletjs.com/ -->
    <!-- <script src="/public/assets/scripts/leaflet.min.js"></script> -->

    <!-- Leaflet Maps Scripts -->
    <!-- <script src="/public/assets/scripts/leaflet-markercluster.min.js"></script> -->
    <!-- <script src="/public/assets/scripts/leaflet-gesture-handling.min.js"></script> -->
    <!-- <script src="/public/assets/scripts/leaflet-listeo.js"></script> -->

    <!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
    <!-- <script src="/public/assets/scripts/leaflet-autocomplete.js"></script> -->
    <!-- <script src="/public/assets/scripts/leaflet-control-geocoder.js"></script> -->

<?php endif; ?>

<!-- Typed Script -->
<script type="text/javascript" src="/public/assets/scripts/typed.js"></script>
<script type="text/javascript" src="/public/assets/scripts/readmore.min.js"></script>

<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
<script src="/public/assets/scripts/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- <script src="/public/assets/scripts/daterangepicker.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->

<script>
    var calendarOptions = {
        mode: "range",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today"
    }
</script>
<?php if (isset($pageJSbefore)) {
    echo $pageJSbefore;
} ?>
<?php if (isset($pageJS)) {
    echo $pageJS;
} ?>

<script>
    if ($('.readMore')) {
        $('.readMore').readmore({
            speed: 75,
            moreLink: '<a class="readMoreLink" href="#">Read more</a>',
            lessLink: '<a class="readMoreLink" href="#">Read less</a>'
        });
    }
    if ($('.datepicker2')) {
        $(".datepicker2").flatpickr(calendarOptions);
    }
    if ($('.dateofbirth')) {
        $(".dateofbirth").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(-6570)
        });
    }
    
	$("#autocomplete-input").on("keyup", function () {
        // https://community.algolia.com/places/pricing.html
	})
</script>