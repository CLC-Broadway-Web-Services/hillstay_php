<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Testimonials <button type="button" id="testimonialToggleButton" class="btn btn-primary float-right" onclick="toggleForm()">Add</button></h4>
                    <?php if (isset($sessionData['serviceStatusMessage'])) : ?>
                        <div class="alert alert-icon alert-danger" role="alert">
                            <em class="icon ni ni-alert-circle"></em>
                            <strong>Failed.</strong> <?= $sessionData['serviceStatusMessage'] ?>
                        </div>
                    <?php endif ?>
                    <input id="get_testimonial_id" value="<?= $testimonialData['testimonial_id'] ?>" hidden>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3" id="addTestimonialForm" hidden>
                    <div class="card card-bordered card-full">
                        <div class="nk-wg1">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">
                                        <?php if ($testimonialData['testimonial_id'] == 0) {
                                            echo 'Add Testimonial';
                                        } else {
                                            echo 'Edit Testimonial';
                                        } ?>
                                    </h5>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data" id="testimonialAddEditForm">
                                    <div class="row g-4">
                                        <?php if (isset($errorMessage)) : ?>
                                            <div class="alert alert-icon alert-danger" role="alert">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <strong>Failed.</strong> <?= $errorMessage ?>
                                            </div>
                                        <?php endif ?>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="testimonials_content">Testimonial</label>
                                                <div class="form-control-wrap">
                                                    <textarea type="text" class="form-control" id="testimonials_content" name="testimonials_content" required><?= $testimonialData['testimonials_content'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="testimonials_name">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="testimonials_name" value="<?= $testimonialData['testimonials_name'] ?>" name="testimonials_name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="testimonials_post">Post</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="testimonials_post" value="<?= $testimonialData['testimonials_post'] ?>" name="testimonials_post" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="testimonials_company">Company</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="testimonials_company" value="<?= $testimonialData['testimonials_company'] ?>" name="testimonials_company" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="testimonials_name">Status</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" name="testimonials_status" required>
                                                        <option <?php if ($testimonialData['testimonials_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                        <option <?php if ($testimonialData['testimonials_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    <?php if ($testimonialData['testimonial_id'] == 0) {
                                                        echo 'Add Testimonial';
                                                    } else {
                                                        echo 'Update Testimonial';
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
                <div class="col-12">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Testimonial</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Post</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Company</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools text-right">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($testimonials as $testimonial) : ?>
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $testimonial['testimonials_content'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $testimonial['testimonials_name'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $testimonial['testimonials_post'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $testimonial['testimonials_company'] ?></span>
                                            </td>
                                            <!-- <td class="nk-tb-col tb-col-mb">
                                                <span><?= $testimonial['testimonials_status'] ?></span>
                                            </td> -->
                                    <td class="nk-tb-col tb-col-md" data-order="Active - Not Active">
                                        <?php if ($testimonial['testimonials_status'] == 1) { ?>
                                            <span class="tb-status text-success">Active</span>
                                        <?php } else { ?>
                                            <span class="tb-status text-danger">Not Active</span>
                                        <?php } ?>
                                    </td>
                                            <td class="nk-tb-col tb-col-xl">
                                                <span><?= date('d M Y', strtotime($testimonial['testimonials_created_at'])) ?></span>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="/administrator/other/testimonials/<?= $testimonial['testimonial_id'] ?>"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                    <li><a href="/administrator/other/testimonials/delete/<?= $testimonial['testimonial_id'] ?>"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page Container END -->
<?= $this->endSection() ?>