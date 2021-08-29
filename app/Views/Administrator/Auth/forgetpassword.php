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
                                            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <?php if (isset($errorMessage)) : ?>
                                        <div class="alert alert-icon alert-danger" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Failed.</strong> <?= $errorMessage ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (isset($successMessage)) : ?>
                                        <div class="alert alert-icon alert-success" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Success.</strong> <?= $successMessage ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <input type="text" name="adminEmail" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Send Reset Link</button>
                                    </div>
                                </form>
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
</body>

</html>