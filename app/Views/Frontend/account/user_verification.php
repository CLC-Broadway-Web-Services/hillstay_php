<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row sticky-wrapper">
        <div class="col-lg-4 col-md-4">
            <div class="user-profile-titlebar mb-2">
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

            <div class="boxed-widget mt-2 mb-4 customwidget">
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
                        <?php if ($user['city'] || $user['country']) : ?>
                            <i class="sl sl-icon-user-following" style="color: green;"></i> Identity not verified
                        <?php else : ?>
                            <i class="sl sl-icon-user-following" style="color: crimson;"></i> Identity Verified
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 padding-left-30">
            <div class="row mb-3 border-bottom">
                <h3 class="d-inline">Verification</h3>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 col-12">
                    <?php if (currentUserAadhaarVerify()) : ?>
                        // aadhaardetails
                    <?php else : ?>
                        <span class="btn btn-link" onclick="aadhaarForm()" role="button">Aadhaar not found, please submit.</span>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 col-12">
                    <?php if (currentUserPancardVerify()) : ?>
                        // pancarddetails
                    <?php else : ?>
                        <span class="btn btn-link" onclick="pancardForm()" role="button">Pancard not found, please submit.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="aadhaarModal" tabindex="-1" aria-labelledby="aadhaarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content" id="aadhaarForm" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="aadhaarModalLabel">Aadhaar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-8 col-12">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label for="aadhaar_id" class="form-label">Aadhaar Number</label>
                            <input type="text" data-type="aadhaar-number" maxLength="14" class="form-control" id="aadhaar_id" name="aadhaar_id" value="<?= $verification['aadhaar_id'] ?>" placeholder="Example: 0000 0000 0000">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="aadhaar_name" class="form-label">Name on Aadhaar</label>
                            <input type="text" data-type="aadhaar-name" maxlength="100" class="form-control" id="aadhaar_name" name="aadhaar_name" value="<?= $verification['aadhaar_name'] ?>" placeholder="Your full name">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="aadhaar_dob" class="form-label">D.O.B on Aadhaar</label>
                            <input type="text" data-type="aadhaar-dob" class="form-control dateofbirth" id="aadhaar_dob" name="aadhaar_dob" value="<?= $verification['aadhaar_dob'] ?>" placeholder="Date of birth">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="aadhaar_gender" class="form-label">Gender on Aadhaar</label>
                            <select id="aadhaar_gender" data-type="aadhaar-gender" name="aadhaar_gender" class="form-select">
                                <option selected value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Transgender">Transgender</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="aadhaar_address" class="form-label">Address on Aadhaar</label>
                            <input type="text" data-type="aadhaar-address" maxlength="200" class="form-control" id="aadhaar_address" name="aadhaar_address" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="verify_placeholder mb-2 shadow">
                        <img class="rounded" src="/public/assets/images/aadhaar_front.png" id="aadhaar_front_image">
                        <button class="btn btn-primary" onclick="imageClick('aadhaar_front')">Change</button>
                        <input class="d-none" id="aadhaar_front_input" onchange="imagePreview(this, 'aadhaar_front')" type="file" name="aadhaar_front">
                    </div>
                    <div class="verify_placeholder shadow">
                        <img class="rounded" src="/public/assets/images/aadhaar_back.png" id="aadhaar_back_image">
                        <button class="btn btn-primary" onclick="imageClick('aadhaar_back')">Change</button>
                        <input class="d-none" id="aadhaar_back_input" onchange="imagePreview(this,'aadhaar_back')" type="file" name="aadhaar_back">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="pancardModel" tabindex="-1" aria-labelledby="pancardModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content" id="pancardForm" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="pancardModelLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
<style>
    .verify_placeholder {
        display: block;
        position: relative;
    }

    .verify_placeholder button {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

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
    function imageClick(id) {
        $('#' + id + '_input').click();
    }

    function imagePreview(event, id) {
        console.log(event.files[0])
        var imageFile = event.files[0];
        if (imageFile) {
            if (imageFile.type == 'image/jpeg') {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById(id + '_image');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.files[0]);
            } else {
                alert('Image/File type not supported, please upload only JPEG images');
            }
        }
        return;

    }

    function aadhaarForm() {
        var aadhaarForm = new bootstrap.Modal(document.getElementById('aadhaarModal'));
        aadhaarForm.toggle();
    }

    function pancardForm() {
        var pancardForm = new bootstrap.Modal(document.getElementById('pancardModel'));
        pancardForm.toggle();
    }
    $('[data-type="aadhaar-number"]').keyup(function() {
        var value = $(this).val();
        var maxLength = $(this).attr("maxLength");
        value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
        $(this).val(value);
        if (value.length != maxLength) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });

    $('[data-type="aadhaar-number"]').on("change, blur", function() {
        var value = $(this).val();
        var maxLength = $(this).attr("maxLength");
        if (value.length != maxLength) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });
    $('#aadhaar_gender').on('change', function() {
        var value = $(this).val();
        if (!value) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });
    $('[data-type="aadhaar-name"]').keyup(function() {
        var value = $(this).val();
        if (!value) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });
    $('.dateofbirth').on('change', function() {
        var value = $(this).val();
        if (!value) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });
    $('[data-type="aadhaar-address"]').keyup(function() {
        var value = $(this).val();
        if (!value) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });
    $('#aadhaarForm').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(Array.from(formData));
    })
    $('#pancardForm').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(Array.from(formData));
    })
</script>
<?= $this->endSection(); ?>