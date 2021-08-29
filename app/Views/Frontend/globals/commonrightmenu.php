<!-- Right Side Content / End -->
<?php if (session()->get('isUserLoggedIn')) : ?>
	<div class="right-side">
		<div class="header-widget">
			<div class="user-menu" id="customUserMenu">
				<div class="user-name">
					<span><img src="/public/assets/images/dashboard-avatar.jpg" alt=""></span> <?= session()->get('user') ?>
				</div>
				<ul>
					<li><a href="<?= route_to('account_inbox') ?>"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
					<li><a href="<?= route_to('account_alerts') ?>"><i class="sl sl-icon-settings"></i> Notifications</a></li>
					<li><a href="<?= route_to('account_trips') ?>"><i class="sl sl-icon-settings"></i> Trips</a></li>
					<li><a href="<?= route_to('account_wishlist') ?>"><i class="sl sl-icon-settings"></i> Saved</a></li>
					<li class="dropdown-divider"></li>
					<li><a href="<?= route_to('hosting_dashboard_index') ?>"><i class="fa fa-calendar-check-o"></i> Hosting Dashboard</a></li>
					<li><a href="<?= route_to('hosting_listings_all') ?>"><i class="fa fa-calendar-check-o"></i> Manage Listings</a></li>
					<li><a href="<?= route_to('account_settings') ?>"><i class="fa fa-calendar-check-o"></i> Account</a></li>
					<li><a href="<?= route_to('account_profile') ?>"><i class="fa fa-calendar-check-o"></i> Profile</a></li>
					<li class="dropdown-divider"></li>
					<li><a href="<?= route_to('help_page') ?>"><i class="fa fa-calendar-check-o"></i> Help</a></li>
					<li><a href="<?= route_to('logout_user') ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
				</ul>
			</div>
			<a href="<?= route_to('hosting_listing_add_new') ?>" class="button with-icon">Add Listing <i class="sl sl-icon-plus"></i>
			</a>
		</div>
	</div>
<?php endif; ?>
<!-- Right Side Content / End -->