<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Control Panel</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png">

    <!-- page css -->
    <?php if (isset($pageCSS)) {
        echo $pageCSS;
    } ?>

    <!-- Core css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="layout">

            <!-- Header START -->
            <?php echo view('Admin/globals/headNav'); ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php echo view('Admin/globals/sideNav'); ?>
            <!-- Side Nav END -->

            <?= $this->renderSection('content'); ?>

        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="/assets/js/vendors.min.js"></script>
    <script src="/assets/js/globalCustom.js"></script>

    <!-- page js -->
    <?php if (isset($pageJS)) {
        echo $pageJS;
    } ?>

    <!-- Core JS -->
    <script src="/assets/js/app.min.js"></script>

</body>

</html>