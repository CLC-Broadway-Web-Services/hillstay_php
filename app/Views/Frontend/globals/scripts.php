<!-- Scripts -->
<script type="text/javascript" src="/public/assets/scripts/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="/public/assets/scripts/jquery-migrate-3.1.0.min.js"></script> -->
<script type="text/javascript" src="/public/assets/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/chosen.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/slick.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/waypoints.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/counterup.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="/public/assets/scripts/custom.js"></script>


<?php if (isset($leafletScripts)) : ?>
    <!-- Leaflet // Docs: https://leafletjs.com/ -->
    <script src="/public/assets/scripts/leaflet.min.js"></script>

    <!-- Leaflet Maps Scripts -->
    <script src="/public/assets/scripts/leaflet-markercluster.min.js"></script>
    <script src="/public/assets/scripts/leaflet-gesture-handling.min.js"></script>
    <script src="/public/assets/scripts/leaflet-listeo.js"></script>

    <!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
    <script src="/public/assets/scripts/leaflet-autocomplete.js"></script>
    <script src="/public/assets/scripts/leaflet-control-geocoder.js"></script>

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
    // if ($('.datepicker2')) {
    //     $(function() {
    //         $(".datepicker2").daterangepicker(calendarOptions);
    //     });
    //     // Calendar animation
    //     $('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
    //         $('.daterangepicker').addClass('calendar-animated');
    //     });
    //     $('#date-picker').on('show.daterangepicker', function(ev, picker) {
    //         $('.daterangepicker').addClass('calendar-visible');
    //         $('.daterangepicker').removeClass('calendar-hidden');
    //     });
    //     $('#date-picker').on('hide.daterangepicker', function(ev, picker) {
    //         $('.daterangepicker').removeClass('calendar-visible');
    //         $('.daterangepicker').addClass('calendar-hidden');
    //     });
    // }
</script>