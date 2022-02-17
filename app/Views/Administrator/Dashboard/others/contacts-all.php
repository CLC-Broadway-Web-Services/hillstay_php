<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->

<div class="nk-content-wrap">
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Contacts </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col tb-col-xl"><span class="sub-text">Subject</span></th>
                                        <th class="nk-tb-col tb-col-xl"><span class="sub-text">Message</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Phone</span></th>
                                        <th class="nk-tb-col tb-col-xl"><span class="sub-text">Created</span></th>
                                        <th class="nk-tb-col tb-col-xl"><span class="sub-text">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contacts as $contact) : ?>
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $contact['subject'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $contact['comments'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $contact['name'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $contact['email'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span><?= $contact['mobile'] ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-xl">
                                                <span><?= date('d M Y', strtotime($contact['created_at'])) ?></span>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="deleteData(<?= $contact['id'] ?>)" style="font-size:25px;"><i class="far fa-trash-alt text-secondary"></i></a>
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