<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>

<!-- Search Area -->
<div class="main-search-container centered" style="background-image: url(/public/assets/images/slider_image.webp);">
	<div class="main-search-inner">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
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
								<input bsDaterangepicker [bsConfig]="calendarOptions" [minDate]="minDate" type="text"
									placeholder="Checkin - Checkout" readonly>
							</div>
							<a><i class="fa fa-calendar"></i></a>
						</div>

						<div class="main-search-input-item selectiondropdown-input" style="user-select:none;">
							<div class="selectiondropdown">
								<a id="selectiondropdownitem" onclick="selectGuests()">
									Guests <span class="qtyTotal" id="totalGuests">0</span>
									Infants <span class="qtyTotal" id="infantstotal">0</span>
								</a>
								<div id="selectiondropdowncontent" class="selectiondropdowncontent" style="width: 100%;">
									<!-- Quantity Buttons -->
									<div class="qtyButtons">
										<div class="qtyTitle">Adults</div>
										<div onclick="adultdec()" class="qtyDec"></div>
										<input type="text" name="qtyInput" id="adultvalue" value="0" readonly>
										<div onclick="adultinc()" class="qtyInc"></div>
									</div>

									<div class="qtyButtons">
										<div class="qtyTitle">Childrens</div>
										<div onclick="childdec()" class="qtyDec"></div>
										<input type="text" name="qtyInput" id="childvalue" value="0" readonly>
										<div onclick="childinc()" class="qtyInc"></div>
									</div>
									<div class="qtyButtons">
										<div class="qtyTitle">Infants</div>
										<div onclick="infantdec()" class="qtyDec"></div>
										<input type="text" name="qtyInput" id="infantstotal2" value="0" readonly>
										<div onclick="infantinc()" class="qtyInc"></div>
									</div>
								</div>
							</div>
						</div>

						<button class="button" routerLink="#">Search</button>

					</div>
				</div>
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
				<span>Top Destinations to Visit in {{currentYear}}</span></h3>
		</div>

		<div class="col-md-6">

			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox"
				data-background-image="assets/images/Nainital.jpg">
				<div class="img-box-content visible">
					<h4>Nainital </h4>
					<span>14 Listings</span>
				</div>
			</a>

		</div>

		<div class="col-md-6">

			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox"
				data-background-image="assets/images/manali.jpg">
				<div class="img-box-content visible">
					<h4>Manali</h4>
					<span>24 Listings</span>
				</div>
			</a>

		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox"
				data-background-image="assets/images/darjeeling.jpg">
				<div class="img-box-content visible">
					<h4>Darjeeling </h4>
					<span>12 Listings</span>
				</div>
			</a>
		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox"
				data-background-image="assets/images/Mussoorie.jpg">
				<div class="img-box-content visible">
					<h4>Mussoorie</h4>
					<span>9 Listings</span>
				</div>
			</a>
		</div>

		<div class="col-md-4">
			<!-- Image Box -->
			<a href="listings-list-with-sidebar.html" class="img-box alternative-imagebox"
				data-background-image="assets/images/auli.jpg">
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
			<div class="col-lg-3 col-md-4 col-12 margin-bottom-35" *ngFor="let item of listingItems">
				<div class="listing-item-container compact" style="margin-bottom:5px;">
					<div class="listing-item">
						<img [src]="item['coverimage']" routerLink="/place/{{item['listingID']}}"
							style="display: block; width: 100%; min-height: 100%;">
						<div class="listing-badge now-open">{{item['placekind']['name']}}</div>

						<span class="like-icon"></span>
					</div>
				</div>
				<div routerLink="/place/{{item['listingID']}}" style="cursor:pointer;">
					<span class="small"><span class="superhost-tag">superhost</span> {{item['placekind']['name']}} -
						{{item['totalbeds']}} beds</span>
					<span class="float-right">
						<i class="fa fa-star" style="color:#F91942"></i> 4.3
					</span><br>
					<p class="listing-name text-dark">{{item['title']}} @ {{item['location']}}
					</p>
					<span><strong>₹{{item['price']}}</strong> / night</span>
				</div>
			</div>

			<!-- <div class="col-lg-3 col-md-4 col-12" *ngFor="let item of listingItems">
				<a routerLink="/place/{{item['listingID']}}" class="listing-item-container compact">
					<div class="listing-item">
						<img [src]="item['coverimage']" [alt]="item['title']">

						<div class="listing-badge now-open">{{item['placekind']['name']}}</div>

						<div class="listing-item-content">
							<div class="numerical-rating" data-rating="4.3"></div>
							<h3>{{item['title']}}</h3>
							<span>{{item['location']}}</span>
						</div>
						<span class="like-icon"></span>
					</div>
				</a>
			</div> -->

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
.selectiondropdowncontent {
	display: none;
  border: none;
  overflow: visible;
  padding: 20px;
  box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.1);
  opacity: 1;
  visibility: visible;
  white-space: normal;
  border-radius: 4px;
  transition: all 0.3s;
  position: absolute;
  top: 44px;
  left: 0;
  z-index: 110;
  background: #fff;
}

.selectiondropdown a {
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 16px;
  font-weight: 600;
  height: auto;
  padding: 10px 16px;
  line-height: 30px;
  margin: 0 0 15px;
  position: relative;
  background-color: #fff;
  text-align: left;
  color: #888;
  display: block;
  width: 100%;
  transition: color 0.3s;
  outline: none !important;
  text-decoration: none;
}

.selectiondropdown a .qtyTotal {
  border-radius: 50%;
  color: #fff;
  display: inline-block;
  font-size: 11px;
  font-weight: 600;
  font-family: open sans, sans-serif;
  line-height: 18px;
  text-align: center;
  position: relative;
  top: -2px;
  left: 2px;
  height: 18px;
  width: 18px;
  background-color: #123815;
}

.selectiondropdown a:after {
  font-size: 20px;
  color: silver;
  margin-left: 0;
  position: absolute;
  right: 20px;
  margin-left: 0;
  content: "";
  font-family: fontawesome;
  color: #66676b;
  font-weight: 500;
  padding-left: 0;
  transition: all 0.3s;
  display: inline-block;
}

.dropdown-toggle::after {
  border-top: 0;
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

<script>
	var selectiondropdownitem = document.getElementById("selectiondropdownitem");
	var basiclinkdropdown = document.getElementById("selectiondropdowncontent");

	let totalGuests = document.getElementById("totalGuests");
	let infantstotal = document.getElementById("infantstotal");
	let infantstotal2 = document.getElementById("infantstotal2").value;
	let adultvalue = document.getElementById("adultvalue").value;
	let childvalue = document.getElementById("childvalue").value;

	if(adultvalue == 0 && childvalue == 0) {
		totalGuests.html = 0;
	}

	function selectGuests(){
		console.log(totalGuests);
		console.log(infantstotal2);
		console.log('start');
		if(basiclinkdropdown.style.display == "block") {
			basiclinkdropdown.style.display = "none"
		} else {
			basiclinkdropdown.style.display = "block"
		}
	}


	// totalGuests = 0;
	// infantstotal = 0;
	// adultvalue = 0;
	// childvalue = 0;

	function adultdec() {
		console.log('adultdec');
		if (totalGuests.html > 0 && adultvalue > 0) {
			totalGuests.html -= 1;
			adultvalue -= 1;
		}
	}
	function adultinc() {
		console.log('adultinc');
		if (totalGuests.html < 26 && adultvalue < 16) {
			totalGuests.html += 1;
			adultvalue += 1;
		}
	}
	function childdec() {
		console.log('childdec');
		if (totalGuests.html > 0 && childvalue > 0) {
			totalGuests.html -= 1;
			childvalue -= 1;
		}
	}
	function childinc() {
		console.log('childinc');
		if (totalGuests.html < 26 && childvalue < 5) {
			totalGuests.html += 1;
			childvalue += 1;
		}
	}
	function infantdec() {
		console.log('infantdec');
		if (infantstotal > 0) {
			infantstotal -= 1;
		}
	}
	function infantinc() {
		console.log('infantinc');
		if (infantstotal < 5) {
			infantstotal += 1;
		}
	}

</script>

<?php $pageJS = '<script></script>'; ?>

<?= $this->endSection(); ?>