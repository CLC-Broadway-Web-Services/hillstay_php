<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <div id="sign-in-dialog" class="zoom-anim-dialog">
                <div class="small-dialog-header">
                    <h3>Sign In</h3>
                </div>
                <?php if (isset($response['response']) && $response['response'] == 'failed') : ?>
                    <div class="notification error closeable">
                        <p><span>Error!</span> <?= $response['value'] ?></p>
                        <a class="close" href="#"></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($response['response']) && $response['response'] == 'success') : ?>
                    <div class="notification success closeable">
                        <p><span>Wow!</span> Registration succesfull.</p>
                        <a class="close" href="#"></a>
                    </div>
                <?php endif; ?>
                <div class="sign-in-form style-1 mb-0">
                    <form method="post" class="login" action="/login">

                        <p class="form-row form-row-wide">
                            <label for="username">Username:
                                <i class="im im-icon-Male"></i>
                                <input type="text" class="input-text" name="username" id="username" value="" />
                            </label>
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="password">Password:
                                <i class="im im-icon-Lock-2"></i>
                                <input class="input-text" type="password" name="password" id="password" />
                            </label>
                            <span class="lost_password">
                                <a href="#">Lost Your Password?</a>
                            </span>
                        </p>

                        <div class="form-row">
                            <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                        </div>
                        <?php if (isset($googleLogin)) : ?>
                            <div class="form-row">
                                <a href='<?= $googleLogin ?>' type="button" class="button btn-google border btn-block mt-2">
                                    Continue with google
                                </a>
                            </div>
                        <?php endif; ?>
                        <!-- <p class="form-row form-row-wide text-center">
                            <span class="text-dark mt-2 mb-2">Or log-in with</span>

                            <a type="button" class="button btn-google border btn-block mt-2">
                                Continue with google
                            </a>
                        </p> -->
                    </form>
                </div>
                <!-- <button (click)="modalRef.hide()" title="Close (Esc)" type="button" class="mfp-close"></button> -->
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>