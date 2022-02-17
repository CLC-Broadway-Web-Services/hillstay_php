<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Services</h4>
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
                                <th class="nk-tb-col"><span class="sub-text">Service</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Home Visible</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Updated</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service) : ?>
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid<?= $service['service_id'] ?>">
                                            <label class="custom-control-label" for="uid<?= $service['service_id'] ?>"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead"><?= $service['service_title'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                                <span><?= $service['service_summary'] ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><i class="mdi mdi-<?= $service['service_icon'] ?> h4"></i></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md" data-order="Visible - Not Visible">
                                        <?php if ($service['service_home_view'] == 1) { ?>
                                            <span class="tb-status text-success">Visible</span>
                                        <?php } else { ?>
                                            <span class="tb-status text-warning">Not Visible</span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <span><?= date('d M Y', strtotime($service['service_created_at'])) ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <?php if ($service['service_updated_at']) { ?>
                                            <span><?= date('d M Y', strtotime($service['service_updated_at'])) ?></span>
                                        <?php } ?>
                                    </td>
                                    <td class="nk-tb-col tb-col-md" data-order="Active - Not Active">
                                        <?php if ($service['service_status'] == 1) { ?>
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
                                                            <li><a href="/administrator/service/edit/<?= $service['service_id'] ?>"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                            <li><a href="/administrator/service/homestatus/<?= $service['service_id'] ?>"><em class="icon ni ni-eye"></em><span>Change Visible</span></a></li>
                                                            <li><a href="/administrator/service/status/<?= $service['service_id'] ?>"><em class="icon ni ni-repeat"></em><span>Change Status</span></a></li>
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