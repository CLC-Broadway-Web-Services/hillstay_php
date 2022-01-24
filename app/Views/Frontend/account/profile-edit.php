<?= $this->extend('Frontend/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar ================================================== -->
        <form class="col-lg-4 col-md-4 userImage text-center" id="imageForm">
            <input hidden class="d-none" name="form_name" value="profile_image">
            <img id="userImage" class="shadow" src="<?= $user['photoURL'] ? $user['photoURL'] : '/public/assets/images/user.png' ?>" />
            <input hidden type="file" class="d-none" id="photoURL" name="photoURL" onchange="previewImage(this)">
            <div class="btn-group mt-2" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" onclick="uploadImageButton()">Upload New</button>
                <button type="button" class="btn btn-danger" onclick="removeImage()">Remove</button>
            </div>
        </form>
        <!-- Sidebar / End -->

        <!-- Content ================================================== -->
        <div class="col-lg-8 col-md-8 padding-left-30">
            <!-- MEDICAL DATA -->
            <form class="row mb-5 needs-validation" id="editProfile" enctype="multipart/form-data" action="" method="post">
                <input hidden class="d-none" name="form_name" value="profile_edit">

                <div class="col-md-6 col-12">
                    <label>First Name</label>
                    <input class="form-control" name="firstName" type="text" value="<?= $user['firstName'] ?>" maxlength="50" required>
                </div>
                <div class="col-md-6 col-12">
                    <label>Last Name</label>
                    <input class="form-control" name="lastname" type="text" value="<?= $user['lastname'] ?>" maxlength="50" required>
                </div>
                <div class="col-12">
                    <label>About Yourself</label>
                    <textarea class="form-control" class="form-control" name="aboutuser" rows="2" minlength="100" maxlength="2000"><?= $user['aboutuser'] ?></textarea>
                </div>
                <div class="col-md-6 col-12">
                    <label>Languages</label>
                    <select id="languages" data-placeholder="Select Languages" class="form-select chosen-select {required:true}" name="languages[]" multiple>
                        <?php foreach ($languageSelection as $key => $language) : ?>
                            <option <?= in_array($language, $user['languages']) ? 'selected' : '' ?> value="<?= $language ?>"><?= $language ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 col-12">
                    <label>Gender</label>
                    <ul class="checkboxes margin-top-0 d-flex">
                        <li>
                            <input id="Male" type="radio" name="gender" value="Male" <?= $user['gender'] == 'Male' ? 'checked' : '' ?>>
                            <label for="Male">Male</label>
                        </li>
                        <li>
                            <input id="Female" type="radio" name="gender" value="Female" <?= $user['gender'] == 'Female' ? 'checked' : '' ?>>
                            <label for="Female">Female</label>
                        </li>
                        <li>
                            <input id="not_to_say" type="radio" name="gender" value="Rather Not Say" <?= $user['gender'] == 'Rather Not Say' ? 'checked' : '' ?>>
                            <label for="not_to_say">Rather Not Say</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-12 mt-2">
                    <label>Mobile Number</label>
                    <input class="form-control" name="phone" type="tel" value="<?= $user['phone'] ?>" maxlength="13" required>
                </div>
                <hr class="mt-3">
                <h4>Address Information</h4>
                <div class="col-12">
                    <label>Address Line 1</label>
                    <input class="form-control" name="addressLine1" type="text" value="<?= $user['addressLine1'] ?>" maxlength="200" required>
                </div>
                <div class="col-12">
                    <label>Address Line 2 <small>(optional)</small></label>
                    <input class="form-control" name="addressLine2" type="text" value="<?= $user['addressLine2'] ?>" maxlength="200">
                </div>
                <div class="col-md-4 col-12">
                    <label>Pincode</label>
                    <input class="form-control" name="pincode" type="number" minlength="6" maxlength="6" value="<?= $user['pincode'] ?>" required>
                </div>
                <!-- <div class="col-md-4 col-12">
                    <label>Country</label>
                    <select id="country" data-placeholder="Select country" class="chosen-select" name="country" required>
                        <?php foreach ($countries as $key => $country) : ?>
                            <option <?= $user['country'] == $country ? 'selected' : '' ?> value="<?= $country ?>"><?= $country ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <div class="col-md-4 col-12">
                    <label>State</label>
                    <input class="form-control" name="state" type="text" value="<?= $user['state'] ?>" maxlength="140" required>
                </div>
                <div class="col-md-4 col-12">
                    <label>City</label>
                    <input class="form-control" name="city" type="text" value="<?= $user['city'] ?>" maxlength="140" required>
                </div>
                <div class="col-12 mt-4">
                    <button class="button float-right" type="submit">
                        Save Profile
                    </button>
                </div>
            </form>

            <?php
            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';
            ?>
        </div>
    </div>
</div>

<style>
    .userImage img {
        width: 100%;
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
</style>

<?= $this->endSection(); ?>
<?= $this->section('footerScripts'); ?>
<script src="/public/assets/scripts/extensions/jquery.validate.min.js"></script>
<script>
    $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $('#editProfile').validate({
        debug: true,
        errorClass: 'is-invalid',
        validClass: 'is-valid'
    });

    function uploadImageButton() {
        $('#photoURL').click();
    }

    function previewImage(event) {
        const imageFile = event.files[0];
        if (imageFile) {
            if (imageFile.type == 'image/jpeg') {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('userImage');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.files[0]);
                // upload image physically then save to database (full ajax request here)
                var formData = new FormData($('#imageForm')[0]);
                $.ajax({
                    url: '',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        const response = JSON.parse(data);
                        alert(response['message']);
                        if (response['success']) {
                            // location.reload();
                        } else {
                            resetProfileImage();
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        resetProfileImage();
                        alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-PI-SRV-089');
                    }
                });
            } else {
                alert('Image/File type not supported, please upload only JPEG images');
            }
        }
        return;
    }

    function resetProfileImage() {
        var defaultAvatar = '/public/assets/images/user.png';
        var output = document.getElementById('userImage');
        output.src = defaultAvatar;
    }

    function removeImage() {
        var formData = new FormData();
        formData.append('form_name', 'profile_image_remove');
        $.ajax({
            url: '',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const response = JSON.parse(data);
                alert(response['message']);
                if (response['success']) {
                    resetProfileImage();
                }
            },
            error: function(data) {
                console.log(data);
                resetProfileImage();
                alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-PI-SRV-089');
            }
        });
        // remove image from database first
    }

    $('#editProfile').submit(function(event) {
        event.preventDefault();
        const formData = new FormData($(this)[0]);
        console.log(Array.from(formData));
        if ($(this).valid()) {
            $.ajax({
                url: '',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    const response = JSON.parse(data);
                    alert(response['message']);
                },
                error: function(data) {
                    console.log(data);
                    alert('There is some error on this request, please try again after some time. \n ERROR CODE: ERR-PR-UPD-089');
                    location.reload();
                }
            })
        } else {
            console.log('form is invalid')
        }
    })
</script>
<?= $this->endSection(); ?>