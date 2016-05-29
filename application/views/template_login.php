<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/bootstrap.css');?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/font-awesome.css');?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/js/morris/morris-0.4.3.min.css');?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url('assets/template/Bluebox/assets/css/custom-styles.css');?>" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/cssCharts.css');?>"> 
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
                <div class="navbar-brand">
                    <table>
                        <tr>
                            <td><img src="<?php echo base_url().'data/images/logo2.png'; ?>" width="50" height="40"></td>
                            <td>&nbsp;&nbsp;&nbsp;<strong><font size="4">Pengembangan SDM</font></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </nav>
        <div id="page-wrapper" style="margin-left: 0px;">
            <div class="page-header" style="background-color:transparent;">               
            </div>
            <div id="page-inner">           
                <?php echo $_content; ?>
                <footer>
                    <center>
                        <p>
                            <!-- All right reserved. Template by: <a href="#">WebThemez</a> -->
                        </p>
                    </center>               
                </footer>
            </div>
        </div>
    </div>
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/bootstrap.min.js');?>"></script> 
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery.metisMenu.js');?>"></script>
	<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart.js');?>"></script>
	<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart-data.js');?>"></script>	
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/jquery.chart.js');?>"></script>	
</body>
</html>