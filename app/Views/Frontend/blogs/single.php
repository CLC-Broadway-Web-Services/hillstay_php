<?= $this->extend('Frontend/layouts/main') ?>

<?= $this->section('content') ?>


<!-- UPPER -->
<section class="bg-home" id="home">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="home-content">
                            <?php if (isset($post['category_name'])) : ?>
                                <div class="home-badge">
                                    <p class="f-13"><span class="text-primary"><?= $post['category_name'] ?></span></p>
                                </div>
                            <?php endif; ?>
                            <h1 class="home-title"><?= $post['post_title'] ?></h1>
                            <p class="text-muted mt-3 f-20"> <?= html_entity_decode($post['post_summary']) ?></p>
                            <!-- <div class="mt-5">
                                <a href="" class="btn btn-primary">Get Started <span class="text-white-50">- For
                                        Free</span> <i class="mdi mdi-arrow-right"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="home-img">
                            <img src="<?= $post['post_image'] ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- UPPER -->

<!-- MAIN CONTENT -->

<section class="section bg-light pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="postContent mt-4">
                    <?= html_entity_decode($post['post_description']) ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="section pt-5"> -->

    <div class="row nextPreviousContainer">
        <div class="col-6">
            <?php if (isset($previousPost)) : ?>
                <a href="<?= route_to('single_post_page', $previousPost['post_slug']) ?>" class="customNextPrevious"><i class="mdi mdi-arrow-left"></i> Previous</a>
            <?php endif; ?>
        </div>
        <div class="col-6 text-right">
            <?php if (isset($nextPost)) : ?>
                <a href="<?= route_to('single_post_page', $nextPost['post_slug']) ?>" class="customNextPrevious">Next <i class="mdi mdi-arrow-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
<!-- </section> -->

<!-- MAIN CONTENT -->

<style>
    .nextPreviousContainer {
        margin-left: 0;
        margin-right: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .postContent {
        max-width: 800px;
        margin: 0 auto;
    }

    .nextPreviousContainer .col-6 {
        padding: 1%;
        background: #ffffff;
    }

    .nextPreviousContainer .col-6:hover {
        background: #800000;
    }

    .nextPreviousContainer .col-6:hover a {
        color: #ffffff;
    }

    .nextPreviousContainer .col-6 a {
        color: #800000;
        width: 100%;
        display: block;
    }
</style>



<?= $this->endSection() ?>