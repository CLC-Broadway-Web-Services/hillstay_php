<div class="col-lg-4 ">
    <div class="blog-box mt-4 p-3 box-shadow">
        <div class="blog-img">
            <img src="<?= $post_image ?>" class="img-fluid" alt="">
        </div>
        <div class="blog-content mt-3">
            <?php if (!empty($category_name)) : ?>
                <h6 class="f-13 text-muted"><?= $category_name ?></h6>
            <?php endif ?>
            <h5 class="mt-2">
                <a href="<?= route_to('single_post_page', $post_slug) ?>" class="blog-title"><?= $post_title ?></a>
            </h5>
            <p class="text-muted mt-3"><?= $post_summary ?></p>
            <div class="mt-4">
                <a href="<?= route_to('single_post_page', $post_slug) ?>" class="btn btn-sm btn-primary btn-round">Read More <i class="mdi mdi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>