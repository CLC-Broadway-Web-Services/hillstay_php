<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row sticky-wrapper">
        <!-- Sidebar ================================================== -->
        <div class="col-lg-4 col-md-4" style="top: 100px;">
            <div class="user-profile-titlebar mb-5">
                <div class="user-profile-avatar">
                    <img id="userImage" src="<?= $user['photoURL'] ? $user['photoURL'] : '/public/assets/images/user.png' ?>" />
                </div>
                <div class="user-profile-name">
                    <h2 class="mt-0 mb-0">
                        <?= $user['firstName'] ?>
                    </h2>
                    <span><a href="<?= route_to('account_profile_edit') ?>">Edit Profile</a></span>
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
                <div class="col-12 ml-4 mb-4" style="min-height: 50px;">
                    <h3 class="d-inline">Medical Data</h3>
                    <button class="button d-inline float-end" onclick="toggleMedicalForm()">
                        Add/Edit Medical Data <i class="fa fa-angle-right"></i>
                    </button>
                </div>
                <input id="isMedicalData" value="<?= $user['medical_history_id'] && isset($medical) ? 'true' : 'false' ?>" style="display:none;">

                <?php if ($user['medical_history_id'] && isset($medical)) : ?>
                    <div id="medicalDetailsBlock" class="<?= $user['medical_history_id'] && isset($medical) ? '' : 'd-none' ?>">
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
                <?php endif; ?>

                <form class="<?= $user['medical_history_id'] && isset($medical) ? 'd-none' : '' ?>" id="medicalDetailsForm" enctype="multipart/form-data">
                    <?php if ($user['medical_history_id'] && isset($medical)) : ?>
                        <input name="umid" value="<?= $medical['umid'] ?>" style="display:none;">
                    <?php endif; ?>
                    <input name="form_name" value="medical_data" style="display:none;">
                    <hr class="mb-3">
                    <div class="col-12">
                        <h4>Do you have any of the following flu like symtoms:</h4>
                        <ul class="checkboxes margin-top-0 d-flex">
                            <li>
                                <input id="flu_fever" <?= $medical['flu_fever'] ? 'checked' : '' ?> type="checkbox" name="flu_fever">
                                <label for="flu_fever">Fever</label>
                            </li>
                            <li>
                                <input id="flu_cough" <?= $medical['flu_cough'] ? 'checked' : '' ?> type="checkbox" name="flu_cough">
                                <label for="flu_cough">Cough</label>
                            </li>
                            <li>
                                <input id="flu_sore_throat" <?= $medical['flu_sore_throat'] ? 'checked' : '' ?> type="checkbox" name="flu_sore_throat">
                                <label for="flu_sore_throat">Sore Throat</label>
                            </li>
                            <li>
                                <input id="flu_runny_nose" <?= $medical['flu_runny_nose'] ? 'checked' : '' ?> type="checkbox" name="flu_runny_nose">
                                <label for="flu_runny_nose">Runny Nose</label>
                            </li>
                            <li>
                                <input id="flu_shortness_of_breath" <?= $medical['flu_shortness_of_breath'] ? 'checked' : '' ?> type="checkbox" name="flu_shortness_of_breath">
                                <label for="flu_shortness_of_breath">Shortness of Breath</label>
                            </li>
                        </ul>
                        <div>
                            <label>Others, please specify:</label>
                            <input name="flu_others" type="text" value="<?= $medical['flu_others'] ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Do you have a chronic medical condition such as diabetes, hypertension, cancer, immune
                            compromising disorder?</h4>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['chronic_specify'] ? 'checked' : '' ?> value="1" name="chronic" onchange="onchangeRadio(this, 'chronic_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['chronic_specify'] ? '' : 'checked' ?> value="0" name="chronic" onchange="onchangeRadio(this, 'chronic_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div id="chronic_specify" <?= $medical['chronic_specify'] ? '' : 'style="display:none;"' ?>>
                            <label>specify:</label>
                            <input name="chronic_specify" type="text" value="<?= $medical['chronic_specify'] ?>" id="chronic_input">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Are you currently on any medication?</h4>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['medication_specify'] ? 'checked' : '' ?> value="1" name="medication" onchange="onchangeRadio(this, 'medication_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['medication_specify'] ? '' : 'checked' ?> value="0" name="medication" onchange="onchangeRadio(this, 'medication_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div id="medication_specify" <?= $medical['medication_specify'] ? '' : 'style="display:none;"' ?>>
                            <label>Please specify:</label>
                            <input name="medication_specify" type="text" value="<?= $medical['medication_specify'] ?>" id="medication_input">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Have you been vaccinated for Covid-19?</h4>
                        <?= $medical['covid_19'] ? '<small class="text-danger">If you select no, your old uploaded certificates will be deleted automatically</small>' : '' ?>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['covid_19'] ? 'checked' : '' ?> value="1" name="covid_19" onchange="onchangeRadio(this, 'covid_19_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['covid_19'] ? '' : 'checked' ?> value="0" name="covid_19" onchange="onchangeRadio(this, 'covid_19_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div <?= $medical['covid_19'] ? '' : 'style="display:none;"' ?> id="covid_19_specify">
                            <div class="form-group">
                                <label>First Dose</label>
                                <input name="covid_19_first_dose" type="file" value="" id="covid_19_first_dose">
                            </div>
                            <div class="form-group">
                                <label>Second Dose</label>
                                <input name="covid_19_second_dose" type="file" value="" id="covid_19_second_dose">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Do you have anyone living with you who is above 60 years of age?</h4>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['above_60_specify'] ? 'checked' : '' ?> value="1" name="above_60" onchange="onchangeRadio(this, 'above_60_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['above_60_specify'] ? '' : 'checked' ?> value="0" name="above_60" onchange="onchangeRadio(this, 'above_60_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div id="above_60_specify" <?= $medical['above_60_specify'] ? '' : 'style="display:none;"' ?>>
                            <label>Please specify:</label>
                            <input name="above_60_specify" type="text" value="<?= $medical['above_60_specify'] ?>" id="above_60_input">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Do you have anyone living with you who is suffering from low immunity or chronic disease
                            (diabetes, hypertension, cacer, etc.)</h4>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['living_with_specify'] ? 'checked' : '' ?> value="1" name="living_with" onchange="onchangeRadio(this, 'living_with_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['living_with_specify'] ? '' : 'checked' ?> value="0" name="living_with" onchange="onchangeRadio(this, 'living_with_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div id="living_with_specify" <?= $medical['living_with_specify'] ? '' : 'style="display:none;"' ?>>
                            <label>Please specify:</label>
                            <input name="living_with_specify" type="text" value="<?= $medical['living_with_specify'] ?>" id="living_with_input">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>Do you have health insurance?</h4>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['insurance_data'] ? 'checked' : '' ?> value="1" name="insurance" onchange="onchangeRadio(this, 'insurance_')">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" <?= $medical['insurance_data'] ? '' : 'checked' ?> value="0" name="insurance" onchange="onchangeRadio(this, 'insurance_')">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div id="insurance_specify" <?= $medical['insurance_data'] ? '' : 'style="display:none;"' ?>>
                            <label>Please specify:</label>
                            <input name="insurance_data" type="text" value="<?= $medical['insurance_data'] ?>" id="insurance_input">
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button class="button float-right" type="submit" id="medicalDataSubmitButton">
                            Save
                        </button>
                    </div>
                </form>
                <?php
                // echo '<pre>';
                // print_r($medical);
                // echo '</pre>';
                ?>
            </div>
            <!-- Reviews -->
            <div id="listing-reviews" class="listing-section">
                <h3 class="margin-top-60 margin-bottom-20">60 Reviews</h3>

                <div class="clearfix"></div>

                <!-- Reviews -->
                <section class="comments listing-reviews">
                    <ul>
                        <li>
                            <div class="avatar">
                                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" />
                            </div>
                            <div class="comment-content">
                                <div class="arrow-comment"></div>
                                <div class="comment-by">
                                    Kathy Brown
                                    <div class="comment-by-listing">
                                        on <a href="#">Burger House</a>
                                    </div>
                                    <span class="date">June 2019</span>
                                    <div class="star-rating" data-rating="5"></div>
                                </div>
                                <p>
                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                    Nam posuere tristique sem, eu ultricies tortor imperdiet
                                    vitae. Curabitur lacinia neque non metus
                                </p>
                            </div>
                        </li>
                    </ul>
                </section>

            </div>

        </div>
    </div>
</div>

<style>
    .panel-dropdown .panel-dropdown-content {
        width: fit-content;
    }

    .panel-dropdown a {
        padding: 9px 14px;
        margin: auto;
        display: block;
        width: 100%;
        height: 44px;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months {
        font-size: 15px;
        width: auto;
        display: inline;
    }

    .panel-dropdown {
        position: relative;
        display: block;
    }

    .homepage_subheading span {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(0, 0, 0, 0.21);
        padding: 4px 12px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .main-search-input .fa {
        color: #123815 !important;
    }

    .user_language:not(:last-child)::after {
        content: ', '
    }
</style>

<?= $this->endSection(); ?>
<?= $this->section('footerScripts'); ?>
<script>
    function toggleMedicalForm() {
        if ($('#isMedicalData').val() == 'true') {
            if ($('#medicalDetailsBlock').hasClass('d-none')) {
                $('#medicalDetailsBlock').removeClass('d-none');
                $('#medicalDetailsForm').addClass('d-none');
            } else {
                $('#medicalDetailsBlock').addClass('d-none');
                $('#medicalDetailsForm').removeClass('d-none');
            }
        }
    }

    function onchangeRadio(event, id) {
        console.log(event.value, id)
        var block = $('#' + id + 'specify');
        var input = $('#' + id + 'input');
        console.log(block)
        console.log(input)
        if (event.value == 1) {
            block.show();
            input.attr('required', 'required');
        } else {
            input.removeAttr('required');
            block.hide();
        }
    }

    function sendVerificationEmail() {
        var button = $('#verificationButton');
        button.html('Sending Email ...');
        var formData = new FormData();
        formData.append('form_name', 'send_email_verification');
        $.ajax({
            url: '',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const response = JSON.parse(data);
                if (response) {
                    alert('Email sent succesfully, please check and verify your email.');
                } else {
                    alert('There is some error you an verification email, please try again later.');
                }
            },
            error: function(data) {
                console.log(data);
                alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-PI-SRV-089');
            }
        });
        button.html('Send verification email');
    }
    $('#medicalDetailsForm').submit(function(event) {
        event.preventDefault();
        var button = $('#medicalDataSubmitButton');
        button.html('Saving, Please wait ...');
        const formData = new FormData($(this)[0]);
        console.log(Array.from(formData));
        // return;
        $.ajax({
            url: '',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // console.log(data);
                const response = JSON.parse(data);
                console.log(response);
                if (response) {
                    location.reload();
                } else {
                    alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-MD-PRO-079');
                }
            },
            error: function(data) {
                console.log(data);
                alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-MD-PRO-070');
            }
        });
        button.html('Save');
    })
</script>
<?= $this->endSection(); ?>