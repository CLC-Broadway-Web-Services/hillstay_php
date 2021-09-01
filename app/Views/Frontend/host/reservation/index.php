<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col">
        <div class="dashboard-list-box">
            <div class="booking-requests-filter">
                <div class="sort-by">
                    <div class="sort-by-select">
                        <select class="select2" id="resevationSelectionDropdown">
                            <option <?php if (isset($_GET['type']) && $_GET['type'] == 'new') echo 'selected' ?> value="new">New Requests</option>
                            <option <?php if (isset($_GET['type']) && $_GET['type'] == 'completed') echo 'selected' ?> value="completed">Completed Bookings</option>
                            <option <?php if (isset($_GET['type']) && $_GET['type'] == 'approved') echo 'selected' ?> value="approved">Approved Bookings</option>
                            <option <?php if (isset($_GET['type']) && $_GET['type'] == 'rejected') echo 'selected' ?> value="rejected">Rejected requests</option>
                            <option <?php if (!isset($_GET['type']) || $_GET['type'] == '') echo 'selected' ?> value="all">All Requests</option>
                        </select>
                    </div>
                </div>
            </div>
            <h4>Resevations</h4>
        </div>
        <div class="table-responsive mt-4 card" style="overflow: visible;">
            <table class="basic-table">
                <thead>
                    <tr>
                        <th scope="col">Status</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Check-in/Check-out</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Dated</th>
                        <th scope="col" class="text-right"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($bookings_data as $booking) : ?>
                        <div id="booking_data_<?= $booking['id'] ?>" style="display:none;"><?= json_encode($booking) ?></div>
                        <tr class="<?= $lastLogin < $booking['created_at'] || $lastLogin < $booking['created_at'] ? 'bg-warning' : '' ?>">
                            <td><?= ucfirst($booking['status_name']) ?></td>
                            <td><?= $booking['guests'] ?> Guest\s</td>
                            <td><?= date('M d, Y', strtotime($booking['check_in'])) ?> / <?= date('M d, Y', strtotime($booking['check_out'])) ?></td>
                            <td>&#8377; <?= $booking['price_total'] ?>.00</td>
                            <td><?= date('M d, Y', strtotime($booking['created_at'])) ?></td>
                            <td class="text-right">
                                <div class="btn-group" role="group">
                                    <a type="button" href="<?= route_to('hosting_inbox_chat', $booking['user_id_64']) ?>" class="btn btn-success btn-sm">Chat Guest</a>
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="showReservationDetails(<?= $booking['id'] ?>)">Details</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .basic-table th {
        padding-left: 8px;
        padding-right: 2px;
        min-width: 90px;
    }

    .basic-table td {
        padding-left: 8px;
        padding-right: 2px;
    }

    .payoutcolumn {
        min-width: 150px;
    }

    .myiconbtn:after {
        content: none;
    }

    .dropdown-item {
        font-size: 16px;
        line-height: 25px
    }

    #reservationDetailsModal {
        z-index: 9999;
    }

    #reservationGuestsAccordian .toggle-container {
        padding: 0 !important;
    }

    #reservationGuestsAccordian table {
        margin-bottom: 0 !important;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('footerScripts'); ?>
<div class="modal fade" id="reservationDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservations Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">

                <div class="col-md-6">
                    <h4 class="headline">Booking Details</h4>
                    <table class="table table-success table-striped table-hover" id="bookingDetailsTable">
                        <!-- <tbody>
                            <tr>
                                <td>Status</td>
                                <td>listing-status_name</td>
                            </tr>
                            <tr>
                                <td>Nights</td>
                                <td>listing-total_nights</td>
                            </tr>
                            <tr>
                                <td>Price <small>Per night</small></td>
                                <td>listing-price_per_night</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>listing-price_total</td>
                            </tr>
                            <tr>
                                <td>Service Charges</td>
                                <td>listing-servicePrices</td>
                            </tr>
                            <tr>
                                <td>Guests</td>
                                <td>listing-guest_adults, listing-guest_chldren, listing-guest_infants</td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td>listing-discount_amount</td>
                            </tr>
                            <tr>
                                <td>Discount Type</td>
                                <td>listing-discount_type</td>
                            </tr>
                        </tbody> -->
                    </table>

                </div>

                <div class="col-md-6 style-1">
                    <h4 class="headline">Guest Details</h4>
                    <div class="style-1" id="reservationGuestsAccordian">

                        <!-- <div class="toggle-wrap">
                            <span class="trigger "><a href="#">listing-guest_name<i class="sl sl-icon-plus"></i></a></span>
                            <div class="toggle-container">
                                <table class="table table-success table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Age</td>
                                            <td>listing-guest_age</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>listing-guest_gender</td>
                                        </tr>
                                        <tr>
                                            <td>Any Flu Symptomns</td>
                                            <td>listing-flu_symptoms</td>
                                        </tr>
                                        <tr>
                                            <td>Any Chronic Medical Condition</td>
                                            <td>listing-chronic_medical_condition</td>
                                        </tr>
                                        <tr>
                                            <td>On Medication</td>
                                            <td>listing-on_medication</td>
                                        </tr>
                                        <tr>
                                            <td>Health Insurance</td>
                                            <td>listing-health_insurance</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                </div>

            </div>
            <div class="modal-footer" id="reservationDetailsFooter">
                <button type="button" class="btn btn-warning btn-sm" onclick="chatGuest()">Chat Guest</button>
                <button type="button" class="btn btn-success btn-sm" onclick="approveRequest()">Approve</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="rejectRequest()">Reject</button>
            </div>
        </div>
    </div>
</div>

<script src="/public/custom/assets/js/host_reservations.js"></script>
<?= $this->endSection(); ?>