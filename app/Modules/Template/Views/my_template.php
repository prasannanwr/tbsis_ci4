<!DOCTYPE html>
<html lang="en">

<head>
    <title>TBSIS - <?php echo (isset($title)? $title : '');?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/sb-admin.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('css/print.css'); ?>" media="print" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('css/plugins/morris.css'); ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('css/typography.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('js/datatable/data_table.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('js/choosen/chosen.css'); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
                                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
                                </script>
                                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js">
                                </script>
                            <![endif]-->
    <!-- jQuery Version 1.11.0 -->
    <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>">
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/modernizr.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/datepicker.js'); ?>">
    </script>
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url('js/plugins/morris/raphael.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('js/plugins/morris/morris.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('js/bootstrap-tooltip.js'); ?>">
    </script>
    <script src="<?php echo base_url('js/bootstrap-transition.js'); ?>">
    </script>
    <script src="<?php echo base_url('js/confirmation.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>

    <script src="<?php echo base_url('js/datatable/data_table.js'); ?>"></script>
    <!-- <script src="<?php echo base_url(); ?>js/plugins/morris/morris-data.js"></script>
                            -->
    <script src="<?php echo base_url('js/choosen/chosen.jquery.js'); ?>"></script>

</head>

<body class="d-flex flex-column min-vh-100">
    <div id="wrapper">
        <!-- Navigation -->
        <?=$this->include('\Modules\Reports\Views\layouts\top_navigation.php');?>
        <div id="page-wrapper" class="dashboard-section">
            <?php if (session()->getFlashdata("message")) :?>
                <div class="container-fluid">
                    <div class="alert <?=(session()->getFlashdata('alert-class') ? session()->getFlashdata('alert-class'): 'alert-success'); ?> alert-dismissable">
                        <?php echo session()->getFlashdata("message"); ?>
                    </div>
                </div>
            <?php endif ?>

            <?php //echo sprintf('%s/%s', $module, $view_file); ?>
            <?php //$this->load->view($module . '/' . $view_file); ?>
            <?php //return view('\Modules\Reports\Views\Gen_Overall_FYWise'); ?>
            <?=$this->renderSection("body") ?>
        </div>
        <!-- /#page-wrapper -->
            <footer class="footer-text mt-auto hidden-print">
            <p>TBSU/HELVETAS Swiss Intercooperation Nepal © 2023</p>
            <p>Trail Bridge Sub-Sector Project - Trail Bridge Strategy Information System</p>
            <p class="visible-xs visible-sm">Not supported in mobile devices.</p>
        </footer>
    </div>
</body>
<style>
    html {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .sidebar-nav {
        padding: 9px 0;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            //endDate: '+0d',
            //"setDate": new Date(),
            "autoclose": true
        });

        $obj = '.side-nav-wrapper';
        nH = $('html').height() - parseInt($($obj).css('top'));
        $($obj).height(nH);

        $('[data-toggle=confirmation]').confirmation();
        //$('#myTable1').dataTable({source:'http://asd.com/data'});
        $('.dataTable').dataTable();
    });
</script>
<script src="<?php echo base_url('/js/jqueryCalc.js'); ?>"></script>

</html>