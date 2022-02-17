<?= $this->extend('Administrator/layouts/main_user') ?>

<?= $this->section('content') ?>
<style>
    .user_language:not(:last-child)::after {
        content: ',  ';
    }
</style>

<div class="nk-content-wrap">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block">
                                        <div class="nk-data data-list-s2">
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Full Name</span>
                                                    <span class="data-value"><?= $userView['firstName'] . ' ' . $userView['lastname'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Phone</span>
                                                    <span class="data-value"><?= $userView['phone'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value"><?= $userView['email'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Gender</span>
                                                    <span class="data-value text-soft"><?= $userView['gender'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Address 1</span>
                                                    <span class="data-value"><?= $userView['addressLine1'] . ' ' . $userView['city'] . ' ' . $userView['pincode'] ?><br><?= $userView['state'] . ', ' . $userView['country'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Address 2</span>
                                                    <span class="data-value"><?= $userView['addressLine2'] . ' ' . $userView['city'] . ' ' . $userView['pincode'] ?><br><?= $userView['state'] . ', ' . $userView['country'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Language</span>
                                                    <span class="data-value">
                                                        <?php if ($userView['languages']) :
                                                            $languages = json_decode($userView['languages']);
                                                            foreach ($languages as $key => $language) {
                                                                echo '<span class="user_language">' . $language . '</span>';
                                                            }
                                                        endif; ?>
                                                    </span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">About user</span>
                                                    <span class="data-value">
                                                        <?= $userView['aboutuser']  ?>
                                                    </span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            
                                        </div>
                                </div>

                            <div class="nk-data data-list-s2">
                                <div class="data-head">
                                    <h6 class="overline-title">Account Details</h6>
                                </div>
                                <?php foreach ($payment_methods as $payment) : ?>
                                    <div class="nk-data data-list-s2">
                                        <?php if ($payment['method'] == 'BANK') { ?>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Method</span>
                                                    <span class="data-value"><?= $payment['method'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Bank User Name</span>
                                                    <span class="data-value"><?= $payment['bank_user_name'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Account Number</span>
                                                    <span class="data-value"><?= $payment['bank_acc_number'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Bank Name</span>
                                                    <span class="data-value"><?= $payment['bank_name'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Bank IFSC</span>
                                                    <span class="data-value"><?= $payment['bank_ifsc'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Bank Branch</span>
                                                    <span class="data-value"><?= $payment['bank_branch'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($payment['method'] == 'UPI') { ?>
                                            <div class="data-head">
                                                <h6 class="overline-title">Account Details</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Method</span>
                                                    <span class="data-value"><?= $payment['method'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">UPI Number</span>
                                                    <span class="data-value"><?= $payment['upi_number'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($payment['isDefault'] == 1) { ?>
                                            <div class="data-head">
                                                <h6 class="overline-title">Account Default Method</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Method</span>
                                                    <span class="data-value"><?= $payment['method'] ?></span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="nk-data data-list-s2">
                                <div class="data-head">
                                    <h6 class="overline-title">Contact Details</h6>
                                </div>
                                <?php foreach ($contact_info as $contact) : ?>
                                    <div class="nk-data data-list-s2">
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Contact Pesron</span>
                                                <span class="data-value"><?= $contact['contact_person'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Primary Number</span>
                                                <span class="data-value"><?= $contact['primary_number'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Alternate Number</span>
                                                <span class="data-value"><?= $contact['alternate_number'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Default Number</span>
                                                <span class="data-value"><?= $contact['isDefault'] == 1 ? $contact['primary_number'] : ''?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>

                            </div>
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="card-inner-group" data-simplebar>
                                    <div class="card-inner">
                                        <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span><img src="<?= $userView['photoURL'] ?>"></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?= $userView['firstName'] . ' ' . $userView['lastname'] ?></span>
                                                    <span class="sub-text"><?= $userView['email'] ?></span>
                                                </div>
                                                <div class="user-action">
                                                </div>
                                        </div><!-- .user-card -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner p-0">
                                        <div class="row">
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Total Listing</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $userDataCount ?></span></a>
                                            </div>
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Active Listing</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $activeDataCount ?> </span></a>
                                            </div>
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Pending Booking</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $pendingBooking ?></span></a>
                                            </div>
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Total Booking</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $totalBookingCount ?></span></a>
                                            </div>
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Rejection Booking</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $bookingReject ?></span></a>
                                            </div>
                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Accept Booking</span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span><?= $bookingReject ?></span></a>
                                            </div>

                                            <div class="col-md-8 px-4 py-1 link-list-menu">
                                                <a class="active" href="#"><span>Total Reviews </span></a>
                                            </div>
                                            <div class="col-md-4 px-4 py-1 link-list-menu">
                                                <a href="#"><span>100</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner-group -->
                            </div><!-- card-aside -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>


<!-- Page Container END -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>