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
                                    <?php if ($documentData['document_id'] == 0) {
                                        echo 'Add Document Block';
                                    } else {
                                        echo 'Edit Document Block';
                                    } ?>
                                </h5>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data" id="documentBlockAddEditForm">
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
                                                <select class="form-control" name="service_id" required>
                                                    <option <?php if ($documentData['service_id'] == 0) echo 'selected' ?> disabled value="">Select Service</option>
                                                    <?php foreach ($allServices as $service) : ?>
                                                        <option <?php if ($service['service_id'] == $documentData['service_id']) echo 'selected' ?> value="<?= $service['service_id'] ?>"><?= $service['service_title'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document_title">Document Block Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="document_title" name="document_title" value="<?= $documentData['document_title'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document_summary">Document Block Summary</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" rows="5" class="form-control" id="document_summary" name="document_summary" required><?= $documentData['document_summary'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Block Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="document_status" required>
                                                    <option <?php if ($documentData['document_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                    <option <?php if ($documentData['document_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <?php if ($documentData['service_id'] == 0) {
                                                    echo 'Add Document Block';
                                                } else {
                                                    echo 'Update Document Block';
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