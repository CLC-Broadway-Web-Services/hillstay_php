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
                                    <?php if ($packageData['package_id'] == 0) {
                                        echo 'Add Package';
                                    } else {
                                        echo 'Edit Package';
                                    } ?>
                                </h5>
                            </div>
                            <form action="" method="POST" class="col-12" enctype="multipart/form-data" id="packageAddEditForm">
                                <div class="row g-4">
                                    <?php if (isset($errorMessage)) : ?>
                                        <div class="alert alert-icon alert-danger" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Failed.</strong> <?= $errorMessage ?>
                                        </div>
                                    <?php endif ?>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Services</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="service_id" required>
                                                    <option <?php if ($packageData['service_id'] == 0) echo 'selected' ?> disabled value="">Select Service</option>
                                                    <?php foreach ($allServices as $service) : ?>
                                                        <option <?php if ($service['service_id'] == $packageData['service_id']) echo 'selected' ?> value="<?= $service['service_id'] ?>"><?= $service['service_title'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="package_name">Package Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Title or Heading of the Package" value="<?= $packageData['package_name'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Package Price</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-sign-inr"></em>
                                                </div>
                                                <input type="number" class="form-control" id="package_price" id="package_price" value="<?= $packageData['package_price'] ?>" placeholder="ex: 1500" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Package Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="package_status" required>
                                                    <option <?php if ($packageData['package_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                    <option <?php if ($packageData['package_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="package_details">Package Details</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" rows="10" class="form-control" id="package_details" name="package_details" required><?= $packageData['package_details'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="addPackageButtonDiv">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <?php if ($packageData['service_id'] == 0) {
                                                    echo 'Add Package';
                                                } else {
                                                    echo 'Update Package';
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