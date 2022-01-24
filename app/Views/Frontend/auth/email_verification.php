<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
            <div id="sign-in-dialog" class="zoom-anim-dialog">
                <div class="small-dialog-header">
                    <h3>VERIFICATION</h3>
                </div>
                <div class="notification <?= $response['response'] ?>">
                    <p><span> <?= $response['value'] ?></span></p>
                </div>
                <?php if ($response['response'] == 'success') : ?>
                    <a href="<?= route_to('login_page') ?>" class="button">Login to continue</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>