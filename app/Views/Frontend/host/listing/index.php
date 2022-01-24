<?= $this->extend('Frontend/layouts/host_layout'); ?>

<?= $this->section('content'); ?>
<div class="row mb-5">
    <div class="col">
        <div class="dashboard-list-box">
            <!-- <div class="booking-requests-filter">
                <div class="sort-by">
                    STATUS: <div class="sort-by-select">
                        <select selected="upcoming">
                            <option value="upcoming">Upcoming</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <h4>Listings</h4>
        </div>
        <div class="table-responsive pt-4" style="overflow: visible;">
            <table class="basic-table">
                <thead>
                    <tr>
                        <th scope="col">Listing</th>
                        <th scope="col">Acomodation</th>
                        <th scope="col">Location</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Published</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($listings as $listing) : ?>
                        <tr>
                            <td>
                                <img src="<?php if ($listing['coverimage']) {
                                                echo $listing['coverimage'];
                                            } else {
                                                echo 'https://via.placeholder.com/100x60';
                                            } ?>" style="max-width:100px;max-height:60px;" />
                                <span>
                                    <strong>
                                        <?php if ($listing['title']) {
                                            echo $listing['title'];
                                        } else {
                                            echo 'Untitled Listing';
                                        } ?>
                                    </strong>
                                </span>
                            </td>
                            <td>
                                <ul>
                                    <li>Rooms: <?= $listing['bedrooms'] ?></li>
                                    <li>Bathrooms: <?= $listing['bathrooms'] ?></li>
                                    <li>Guests: <?= $listing['guests'] ?></li>
                                </ul>
                            </td>
                            <td><?= $listing['location'] ?></td>
                            <td><?= date('M d, Y', strtotime($listing['updated_at'])) ?></td>
                            <td>
                                <?php if ($listing['status']) { ?>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                <?php } else { 
                                    echo 'Not Activated';
                                } ?>
                            </td>
                            <td>
                                <a href="<?= route_to('hosting_listing_edit', $listing['listing_id']) ?>" style="font-size:25px;" type="button"><i class="im im-icon-Edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .basic-table th {
        padding-left: 8px;
        padding-right: 2px;
        min-width: 90px;
    }

    .basic-table td {
        padding-left: 8px;
        padding-right: 2px;
    }

    .payoutcolumn {
        min-width: 150px;
    }

    .myiconbtn:after {
        content: none;
    }

    .dropdown-item {
        font-size: 16px;
        line-height: 25px
    }
</style>
<?= $this->endSection(); ?>