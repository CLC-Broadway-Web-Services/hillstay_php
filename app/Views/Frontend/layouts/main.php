<!DOCTYPE html>
<html lang="en">
<?php

$pageTitle = APP_NAME;
$pageDescription = APP_DESCRIPTION;
$pageKeywords = APP_KEYWORDS;
$pageAuthor = APP_AUTHOR;
$pageOwner = APP_OWNER;
$pageType = APP_PAGE_TYPE;

if (isset($title)) {
	$pageTitle = $title;
}
if (isset($description)) {
	$pageDescription = $description;
}
if (isset($keywords)) {
	$pageKeywords = $keywords;
}
if (isset($author)) {
	$pageAuthor = $author;
}
if (isset($owner)) {
	$pageOwner = $owner;
}
if (isset($type)) {
	$pageType = $type;
}

?>

<head>
	<meta charset="utf-8" />
	<title><?= $pageTitle ?></title>
	<base href="<?= BASE_HREF ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?= $pageDescription ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="owner" content="<?= $pageOwner ?>" />
	<meta name="type" content="<?= $pageType ?>" />
	<!-- favicon -->
	<link rel="shortcut icon" href="/public/assets/images/favicon.ico">
	<!-- css -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/public/assets/css/style2.css">

	<!-- page css -->
	<?php if (isset($pageCSS)) {
		echo $pageCSS;
	} ?>

</head>

<body>
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header Container
		================================================== -->
		<?= view('Frontend/globals/header'); ?>
		<!-- Header Container / End -->

		<!--page here-->
		<?= $this->renderSection('content'); ?>
		<!--page here-->

		<?php if (!isset($noFooter)) : ?>
			<!-- Footer
		================================================== -->
			<?= view('Frontend/globals/footercommon'); ?>
			<!-- Footer / End -->
		<?php endif; ?>

	</div>
	<!-- Wrapper / End -->

	<?= view('Frontend/globals/scripts'); ?>

	<?= $this->renderSection('footerScripts'); ?>
	<script src="/public/custom/assets/js/homepage.js"></script>
	<script>
		if (isMobile.iOS() || isMobile.any()) {
			if (document.getElementById('moreFilter')) {
				document.getElementById('moreFilter').setAttribute('href', '/login');
			}
			if (document.getElementById('registerButton')) {
				document.getElementById('registerButton').setAttribute('href', '/register');
			}
		} else {
			if (document.getElementById('moreFilter')) {
				document.getElementById('moreFilter').setAttribute('href', '#filter-in-dialog');
			}
			if (document.getElementById('registerButton')) {
				document.getElementById('registerButton').setAttribute('href', '#filter-in-dialog');
			}
		}
	</script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata("success")) { ?>
        Swal.fire('Data saved successfully')

    <?php } ?>

</script>
</body>

</html>