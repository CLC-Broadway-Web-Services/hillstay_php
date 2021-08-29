<!DOCTYPE html>
<html lang="zxx" class="js">

<?php echo view('Administrator/Auth/head'); ?>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                        <?php echo view('Administrator/Auth/branding'); ?>

                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Reset password</h5>
                                        <div class="nk-block-des">
                                            <!-- <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p> -->
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($errorMessage)) : ?>
                                    <div class="alert alert-icon alert-danger" role="alert">
                                        <em class="icon ni ni-alert-circle"></em>
                                        <strong>Failed.</strong> <?= $errorMessage ?>
                                    </div>
                                <?php endif ?>
                                <?php if (isset($passwordVerified)) : ?>
                                    <form action="" id="passwordResetForm" method="post">
                                        <div class="form-group">
                                            <input type="password" name="new_password" class="form-control form-control-lg" id="default-01" placeholder="New Password">
                                            <input type="password" name="confirm_password" class="form-control form-control-lg" id="default-01" placeholder="Confirm Password">
                                            <input type="text" name="reset_code" value="<?= $reset_code ?>" hidden>
                                            <input type="text" name="user_email" value="<?= $user_email ?>" hidden>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Change</button>
                                        </div>
                                    </form>
                                <?php else : ?>
                                    <form action="" id="codeVerifyForm" method="post">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="default-01">Reset Code</label>
                                            </div>
                                            <input type="number" name="reset_code1" class="form-control form-control-lg" id="default-01" placeholder="Enter your code to verify">
                                            <input type="text" name="user_email1" value="<?= $_GET['resetcode'] ?>" hidden>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
                                        </div>
                                    </form>
                                <?php endif ?>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="/administrator/login"><strong>Return to login</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo view('Administrator/Auth/footer'); ?>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/dashboard/assets/js/bundle.js?ver=2.2.0"></script>
    <script src="/public/dashboard/assets/js/scripts.js?ver=2.2.0"></script>
    <!-- page js -->
    <?php if (isset($pageJS)) {
        echo $pageJS;
    } ?>
</body>

</html>