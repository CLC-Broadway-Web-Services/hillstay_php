<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<div id="current_user" style="display:none;" hidden><?= json_encode($user_data) ?></div>
<div id="razorKey" style="display:none;" hidden><?= $razorKey ?></div>
<div class="container mt-5">
    <div class="dashboard-list-box">
        <div class="booking-requests-filter">
            <div class="sort-by">
                <div class="sort-by-select">
                    <select class="select2" id="resevationSelectionDropdown">
                        <option <?php if (isset($_GET['type']) && $_GET['type'] == 'new') echo 'selected' ?> value="new">Requests</option>
                        <option <?php if (isset($_GET['type']) && $_GET['type'] == 'completed') echo 'selected' ?> value="completed">Completed</option>
                        <option <?php if (isset($_GET['type']) && $_GET['type'] == 'approved') echo 'selected' ?> value="approved">Approved</option>
                        <option <?php if (isset($_GET['type']) && $_GET['type'] == 'rejected') echo 'selected' ?> value="rejected">Rejected</option>
                        <option <?php if (!isset($_GET['type']) || $_GET['type'] == '') echo 'selected' ?> value="all">All Requests</option>
                    </select>
                </div>
            </div>
        </div>
        <h4>Trips</h4>
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
                    <tr>
                        <td><?= ucfirst($booking['status_name']) ?></td>
                        <td><?= $booking['guests'] ?> Guest\s</td>
                        <td><?= date('M d, Y', strtotime($booking['check_in'])) ?> / <?= date('M d, Y', strtotime($booking['check_out'])) ?></td>
                        <td>&#8377; <?= $booking['price_total'] ?>.00</td>
                        <td><?= date('M d, Y', strtotime($booking['created_at'])) ?></td>
                        <td class="text-right">
                            <div class="btn-group" role="group">
                                <?php if ($booking['approved'] && !$booking['payment_status']) : ?>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="makeReservationPayment(this, '<?= 'booking_data_' . $booking['id'] ?>')">Make payment</button>
                                <?php endif; ?>
                                <a type="button" href="<?= route_to('account_inbox_chat', $booking['user_id_64']) ?>" class="btn btn-outline-primary btn-sm">Chat Host</a>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="showReservationDetails(<?= $booking['id'] ?>)">Details</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
                <h5 class="modal-title" id="exampleModalLabel">My Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">

                <div class="col-md-6">
                    <h4 class="headline">Booking Details</h4>
                    <table class="table table-success table-striped table-hover" id="bookingDetailsTable">
                    </table>

                </div>

                <div class="col-md-6 style-1">
                    <h4 class="headline">Guest Details</h4>
                    <div class="style-1" id="reservationGuestsAccordian">

                    </div>
                </div>

            </div>
            <div class="modal-footer" id="reservationDetailsFooter">
                <button type="button" class="btn btn-warning btn-sm" onclick="chatGuest()">Chat Host</button>
                <button type="button" class="btn btn-success btn-sm" onclick="approveRequest()">Approve</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="rejectRequest()">Reject</button>
            </div>
        </div>
    </div>
</div>

<form name="razorpay-form" id="razorpayForm" action="$callback_url" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="$merchant_order_id; ?>" />
    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="$txnid; ?>" />
    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="$description; ?>" />
    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="$surl; ?>" />
    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="$furl; ?>" />
    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="$card_holder_name; ?>" />
    <input type="hidden" name="merchant_total" id="merchant_total" value="$total; ?>" />
    <input type="hidden" name="merchant_amount" id="merchant_amount" value="$amount; ?>" />
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="/public/custom/assets/js/guest_trips.js"></script>
<?= $this->endSection(); ?>