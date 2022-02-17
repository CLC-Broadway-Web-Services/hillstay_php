<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">User List</h4>
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
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Name</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Email</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Phone</span></th>
                                <th class="nk-tb-col"><span class="sub-text">State</span></th>
                                <th class="nk-tb-col"><span class="sub-text">country</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                <th class="nk-tb-col tb-col-xl"><span class="sub-text">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userdata as $user) : ?>
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="select">
                                            <label class="custom-control-label" for="select"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $user['firstName'] . ' ' . $user['lastname'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $user['email'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $user['phone'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $user['state'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span><?= $user['country'] ?></span>
                                    </td>
                                    <td class="nk-tb-col tb-col-xl">
                                        <span>
                                            <?php if ($user['status'] == 1 ) { ?>
                                                <span class="tb-status text-success">Active</span>
                                            <?php } else { ?>
                                                <span class="tb-status text-danger">Not Active</span>
                                            <?php }  ?>
                                        </span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                            <li><a href="<?= route_to('user_view', $user['uid']) ?>"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                           
                                                            <li><a href="<?= route_to('user_delete', $user['uid']) ?>"><em class="icon ni ni-trash"></em><span class="text-danger">Delete</span></a></li>
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


<!-- Page Container END -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    <?php if (session()->getFlashdata("success")) { ?>
        swal({
            title: "Saved",
            text: "Your Profile Saved Now",
            icon: "success",
        });
    <?php } ?>

    function deleteData(id) {
        console.log(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url(route_to('contact_delete')); ?>',
                        data: {
                            delete: 'del',
                            id: id
                        },
                        success: function(result) {
                            console.log(result)
                            location.reload();
                        },
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
</script>
<?= $this->endSection() ?>