<!-- Mobile Navigation -->
<div class="mmenu-trigger">
	<button class="hamburger hamburger--collapse" type="button">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</button>
</div>

<!-- Main Navigation -->
<nav id="navigation" class="style-1">
	<ul id="responsive">
		<li><a href="<?= route_to('home_page') ?>">Home</a></li>
		<li><a href="#">Hillstays</a>
			<div class="mega-menu mobile-styles three-columns">
				<div class="mega-menu-section">
					<ul>
						<li class="mega-menu-headline">Hill Stations</li>
						<li><a routerLink="#">Nainital</a></li>
						<li><a routerLink="#">Chopta</a></li>
						<li><a routerLink="#">Manali</a></li>
						<li><a routerLink="#">Shimla</a></li>
						<li><a routerLink="#">Mussoorie</a></li>
					</ul>
				</div>
				<div class="mega-menu-section">
					<ul>
						<li class="mega-menu-headline">Browse</li>
						<li><a routerLink="#">off-Beat</a></li>
						<li><a routerLink="#">Cottages</a></li>
						<li><a routerLink="#">Camps</a></li>
						<li><a routerLink="#">Villas</a></li>
						<li><a routerLink="#">Appartments</a></li>
						<li><a routerLink="#">Hostels</a></li>
					</ul>
				</div>
				<div class="mega-menu-section">
					<ul>
						<li class="mega-menu-headline">Helpful Links</li>
						<li><a routerLink="#">How it Works</a></li>
						<li><a routerLink="#">About us</a></li>
						<li><a routerLink="#">FAQ</a></li>
						<li><a routerLink="#">Pricing</a></li>
						<li><a routerLink="#">Contact us</a></li>
					</ul>
				</div>
			</div>
		</li>

		<li><a routerLink="/stories">Stories</a>
			<ul>
				<li><a routerLink="#">Nature Walks</a></li>
				<li><a routerLink="#">Birds watching</a></li>
				<li><a routerLink="#">Adventure</a></li>
			</ul>
		</li>
		<li><a routerLink="/stories">Culture</a>
			<ul>
				<li><a routerLink="#">Organic Farming</a></li>
				<li><a routerLink="#">Kumaoni Cuisine</a></li>
			</ul>
		</li>

		<?php if (!session()->get('isUserLoggedIn')) : ?>
			<li>
				<a id="registerButton" href="#sign-in-dialog" class="sign-in popup-with-zoom-anim">Sign Up</a>
			</li>
			<li>
				<a id="loginButton" href="#sign-in-dialog" class="sign-in popup-with-zoom-anim">Login</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>
<div class="clearfix"></div>
<!-- Main Navigation / End -->

<!-- php core code for google login starts -->
<?php
$client2 = new \Google_Client();
$client2->setClientId(CLIENT_ID);
$client2->setClientSecret(CLIENT_SECRET);

$client2->setRedirectUri(base_url() . '/login');
$client2->addScope('email');
$client2->addScope('profile');
$googleLogin2 = $client2->createAuthUrl();

?>
<!-- php core code for google login ends -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

	<div class="small-dialog-header">
		<h3>Sign In</h3>
	</div>

	<!--Tabs -->
	<div class="sign-in-form style-1">

		<ul class="tabs-nav">
			<li class=""><a href="#tab1">Log In</a></li>
			<li><a href="#tab2">Register</a></li>
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="login" action="<?= route_to('login_page') ?>">
					<input hidden type="text" name="currentUrl" value="<?= uri_string() ?>" />
					<p class="form-row form-row-wide">
						<label for="username">Username:
							<i class="im im-icon-Male"></i>
							<input type="text" class="input-text" name="username" id="username" value="" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">Password:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password" />
						</label>
						<span class="lost_password">
							<a href="#">Lost Your Password?</a>
						</span>
					</p>

					<div class="form-row">
						<input type="submit" class="button border margin-top-5" name="login" value="Login" />
					</div>
					<?php if (isset($googleLogin2)) : ?>
						<div class="form-row">
							<a href='<?= $googleLogin2 ?>' type="button" class="button btn-google border btn-block mt-2">
								Continue with google
							</a>
						</div>
					<?php endif; ?>

				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">

				<form method="post" class="register" action="<?= route_to('register_page') ?>">
					<input hidden type="text" name="currentUrl" value="<?= uri_string() ?>" />

					<p class="form-row form-row-wide">
						<label for="firstName2">First Name:
							<i class="im im-icon-Male"></i>
							<input type="text" class="input-text" name="firstName" id="firstName2" value="" required />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="lastname2">Last Name:
							<i class="im im-icon-Male"></i>
							<input type="text" class="input-text" name="lastname" id="lastname2" value="" required />
						</label>
					</p>
					<p class="form-row form-row-wide">
						<label for="email2">Email Address:
							<i class="im im-icon-Mail"></i>
							<input type="email" class="input-text" name="email" id="email2" value="" required />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="usr_password">Password:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="usr_password" id="usr_password" required />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="usr_password_confirm">Repeat Password:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="usr_password_confirm" id="usr_password_confirm" required />
						</label>
					</p>

					<input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

					<?php if (isset($googleLogin)) : ?>
						<div class="form-row">
							<a href='<?= $googleLogin ?>' type="button" class="button btn-google border btn-block mt-2">
								Continue with google
							</a>
						</div>
					<?php endif; ?>
				</form>
			</div>

		</div>
	</div>
</div>
<!-- Sign In Popup / End -->

<script>
	function detectMob() {
		return navigator.userAgent;
		// return ((window.innerWidth <= 800) && (window.innerHeight <= 600));
	}
	console.log(detectMob());
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	if (isMobile.iOS() || isMobile.any()) {
		if (document.getElementById('loginButton')) {
			document.getElementById('loginButton').setAttribute('href', '/login');
		}
		if (document.getElementById('registerButton')) {
			document.getElementById('registerButton').setAttribute('href', '/register');
		}
	} else {
		if (document.getElementById('loginButton')) {
			document.getElementById('loginButton').setAttribute('href', '#sign-in-dialog');
		}
		if (document.getElementById('registerButton')) {
			document.getElementById('registerButton').setAttribute('href', '#sign-in-dialog');
		}
	}
	// document.getElementById
</script>