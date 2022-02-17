<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<style>
    .messages-container-inner {
        max-height: 650px;
        min-height: 200px;
    }

    .messages-container-inner .message-content .all-messages {
        max-height: 400px;
        overflow-x: hidden;
        overflow-y: scroll;
        padding: 20px;
    }

    .message-bubble.notification {
        padding: 0;
    }

    .message-bubble.notification .message-text {
        margin-left: 0;
        margin-right: 0;
    }

    .message-bubble.notification .message-text::before {
        display: none;
    }

    .message-bubble .message-date {
        font-size: 75% !important;
        text-align: right;
    }

    #messagesContainer {
        text-align: center;
        padding: 20px;
    }
</style>
<!-- <div id="dashboard"> -->
<div class="dashboard-content">

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
                                <li class="<?php if (isset($chatBox) && $current_guest == $inbox['guest_id_64']) echo 'active-message' ?>">
                                    <a href="<?= route_to('hosting_inbox_chat', $inbox['guest_id_64']) ?>">
                                        <div class="message-avatar">
                                            <?php if ($inbox['guest_image']) : ?>
                                                <img src="<?= $inbox['guest_image'] ?>" alt="<?= $inbox['guest_name'] ?>" />
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
                                                <div class="message-bubble">
                                                    <div class="message-avatar">
                                                        <?php if ($guest['photoURL']) : ?>
                                                            <img src="<?= $guest['photoURL'] ?>" alt="<?= $message['userName'] ?>" />
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
                                                <div class="message-bubble me">
                                                    <div class="message-avatar">
                                                        <?php if ($host_image) : ?>
                                                            <img src="<?= $host_image ?>" alt="<?= $user_name ?>" />
                                                        <?php else : ?>
                                                            <img src="images/dashboard-avatar.png" alt="<?= $user_name ?>" />
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
                                                    <b>Send an request to guest for RTPCR certificate.</b><br>
                                                    <small><?= date('M d, Y, g:s:a', strtotime($message['created_at'])) ?></small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($message['notificationType'] == 'rtpcr_uploaded') : ?>
                                                <div class="alert alert-info" role="alert">
                                                    <b>Guest uploaded RTPCR report please check.</b><br>
                                                    <b><a download="RTPCR-<?= $guest["firstName"] . ' ' . $guest["lastname"] ?>" href="<?= $message['message']['rtpcr_certificate'] ?>">Download RTPCR</a></b><br>
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
                                <button type="submit" class="btn btn-primary">Send Message</button>
                                <div class="float-end" role="group" aria-label="Basic example">
                                    <a href="<?= route_to('public_profile_page', $current_guest) ?>" target="_blank" type="button" class="btn btn-info">Go to guest profile</a>
                                    <button type="button" class="btn btn-primary" onclick="requestRtpcr()">Request RTPCR</button>
                                </div>
                                <!-- <button class="button" type="submit">Send Message</button> -->
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
<!-- </div> -->

<?= $this->endSection(); ?>

<?= $this->section('footerScripts'); ?>
<script>
    // $(document).ready(function() {
    if ($('#all-messages')) {
        $('#all-messages').scrollTop($('#all-messages')[0].scrollHeight);
    }
</script>

<?php if (isset($chatBox)) : ?>
    <script>
        function requestRtpcr() {
            var formData = new FormData();
            formData.append('form_name', 'rtpcr');
            formData.append('user_email', '<?= $guest["email"] ?>');
            formData.append('user_id', '<?= $guest["uid"] ?>');
            formData.append('user_name', '<?= $guest["firstName"] . ' ' . $guest["lastname"] ?>');
            formData.append('host_id', '<?= $user_id ?>');
            formData.append('host_name', '<?= $user_name ?>');
            formData.append('listing_id', '<?= $lastBooking["listing_id"] ?>');
            formData.append('inbox_id', '<?= $inbox["id"] ?>');
            formData.append('booking_id', '<?= $lastBooking["id"] ?>');
            // add chat id from chat which in saved in the process
            formData.append('status', 'requested');
            console.log(Array.from(formData));
            $.ajax({
                url: '',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
            }).done(function(data) {
                console.log(data);
                if (JSON.parse(data)) {
                    alert(JSON.parse(data)['message']);
                    location.reload();
                }
                // console.log(JSON.parse(data));
            }).fail(function(data) {
                console.log(data);
                alert('Server error, Please try again later.');
            });
        }
        // $('#all-messages').scrollTop($('#all-messages').height());
        // });
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>