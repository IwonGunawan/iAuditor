<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$page." - iAuditor" ;?></title>
    <meta name="description" content="Admin Page - Iwon.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?=base_url('assets/vendor/apple-icon.png');?>">
    <link rel="shortcut icon" href="<?=base_url('assets/vendor/favicon.ico');?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/themify-icons/css/themify-icons.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/flag-icon-css/css/flag-icon.min.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/selectFX/css/cs-skin-elastic.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/vendors/jqvmap/dist/jqvmap.min.css'); ?> ">


    <link rel="stylesheet" href="<?= base_url('assets/vendor/sufee-admin/assets/css/style.css'); ?>">

    <link href='<?=base_url('assets/css/font-google.css');?>' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">


</head>

<body>


    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?=$this->load->view("app_sidebar");?>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">            
            <?=$this->load->view("app_topbar"); ?>
        </header>

        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <?=$this->load->view("app_breadcrumbs"); ?>
        </div>

        <!-- Content -->
            <?php
            $lPage = strtolower($page);
            $this->load->view($lPage. "/v_". strtolower($page)); 
            ?>
        <!-- END Content -->

    </div>
    <!-- Right Panel -->

    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/jquery/dist/jquery.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/popper.js/dist/umd/popper.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/bootstrap/dist/js/bootstrap.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/assets/js/main.js'); ?> "></script>

    <script src="<?=base_url('assets/vendor/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/assets/js/init-scripts/data-table/datatables-init.js');?>"></script>


    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/chart.js/dist/Chart.bundle.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/assets/js/dashboard.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/assets/js/widgets.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/jqvmap/dist/jquery.vmap.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/sufee-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?> "></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>