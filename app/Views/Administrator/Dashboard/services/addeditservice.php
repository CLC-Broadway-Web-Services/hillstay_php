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
                                    <?php if ($serviceData['service_id'] == 0) {
                                        echo 'Add Service';
                                    } else {
                                        echo 'Edit Service';
                                    } ?>
                                </h5>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data" id="serviceAddEditForm">
                                <div class="row g-4">
                                    <?php if (isset($errorMessage)) : ?>
                                        <div class="alert alert-icon alert-danger" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Failed.</strong> <?= $errorMessage ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="service_title">Service Title / Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="service_title" name="service_title" value="<?= $serviceData['service_title'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="service_summary">Service Summary</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="service_summary" name="service_summary" value="<?= $serviceData['service_summary'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="service_overview">Service Overview</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control form-control-outlined tinymce-basic" rows="8" id="service_overview" name="service_overview"><?= $serviceData['service_overview'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div id="accordion" class="accordion">
                                                    <div class="accordion-item">
                                                        <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-2">
                                                            <h6 class="title">Choose Service Icon</h6>
                                                            <span class="accordion-icon"></span>
                                                        </a>
                                                        <div class="accordion-body collapse" id="accordion-item-2" data-parent="#accordion">
                                                            <div class="accordion-inner row">

                                                                <?php foreach ($icons as $icon) : ?>
                                                                    <div class="col-md-2 col-sm-3 col-lg-1">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="service_icon_<?= $icon ?>" <?php if ($serviceData['service_icon'] == $icon) echo 'checked' ?> value="<?= $icon ?>" name="service_icon" class="custom-control-input" required>
                                                                                <label class="custom-control-label" for="service_icon_<?= $icon ?>"><i class="mdi mdi-<?= $icon ?> h4"></i></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Service Status</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" name="service_status" required>
                                                        <option <?php if ($serviceData['service_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                        <option <?php if ($serviceData['service_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Service Home Visibility</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" name="service_home_view" required>
                                                        <option <?php if ($serviceData['service_home_view'] == 1) echo 'selected' ?> value="1">Visible on home</option>
                                                        <option <?php if ($serviceData['service_home_view'] == 0) echo 'selected' ?> value="0">Not visible on home</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <?php if ($serviceData['service_id'] == 0) {
                                                    echo 'Add Service';
                                                } else {
                                                    echo 'Update Service';
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