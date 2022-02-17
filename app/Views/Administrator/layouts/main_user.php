<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= APP_ICON ?>">
    <title><?= APP_NAME ?></title>
    <!-- StyleSheets  -->
    <link rel="shortcut icon" href="/public/assets/images/favicon.ico">
    <link rel="stylesheet" href="/public/dashboard/assets/css/dashlite.css?ver=2.2.0">
    <link id="skin-default" rel="stylesheet" href="/public/dashboard/assets/css/theme.css?ver=2.2.0">
    <link rel="stylesheet" href="/public/assets/css/style2.css">
    <!-- page css -->
    <?php if (isset($pageCSS)) {
        echo $pageCSS;
    } ?>
</head>


<body class="nk-body bg-white npc-default has-aside ">

    <script>
        var dark_mode = localStorage.getItem('dark_mode');
        if (dark_mode) {
            document.body.classList.add("dark-mode");
        }
    </script>

    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">

                <!-- Header START -->
                <?php echo view('Administrator/globals/headNav'); ?>
                <!-- Header END -->

                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container wide-xl">
                        <div class="nk-content-inner">

                            <div class="nk-content-body">

                                <!-- MAIN CONTENT START -->
                                <?= $this->renderSection('content'); ?>
                                <!-- MAIN CONTENT END -->

                                <!-- Footer START -->
                                <?php echo view('Administrator/globals/footer'); ?>
                                <!-- Footer END -->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content @e -->

            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/dashboard/assets/js/bundle.js?ver=2.2.0"></script>
    <script src="/public/dashboard/assets/js/scripts.js?ver=2.2.0"></script>
    <script src="/public/dashboard/assets/js/charts/gd-default.js?ver=2.2.0"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $this->renderSection('script'); ?>
    <!-- page js -->
    <?php if (isset($pageJS)) {
        echo $pageJS;
    } ?>

</body>

</html>