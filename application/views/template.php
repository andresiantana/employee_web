<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Web</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/bootstrap.css');?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/font-awesome.css');?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/js/morris/morris-0.4.3.min.css');?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/custom-styles.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/template/Bluebox/assets/datepicker/css/datepicker.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/template/Bluebox/assets/popup/popup-window.css');?>" rel="stylesheet" />
    <!-- Google Fonts-->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/cssCharts.css');?>">     
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/modal/jquery.modal.css');?>">     
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/modal/hightlight/github.css');?>">     
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('admin/login'); ?>"><strong><?php echo $judul; ?></strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a> -->
                    <ul class="dropdown-menu dropdown-messages">
                       <!--  <li>
                            <a href="#">
                                <div>
                                    <strong>John Doe</strong>
                                    <span class="pull-right text-muted">
                                        <em>Today</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</div>
                            </a>
                        </li>
                        <li class="divider"></li> -->
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                   <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a> -->
                    <ul class="dropdown-menu dropdown-tasks">
                        <!-- <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li> -->
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i>
                        <?php
                            $tanda = '';
                            if(count($isi_notifikasi) > 0 && count($isi_notifikasi2) > 0){
                                $tanda = '-';
                            }
                        ?>
                        <?php echo isset($isi_notifikasi) ? ((count($isi_notifikasi) > 0) ? count($isi_notifikasi) : "") : ''; ?> <?php echo isset($isi_notifikasi2) ? ((count($isi_notifikasi2) > 0) ? $tanda.count($isi_notifikasi2) : "") : ''; ?>
                        <i class="fa fa-caret-down"></i>
                    </a>                    
                   <?php
                       if (count($isi_notifikasi) > 0 && count($isi_notifikasi2) > 0) {
                            echo '<ul class="dropdown-menu dropdown-alerts" style="overflow: scroll; height: 300px;">';
                            echo $_notifikasi; 
                            echo '</ul>';
                       } else {
                            echo '<ul class="dropdown-menu dropdown-alerts" height: 100px;">';
                            echo "<center><i><font color='red'>Tidak ada pemberitahuan</font></i></center>";
                            echo '</ul>';
                       }
                   ?>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url().strtolower($nama_role)."/Dashboard/editProfile/".$username; ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url().strtolower($nama_role)."/Dashboard/logout"; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
		<div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
            <div class="sidebar-collapse">
                <?php echo $_menu; ?>              
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
		<div id="page-wrapper">
            <div class="header"> 
                <h1 class="page-header">
                    <?php echo isset($judulHeader) ? $judulHeader : ""; ?> <small></small>
                </h1>
                <ol class="breadcrumb">
                    <!-- <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li> -->
                </ol> 									
            </div>
            <div id="page-inner">
                <?php echo $_content; ?>

                <!-- Dialog untuk Approve -->
                <input type="hidden" id="id_notifikasi">
                <div   class="popup_window_css" id="sample">
                <table class="popup_window_css">
                <tr    class="popup_window_css">
                <td    class="popup_window_css">
                <div   class="popup_window_css_head">
                <img src="<?php echo base_url('assets/template/Bluebox/assets/popup/images/close.gif');?>" alt="" width="9" height="9" onclick="close();"/>Notifikasi</div>
                <div   class="popup_window_css_body">
                    <div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;">
                        <div id="isi_pesan">

                        </div>
                    </div>
                </div>
				<footer>
                    <!-- <p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p>	 -->
                </footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/bootstrap.min.js');?>"></script>
	 
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery.metisMenu.js');?>"></script>
    <!-- Morris Chart Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/morris/raphael-2.1.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/morris/morris.js');?>"></script>
	
	<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart.js');?>"></script>
	<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart-data.js');?>"></script>
	
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/jquery.chart.js');?>"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/dataTables/jquery.dataTables.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/dataTables/dataTables.bootstrap.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/popup/popup-window.js');?>"> </script>
    <script>
        function close(){
            alert("a");
        }
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });


    </script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/custom-scripts.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/modal/jquery.modal.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/modal/jquery.modal.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/modal/highlight/highlight.pack.js');?>"></script>
    <script type="text/javascript">
        $('.numbers-only').keyup(function() {
            var d = $(this).attr('numeric');
            var value = $(this).val();
            var orignalValue = value;
            value = value.replace(/[0-9]*/g, "");
            var msg = "Only Integer Values allowed.";

            if (d == 'decimal') {
            value = value.replace(/\./, "");
            msg = "Only Numeric Values allowed.";
            }

            if (value != '') {
              orignalValue = orignalValue.replace(/([^0-9].*)/g, "")
              $(this).val(orignalValue);
            }
        });
    </script>
</body>
</html>