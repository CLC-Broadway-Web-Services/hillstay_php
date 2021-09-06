<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
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
<!-- </div> -->

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

<?= $this->endSection(); ?>

<?= $this->section('footerScripts'); ?>
<script>
    // $(document).ready(function() {
    if ($('#all-messages')) {
        $('#all-messages').scrollTop($('#all-messages')[0].scrollHeight);
    }
    // $('#all-messages').scrollTop($('#all-messages').height());
    // });
</script>
<?= $this->endSection(); ?>