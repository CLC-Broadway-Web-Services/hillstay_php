<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row sticky-wrapper">
        <div class="col-lg-4 col-md-4" style="top: 20px;">
            <div class="user-profile-titlebar mb-2">
                <div class="user-profile-avatar">
                    <img id="userImage" src="<?= $user['photoURL'] ? $user['photoURL'] : '/public/assets/images/user.png' ?>" />
                </div>
                <div class="user-profile-name">
                    <h2 class="mt-0 mb-0">
                        <?= $user['firstName'] ?>
                    </h2>
                </div>
                <p></p>
            </div>

            <div class="boxed-widget margin-top-30 margin-bottom-50 customwidget">
                <ul class="listing-details-sidebar mb-3">
                    <li>
                        <?php if ($user['city'] || $user['country']) : ?>
                            <i class="fa fa-home" style="color: green;"></i> <?= $user['city'] ?> <?= $user['country'] ?>
                        <?php else : ?>
                            <i class="fa fa-home" style="color: crimson;"></i> Location not set
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($user['languages']) : ?>
                            <i class="fa fa-language" style="color: green;"></i> <?php foreach ($user['languages'] as $key => $language) {
                                                                                        echo '<span class="user_language">' . $language . '</span>';
                                                                                    } ?>
                        <?php else : ?>
                            <i class="fa fa-language" style="color: crimson;"></i> languages not set
                        <?php endif; ?>
                    </li>
                    <li>
                        <i class="sl sl-icon-speech" style="color: green;"></i> 0 reviews
                    </li>
                    <li>
                        <?php if ($user['city'] || $user['country']) : ?>
                            <i class="sl sl-icon-user-following" style="color: green;"></i> Identity not verified
                        <?php else : ?>
                            <i class="sl sl-icon-user-following" style="color: crimson;"></i> Identity Verified
                        <?php endif; ?>
                    </li>
                </ul>
                <div class="dropdown-divider mb-3"></div>
                <ul class="listing-details-sidebar">
                    <li>
                        <?php if ($user['emailVerified']) : ?>
                            <i class="sl sl-icon-check" style="color: green;"></i> Email Verified
                        <?php else : ?>
                            <i class="sl sl-icon-close" style="color: red;"></i> Email Not Verified<br>
                            <button id="verificationButton" class="btn btn-sm btn-warning text-dark" onclick="sendVerificationEmail()">Send verification email</button>
                        <?php endif; ?>
                    </li>
                    <!-- <li>
                        <?php if ($user['phoneVerified']) : ?>
                            <i class="sl sl-icon-check" style="color: green;"></i> Phone number
                        <?php else : ?>
                            <i class="sl sl-icon-close" style="color: red;"></i> Phone number
                        <?php endif; ?>
                    </li> -->
                </ul>
                <p class="mt-5">
                    <?= $user['aboutuser'] ?>
                </p>
            </div>
        </div>
        <!-- Sidebar / End -->

        <!-- Content ================================================== -->
        <div class="col-lg-8 col-md-8 padding-left-30">
            <!-- MEDICAL DATA -->
            <div class="row mb-5">
                <div class="col-12 ml-4" style="min-height: 40px;">
                    <h3 class="d-inline">Medical Data</h3>
                </div>
                <?php if ($user['medical_history_id'] && isset($medical)) : ?>
                    <div id="medicalDetailsBlock">
                        <hr class="mb-3">
                        <div class="col-12 col-md-12">
                            <h5>Do you have any of the following flu like symtoms:</h5>
                            <ul class="listing-features checkboxes margin-top-0">
                                <?php if ($medical['flu_fever']) : ?>
                                    <li>Fever</li>
                                <?php endif; ?>
                                <?php if ($medical['flu_cough']) : ?>
                                    <li>Cough</li>
                                <?php endif; ?>
                                <?php if ($medical['flu_sore_throat']) : ?>
                                    <li>Sore Throat</li>
                                <?php endif; ?>
                                <?php if ($medical['flu_runny_nose']) : ?>
                                    <li>Runny Nose</li>
                                <?php endif; ?>
                                <?php if ($medical['flu_shortness_of_breath']) : ?>
                                    <li>Shortness of Breath</li>
                                <?php endif; ?>
                                <?php if ($medical['flu_others']) : ?>
                                    <br>
                                    <li>Others:- <?= $medical['flu_others'] ?></li>
                                <?php endif; ?>
                                <?php if (!$medical['flu_fever'] && !$medical['flu_cough'] && !$medical['flu_sore_throat'] && !$medical['flu_runny_nose'] && !$medical['flu_shortness_of_breath'] && !$medical['flu_others']) : ?>
                                    <li>NO</li>
                                <?php endif; ?>
                            </ul>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Do you have a chronic medical condition such as diabetes, hypertension, cancer, immune
                                compromising disorder?</h5>
                            <?php if ($medical['chronic_specify']) : ?>
                                <p><?= $medical['chronic_specify'] ?></p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Are you currently on any medication?</h5>
                            <?php if ($medical['medication_specify']) : ?>
                                <p><?= $medical['medication_specify'] ?></p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Have you been vaccinated for Covid-19?</h5>
                            <?php if ($medical['covid_19'] && $medical['covid_19_first_dose']) : ?>
                                <p>
                                    <?php if ($medical['covid_19_first_dose']) : ?>
                                        <a class="text-primary" href="/<?= $medical['covid_19_first_dose'] ?>" target="_blank">View first dose certificate</a>
                                    <?php endif; ?>
                                    <?php if ($medical['covid_19_first_dose'] && $medical['covid_19_second_dose']) : ?>
                                        <br><a class="text-primary" href="/<?= $medical['covid_19_second_dose'] ?>" target="_blank">View second dose certificate</a>
                                    <?php endif; ?>
                                </p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Do you have anyone living with you who is above 60 years of age?</h5>
                            <?php if ($medical['above_60_specify']) : ?>
                                <p><?= $medical['above_60_specify'] ?></p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Do you have anyone living with you who is suffering from low immunity or chronic disease
                                (diabetes, hypertension, cacer, etc.)</h5>
                            <?php if ($medical['living_with_specify']) : ?>
                                <p><?= $medical['living_with_specify'] ?></p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <div class="col-12 col-md-12">
                            <h5>Do you have health insurance?</h5>
                            <?php if ($medical['insurance_data']) : ?>
                                <p><?= $medical['insurance_data'] ?></p>
                            <?php else : ?>
                                <p>NO</p>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php else: ?>
                    <b class="text-primary">Medical Data not submitted</b>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<style>
    .user_language:not(:last-child)::after {
        content: ', '
    }
</style>

<?= $this->endSection(); ?>
<?= $this->section('footerScripts'); ?>
<?= $this->endSection(); ?>