<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered card-full">
                    <div class="nk-wg1">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">
                                    <?php if ($faqData['faq_id'] == 0) {
                                        echo 'Add Faq';
                                    } else {
                                        echo 'Edit Faq';
                                    } ?>
                                </h5>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data" id="faqAddEditForm">
                                <div class="row g-4">
                                    <?php if (isset($errorMessage)) : ?>
                                        <div class="alert alert-icon alert-danger" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Failed.</strong> <?= $errorMessage ?>
                                        </div>
                                    <?php endif ?>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Services</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="service_id" id="service_id" required>
                                                    <option <?php if ($faqData['service_id'] == 0) echo 'selected' ?> disabled value="">Select Service</option>
                                                    <?php foreach ($allServices as $service) : ?>
                                                        <option <?php if ($service['service_id'] == $faqData['service_id']) echo 'selected' ?> value="<?= $service['service_id'] ?>"><?= $service['service_title'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="faq_title">Faq Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="faq_title" name="faq_title" value="<?= $faqData['faq_title'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="faq_content">Faq Content</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" rows="5" class="form-control" id="faq_content" name="faq_content" required><?= $faqData['faq_content'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Faq Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="faq_status" required>
                                                    <option <?php if ($faqData['faq_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                    <option <?php if ($faqData['faq_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <?php if ($faqData['service_id'] == 0) {
                                                    echo 'Add Faq';
                                                } else {
                                                    echo 'Update Faq';
                                                } ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Page Container END -->
<?= $this->endSection() ?>