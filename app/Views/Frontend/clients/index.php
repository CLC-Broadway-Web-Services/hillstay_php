<?= $this->extend('Frontend/layouts/main') ?>

<?= $this->section('content') ?>


<section class=" bg-light" id="home">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-9 pb-4">
                        <div class="home-content text-center mt-5 pt-5">
                            <h1 class="mt-3">
                                Our valuable clients
                            </h1>
                            <div class="mt-5">
                                <div class="search-form">
                                    <form action="#" method="POST">
                                        <input type="text" placeholder="Keyword ...">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section" id="blog">
    <div class="container">
        <div class="row mt-4">

            <?php foreach ($projects as $project) : ?>
                <?= view_cell('\App\Libraries\Client::client_block', ['project' => $project]) ?>
            <?php endforeach ?>

        </div>
        <div class="row mt-3 align-items-center justify-content-center">
            <!-- <div class="col text-center"> -->
            <?= $pager->links() ?>
            <!-- </div> -->
        </div>
    </div>
</section>

<?= $this->endSection() ?>