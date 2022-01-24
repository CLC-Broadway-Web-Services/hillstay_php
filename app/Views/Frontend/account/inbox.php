<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<style>
    .all-messages input[type="file"] {
        height: fit-content;
        margin: 0;
    }
</style>
<div class="container mt-5">
    <div class="row">

        <!-- Listings -->
        <div class="col-lg-12 col-md-12 margin-top-0">

            <div class="messages-container margin-top-0 margin-bottom-30">
                <div class="messages-headline d-flex">
                    <?php if (isset($chatBox)) : ?>
                        <small style="flex-grow: 1;"> From: <b><?= $time::parse($lastBooking['check_in'])->toLocalizedString('MMM d, yyyy') ?></b> - to: <b><?= $time::parse($lastBooking['check_out'])->toLocalizedString('MMM d, yyyy') ?></b><br> <b><?= $lastBooking['guests'] ?></b> Guests, at <b><?= number_to_currency($lastBooking['price_total'], 'INR') ?></b>, For <b><?= $lastBooking['total_nights'] ?></b> Nights </small>
                    <?php else : ?>
                        <h4 style="flex-grow: 1;">Conversations </h4>
                    <?php endif; ?>
                    <button type="button" id="chatListMenuButton" class="hamburger hamburger--collapse" style="left: 0;">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </button>
                </div>

                <div class="messages-container-inner">

                    <!-- Messages -->
                    <div class="messages-inbox">
                        <ul>
                            <?php foreach ($inboxes as $key => $inbox) : ?>
                                <li class="<?php if (isset($chatBox) && $current_host == $inbox['host_id_64']) echo 'active-message' ?>">
                                    <a href="<?= route_to('account_inbox_chat', $inbox['host_id_64']) ?>">
                                        <div class="message-avatar">
                                            <?php if ($inbox['host_image']) : ?>
                                                <img src="<?= $inbox['host_image'] ?>" alt="<?= $inbox['guest_name'] ?>" />
                                            <?php else : ?>
                                                <img src="images/dashboard-avatar.png" alt="<?= $inbox['guest_name'] ?>" />
                                            <?php endif; ?>
                                        </div>

                                        <div class="message-by">
                                            <div class="message-by-headline">
                                                <h5><?= $inbox['guest_name'] ?></h5>
                                            </div>
                                            <p><span><?= $time::parse($inbox['updated_at'])->humanize() ?></span></p>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Messages / End -->

                    <!-- Message Content -->
                    <div class="message-content">

                        <?php if (isset($chatBox)) : ?>
                            <div class="all-messages" id="all-messages">
                                <?php foreach ($chats as $key => $message) : ?>
                                    <?php if ($message['isBookingNotification']) : ?>
                                        <div class="message-bubble notification">
                                            <div class="message-text bg-info text-white">
                                                <small><b><?= $message['listing_name'] ?></b></small><br>
                                                <small> From: <b><?= date('M d, Y', strtotime($message['checkin'])) ?></b> - to: <b><?= date('M d, Y', strtotime($message['checkout'])) ?></b></small><br>
                                                <small>For: <?= $message['total_nights'] ?> Nights & <?= $message['guests'] ?> Guests, at <?= number_to_currency($message['price_total'], 'INR') ?></small><br>
                                                <small><?= ucfirst($message['bookingStatus']) ?> at <?= date('M d, Y, H:s A', strtotime($message['created_at'])) ?></small>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if (!$message['isNotification']) : ?>
                                            <?php if ($message['messagebyuser']) : ?>
                                                <div class="message-bubble me">
                                                    <div class="message-avatar">
                                                        <?php if ($host['photoURL']) : ?>
                                                            <img src="<?= $host['photoURL'] ?>" alt="<?= $message['userName'] ?>" />
                                                        <?php else : ?>
                                                            <img src="images/dashboard-avatar.png" alt="<?= $message['userName'] ?>" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="message-text">
                                                        <p><?= $message['message'] ?></p>
                                                        <p class="message-date">
                                                            <?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="message-bubble">
                                                    <div class="message-avatar">
                                                        <?php if ($user_data['photoURL']) : ?>
                                                            <img src="<?= $user_data['photoURL'] ?>" alt="<?= $user_data['firstName'] . ' ' . $user_data['lastname'] ?>" />
                                                        <?php else : ?>
                                                            <img src="images/dashboard-avatar.png" alt="<?= $user_data['firstName'] . ' ' . $user_data['lastname'] ?>" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="message-text">
                                                        <p><?= $message['message'] ?></p>
                                                        <p class="message-date">
                                                            <?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if ($message['notificationType'] == 'rtpcr_request' && $message['message'] == 'requested') : ?>
                                                <div class="alert alert-info" role="alert">
                                                    Please upload your RTPCR certificate below.<br>
                                                    <form class="input-group mb-3 rtpcrForm" method="post" enctype="multipart/form-data">
                                                        <input class="d-none" name="rtcprForm" value="1">
                                                        <input class="d-none" name="chat_id" value="<?= $message['mid'] ?>">
                                                        <input class="d-none" name="user_id" value="<?= $inbox['guest_id'] ?>">
                                                        <input class="d-none" name="user_name" value="<?= $inbox['guest_name'] ?>">
                                                        <input class="d-none" name="host_id" value="<?= $inbox['host_id'] ?>">
                                                        <input class="d-none" name="host_name" value="<?= $inbox['host_name'] ?>">
                                                        <input class="d-none" name="booking_id" value="<?= $lastBooking['id'] ?>">
                                                        <input class="d-none" name="listing_id" value="<?= $lastBooking['listing_id'] ?>">
                                                        <input class="d-none" name="inbox_id" value="<?= $inbox['id'] ?>">
                                                        <input class="d-none" name="status" value="uploaded">
                                                        <input name="rtpcr_certificate" type="file" class="form-control" required>
                                                        <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                    </form>
                                                    <small><?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?></small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($message['notificationType'] == 'rtpcr_uploaded') : ?>
                                                <div class="alert alert-info" role="alert">
                                                    <b>Your RTPCR report uploaded successfully.</b><br>
                                                    <small><?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?></small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($message['notificationType'] == 'rtpcr_rejected') : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <b>Your RTPCR report rejected, please contact host.</b><br>
                                                    <small><?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?></small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($message['notificationType'] == 'rtpcr_approved') : ?>
                                                <div class="alert alert-success" role="alert">
                                                    <b>Your RTPCR report report is approved.</b><br>
                                                    <small><?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?></small>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <!-- Reply Area -->
                            <div class="clearfix"></div>
                            <form class="message-reply" id="message-reply" method="post">
                                <textarea cols="40" rows="3" name="message" placeholder="Your Message"></textarea>
                                <button class="button" type="submit">Send Message</button>
                            </form>
                        <?php else : ?>
                            <div id="messagesContainer">
                                <div class="message-text">
                                    <h3>Please select chat or start one</h3>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <!-- Message Content -->

                </div>

            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('footerScripts'); ?>
<script>
    // $(document).ready(function() {
    if ($('#all-messages')) {
        $('#all-messages').scrollTop($('#all-messages')[0].scrollHeight);
    }
    // $('#all-messages').scrollTop($('#all-messages').height());
    // });
    // $('.rtpcrForm').submit(function(event) {
    //     event.preventDefault();
    //     var formData = new FormData($(this)[0]);
    //     console.log(Array.from(formData));
    //     $.ajax({
    //         url: '',
    //         type: 'post',
    //         data: formData,
    //         contentType: false,
    //         processData: false
    //     }).done(function(data) {
    //         console.log(data)
    //     }).fail(function(data) {
    //         console.log(data)
    //     })
    // })
</script>
<?= $this->endSection(); ?>