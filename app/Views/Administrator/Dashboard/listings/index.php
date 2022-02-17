<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Listings</h4>
                    <?php if (isset($sessionData['serviceStatusMessage'])) : ?>
                        <div class="alert alert-icon alert-danger" role="alert">
                            <em class="icon ni ni-alert-circle"></em>
                            <strong>Failed.</strong> <?= $sessionData['serviceStatusMessage'] ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="card card-preview">
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">Listing</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Location</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">guests</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Price</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Details</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Updated</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listings as $listing) : ?>
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid<?= $listing['listing_id'] ?>" name="listingId[]" value="<?= $listing['listing_id'] ?>">
                                            <label class="custom-control-label" for="uid<?= $listing['listing_id'] ?>"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead"><?= $listing['title'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $listing['location'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $listing['guests'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $listing['price'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <span>
                                            <b>Placekind: </b><?= $listing['placekind'] ?><br>
                                            <b>Property Type: </b><?= $listing['propertytype'] ?>
                                        </span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <span><?= date('d M Y', strtotime($listing['created_at'])) ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <?php if ($listing['updated_at']) { ?>
                                            <span><?= date('d M Y', strtotime($listing['updated_at'])) ?></span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col tb-col-md" data-order="Active - Not Active">
                                        <?php if ($listing['status'] == 1 && $listing['finished'] == 1 && $listing['published'] == 1) { ?>
                                            <span class="tb-status text-success">Active</span>
                                        <?php } elseif ($listing['status'] == 0 && $listing['finished'] == 1) { ?>
                                            <span class="tb-status text-danger">Not Active</span>
                                        <?php } else { ?>
                                            <span class="tb-status text-danger">incomplete</span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="<?= route_to('admin_update_listing', $listing['listing_id']) ?>"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                            <li><a href="<?= route_to('admin_view_listing', $listing['listing_id']) ?>"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                            <li>
                                                                <?php if ($listing['status'] == 1 && $listing['finished'] == 1 && $listing['published'] == 1) { ?>
                                                                    <a href="<?= route_to('admin_activate_listing', $listing['listing_id']) ?>">
                                                                        <em class="icon ni ni-repeat"></em>
                                                                        <span class="tb-status text-danger">De-Activate</span>
                                                                    </a>
                                                                <?php } elseif ($listing['status'] == 0 && $listing['finished'] == 1) { ?>
                                                                    <a href="<?= route_to('admin_activate_listing', $listing['listing_id']) ?>">
                                                                        <em class="icon ni ni-repeat"></em>
                                                                        <span class="tb-status text-success">Activate</span>
                                                                    </a>
                                                                <?php } ?>
                                                            </li>
                                                            <li><a href="<?= route_to('admin_delete_listing', $listing['listing_id']) ?>"><em class="icon ni ni-trash"></em><span class="text-danger">Delete</span></a></li>
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
            </div><!-- .card-preview -->
        </div>
    </div>
</div>


<!-- Page Container END -->
<?= $this->endSection() ?>