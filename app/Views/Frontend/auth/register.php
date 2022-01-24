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
                    <form method="post" class="register" action="">
                        <p class="form-row form-row-wide">
                            <label for="firstName2">First Name:
                                <i class="im im-icon-Male"></i>
                                <input type="text" class="input-text" name="firstName" id="firstName2" value="" required />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="lastname2">Last Name:
                                <i class="im im-icon-Male"></i>
                                <input type="text" class="input-text" name="lastname" id="lastname2" value="" required />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="email2">Email Address:
                                <i class="im im-icon-Mail"></i>
                                <input type="email" class="input-text" name="email" id="email2" value="" required />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="usr_password">Password:
                                <i class="im im-icon-Lock-2"></i>
                                <input class="input-text" type="password" name="usr_password" id="usr_password" required />
                            </label>
                        </p>
                        <p class="form-row form-row-wide">
                            <label for="usr_password_confirm">Repeat Password:
                                <i class="im im-icon-Lock-2"></i>
                                <input class="input-text" type="password" name="usr_password_confirm" id="usr_password_confirm" required />
                            </label>
                        </p>
                        <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                    </form>
                </div>
                <!-- <button (click)="modalRef.hide()" title="Close (Esc)" type="button" class="mfp-close"></button> -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>