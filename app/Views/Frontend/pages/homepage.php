<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>

<!-- Search Area -->
<div class="main-search-container centered" style="background-image: url(/public/assets/images/slider_image.webp);">
	<div class="main-search-inner">

		<div class="container">
			<div class="row">
				<form class="col-md-12" id="searchFrom">
					<h2 class="font-weight-bold text-primary2">
						Find Nearby <span class="typed-words"></span>
					</h2>
					<h4 class="font-weight-bold homepage_subheading">
						<span>Expolore top-rated attractions, activities and more</span>
					</h4>

					<div class="main-search-input">

						<div class="main-search-input-item location">
							<div id="autocomplete-container">
								<input id="autocomplete-input" autocomplete type="text" placeholder="Location">
							</div>
							<a><i class="fa fa-map-marker"></i></a>
						</div>

						<div class="main-search-input-item location">
							<div id="datepicker-container2">
								<!-- <input type="text" id="datepicker" placeholder="Checkin - Checkout" readonly="readonly"> -->
								<input type="text" class="datepicker2" placeholder="Checkin - Checkout" readonly="readonly">
							</div>
							<a><i class="fa fa-calendar"></i></a>
						</div>

						<div class="main-search-input-item" style="user-select:none;">
							<div class="panel-dropdown" id="date-picker">
								<a href="#">Guests <span class="qtyTotal" name="qtyTotal">0</span></a>
								<div class="panel-dropdown-content">

									<!-- Quantity Buttons -->
									<div class="qtyButtons">
										<div class="qtyTitle">Adults</div>
										<input type="text" class="qtyInput" min="1" max="5" name="qtyInputAdult" value="1">
									</div>
									<div class="qtyButtons">
										<div class="qtyTitle">Children</div>
										<input type="text" class="qtyInput" min="0" max="3" name="qtyInputChild" value="0">
									</div>
									<div class="qtyButtons">
										<div class="qtyTitle">Infants</div>
										<input type="text" class="qtyInput" min="0" max="7" name="qtyInputInfant" value="0">
									</div>

									<input type="number" value="" name="qtyInputTotal" id="qtyInputTotal" style="display: none;">

								</div>
							</div>
						</div>

						<button class="button" routerLink="#">Search</button>

					</div>
				</form>
			</div>

			<!-- Features Categories -->
			<div class="row">
				<div class="col-md-12">
					<h5 class="highlighted-categories-headline">Or browse featured categories:</h5>

					<div class="highlighted-categories">
						<!-- Box -->
						<a routerLink="listings-list-with-sidebar.html" class="highlighted-category">
							<!-- <i class="im im-icon-Home"></i> -->
							<h4>Serviced apartments</h4>
						</a>

						<!-- Box -->
						<a routerLink="listings-list-full-width.html" class="highlighted-category">
							<!-- <i class="im im-icon-Hamburger"></i> -->
							<h4>Bungalows</h4>
						</a>

						<!-- Box -->
						<a routerLink="listings-half-screen-map-list.html" class="highlighted-category">
							<!-- <i class="im im-icon-Electric-Guitar"></i> -->
							<h4>Cottages</h4>
						</a>

						<!-- Box -->
						<a routerLink="listings-half-screen-map-list.html" class="highlighted-category">
							<!-- <i class="im im-icon-Dumbbell"></i> -->
							<h4>Camps</h4>
						</a>
						<!-- Box -->
						<a routerLink="listings-half-screen-map-list.html" class="highlighted-category">
							<!-- <i class="im im-icon-Dumbbell"></i> -->
							<h4>Villas</h4>
						</a>
						<!-- Box -->
						<a routerLink="listings-half-screen-map-list.html" class="highlighted-category">
							<!-- <i class="im im-icon-Dumbbell"></i> -->
							<h4>Resorts</h4>
						</a>
					</div>

				</div>
			</div>
			<!-- Featured Categories - End -->

		</div>

	</div>
</div>
<!-- Trending -->
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<h3 class="headline centered margin-bottom-35 margin-top-70">
				<strong class="headline-with-separator">Trending HillStay's</strong>
				<span>Top Destinations to Visit in <?= date('Y') ?></span>
			</h3>
		</div>

		<div class="col-md-6">

			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox" data-background-image="/public/assets/images/Nainital.jpg">
				<div class="img-box-content visible">
					<h4>Nainital </h4>
					<span>14 Listings</span>
				</div>
			</a>

		</div>

		<div class="col-md-6">

			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox" data-background-image="/public/assets/images/manali.jpg">
				<div class="img-box-content visible">
					<h4>Manali</h4>
					<span>24 Listings</span>
				</div>
			</a>

		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox" data-background-image="/public/assets/images/darjeeling.jpg">
				<div class="img-box-content visible">
					<h4>Darjeeling </h4>
					<span>12 Listings</span>
				</div>
			</a>
		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox" data-background-image="/public/assets/images/Mussoorie.jpg">
				<div class="img-box-content visible">
					<h4>Mussoorie</h4>
					<span>9 Listings</span>
				</div>
			</a>
		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox" data-background-image="/public/assets/images/auli.jpg">
				<div class="img-box-content visible">
					<h4>Auli</h4>
					<span>5 Listings</span>
				</div>
			</a>
		</div>

	</div>
</div>
<!-- Most Visited Places -->
<section class="fullwidth border-top margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#fff">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-45">
					<strong class="headline-with-separator">Most Visited Places</strong>
					<span>Discover top-rated local businesses</span>
				</h3>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<?php foreach ($listings as $listing) : ?>
				<div class="col-lg-3 col-md-4 col-12 margin-bottom-35">
					<div class="listing-item-container compact" style="margin-bottom:5px;">
						<div class="listing-item">
							<img src="<?= $listing['coverimage'] ?>" onclick="window.location.href='<?= route_to('listingDetailsPage', base64_encode(base64_encode(base64_encode($listing['listing_id'])))) ?>'" style="display: block; width: 100%; min-height: 100%;">
							<div class="listing-badge now-open"><?= ucfirst($listing['placekind']) ?></div>
							<span class="like-icon"></span>
						</div>
					</div>
					<a href="<?= route_to('listingDetailsPage', base64_encode(base64_encode(base64_encode($listing['listing_id'])))) ?>">
						<span class="small">
							<!-- <span class="superhost-tag">superhost</span> -->
							<?= ucfirst($listing['placekind']) ?> - <?= $listing['totalBeds'] ?> beds
						</span>
						<span class="float-right">
							<i class="fa fa-star" style="color:#F91942"></i> 4.3
						</span><br>
						<p class="listing-name text-dark"><?= $listing['title'] ?> @ <?= $listing['location'] ?>
						</p>
						<span><strong>₹ <?= $listing['price'] ?></strong> / night</span>
					</a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

</section>
<!-- Info Section -->
<section class="fullwidth padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3 class="headline centered headline-extra-spacing">
					<strong class="headline-with-separator">Plan The Vacation of Your Dreams</strong>
					<span class="margin-top-25">Explore some of the best tips from around the world from our partners
						and friends.
						Discover some of the most popular listings!</span>
				</h3>
			</div>
		</div>

		<div class="row icons-container">
			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2 with-line">
					<i class="im im-icon-Map2"></i>
					<h3>Find Interesting Place</h3>
					<!-- <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis
						eros
						sollicitudin.</p> -->
				</div>
			</div>

			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2 with-line">
					<i class="im im-icon-Mail-withAtSign"></i>
					<h3>Contact a Few Owners</h3>
					<!-- <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus
						nullam
						viverra purus.</p> -->
				</div>
			</div>

			<!-- Stage -->
			<div class="col-md-4">
				<div class="icon-box-2">
					<i class="im im-icon-Checked-User"></i>
					<h3>Make a Reservation</h3>
					<!-- <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin
						feugiat
						consectetur.</p> -->
				</div>
			</div>
		</div>

	</div>
</section>

<style>
.datepicker2[readonly] {
    background: inherit;
}
	.panel-dropdown .panel-dropdown-content {
		width: fit-content;
	}

	.panel-dropdown a {
		padding: 9px 14px;
		margin: auto;
		display: block;
		width: 100%;
		height: 44px;
	}

	.flatpickr-current-month .flatpickr-monthDropdown-months {
		font-size: 15px;
		width: auto;
		display: inline;
	}

	.panel-dropdown {
		position: relative;
		display: block;
	}

	.homepage_subheading span {
		color: rgba(255, 255, 255, 0.9);
		background: rgba(0, 0, 0, 0.21);
		padding: 4px 12px;
		border-radius: 50px;
		transition: 0.3s;
	}

	.main-search-input .fa {
		color: #123815 !important;
	}
</style>

<?= $this->endSection(); ?>