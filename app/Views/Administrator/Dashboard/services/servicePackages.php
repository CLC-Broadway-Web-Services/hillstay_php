<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Service Packages</h4>
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
                                <th class="nk-tb-col"><span class="sub-text">Package</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Price</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Service</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Updated</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($servicePackages as $servicePackage) : ?>
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid<?= $servicePackage['package_id'] ?>">
                                            <label class="custom-control-label" for="uid<?= $servicePackage['package_id'] ?>"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead"><?= $servicePackage['package_name'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb" data-order="<?= $servicePackage['package_price'] ?>">
                                        <span class="tb-amount"><?= $servicePackage['package_price'] ?> <span class="currency">INR</span></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $servicePackage['service_title'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <span><?= date('d M Y', strtotime($servicePackage['package_created_at'])) ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <?php if ($servicePackage['package_updated_at']) { ?>
                                            <span><?= date('d M Y', strtotime($servicePackage['package_updated_at'])) ?></span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col tb-col-md" data-order="Active - Not Active">
                                        <?php if ($servicePackage['package_status'] == 1) { ?>
                                            <span class="tb-status text-success">Active</span>
                                        <?php } else { ?>
                                            <span class="tb-status text-danger">Not Active</span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="/administrator/service/packages/edit/<?= $servicePackage['package_id'] ?>"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                            <!-- <li><a href="/administrator/service/homestatus/"><em class="icon ni ni-eye"></em><span>Change Visible</span></a></li> -->
                                                            <li><a href="/administrator/service/packages/status/<?= $servicePackage['package_id'] ?>"><em class="icon ni ni-repeat"></em><span>Change Status</span></a></li>
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