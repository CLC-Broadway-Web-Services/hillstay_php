<header id="header-container" class="<?php if(isset($noStickyHeader, $noFixedHeader)) {echo 'fullwidth';} elseif(isset($noStickyHeader)) {echo 'fixed fullwidth';}?>">
	<!-- Header -->
	<div id="header" class="<?php if(isset($noStickyHeader)) echo 'not-sticky'?>">
		<div class="container">
			<div class="left-side">
				<!-- Logo -->
				<div id="logo">
					<a href="<?= route_to('home_page') ?>">
						<img src="/public/assets/images/logo2.png" data-sticky-logo="/public/assets/images/logo.png" alt="">
					</a>
				</div>
				<?= view('Frontend/globals/commonleftmenu'); ?>
				<!-- <app-commonleftmenu></app-commonleftmenu> -->
			</div>
			<?= view('Frontend/globals/commonrightmenu'); ?>
			<!-- <app-commonrightmenu></app-commonrightmenu> -->
		</div>
	</div>
	<!-- Header / End -->
</header>
