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
                                    <?php if ($postData['post_id'] == 0) {
                                        echo 'Add Post';
                                    } else {
                                        echo 'Edit Post';
                                    } ?>
                                </h5>
                            </div>
                            <form id="postForm" name="post_form" action="" method="POST" enctype="multipart/form-data" id="faqAddEditForm" class="form-validate is-alter" onsubmit="return validateForm()">
                                <div class="row g-4">
                                    <?php if (isset($errorMessage)) : ?>
                                        <div class="alert alert-icon alert-danger" role="alert">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <strong>Failed.</strong> <?= $errorMessage ?>
                                        </div>
                                    <?php endif ?>


                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="post_title">Post Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="post_title" name="post_title" value="<?= $postData['post_title'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="post_summary">Post Summary</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="post_summary" name="post_summary" value="<?= $postData['post_summary'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="post_tags">Post Tags</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" data-role="tagsinput" class="form-control" id="post_tags" name="post_tags" value="<?= $postData['post_tags'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label">Post Category</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" name="post_category" data-placeholder="Select Category" required>
                                                            <option selected disabled>Select Category</option>
                                                            <?php foreach ($categories as $category) : ?>
                                                                <option <?php if ($postData['post_category'] == $category['post_cat_id']) echo 'selected' ?> value="<?= $category['post_cat_id'] ?>"><?= $category['post_cat_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label">Post Status</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" name="post_status" required>
                                                            <option <?php if ($postData['post_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                            <option <?php if ($postData['post_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="form-group">
                                                    <label class="form-label">Post Home Visual</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" name="post_home_view" required>
                                                            <option <?php if ($postData['post_home_view'] == 1) echo 'selected' ?> value="1">Show on Home</option>
                                                            <option <?php if ($postData['post_home_view'] == 0) echo 'selected' ?> value="0">Not Shown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="post_description">Post Content</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" rows="8" id="post_description" name="post_description"><?= $postData['post_description'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="serviceImageBlock">
                                            <?php if (!empty($postData['post_image'])) : ?>
                                                <img src="<?= $postData['post_image'] ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="default-06">Post Image</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <?php if (!empty($postData['post_image'])) : ?>
                                                        <input type="file" multiple class="custom-file-input" id="customFile" name="post_image" onchange="previewServiceImage(this)">
                                                    <?php else : ?>
                                                        <input type="file" multiple class="custom-file-input" id="customFile" name="post_image" onchange="previewServiceImage(this)" required>
                                                    <?php endif; ?>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <?php if ($postData['post_id'] == 0) {
                                                    echo 'Add Post';
                                                } else {
                                                    echo 'Update Post';
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

<style>
    .customInvalid,
    #customFile-error,
    #post_category-error {
        position: absolute;
        left: 0;
        color: #fff;
        font-size: 11px;
        line-height: 1;
        bottom: calc(100% + 4px);
        background: #ed756b;
        padding: .3rem .5rem;
        z-index: 1;
        border-radius: 3px;
        white-space: nowrap;
        font-style: italic;
        left: auto;
        right: 0;
    }

    .customInvalid::before,
    #customFile-error::before,
    #post_category-error::before {
        border-bottom: 6px solid transparent;
        position: absolute;
        content: '';
        height: 0;
        width: 0;
        border-left: 6px solid #ed756b;
        border-right: 6px solid transparent;
        left: auto;
        right: 10px;
        border-right-color: #ed756b;
        border-left-color: transparent;
        bottom: -4px;
    }
</style>
<!-- Page Container END -->
<?= $this->endSection() ?>