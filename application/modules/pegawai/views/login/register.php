<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
                <a class="navbar-brand" href="<?php echo base_url('pegawai/login'); ?>"><strong>Employee Web</strong></a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <div id="page-wrapper" style="margin-left: 0px;">
            <div class="page-header" style="background-color:transparent;">               
            </div>
            <div id="page-inner">           
                <div class="row">                    
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">                            
                            <div class="panel-heading" style="text-align:center;">
                            Registrasi Pegawai
                        </div>
                        <div class="panel-body">
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>
                    
                            <?php echo form_open("pegawai/registrasi/register_proses"); ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" name="username" placeholder="Username">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" type="password" id="password_ulang" name="password_ulang" placeholder="Ulangi Password" onblur="cekPassword(this);">
                                </div>
                                <button class="button btn btn-primary btn-large">Registrasi</button> 
                                kembali ke </i>&nbsp;<span><a href="<?php echo base_url('pegawai/login'); ?>">Login</a></span>
                            <?php echo form_close(); ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-12"></div>      
                </div>  
                <!-- /. ROW  -->        
                <footer>
                    <center>
                        <p>
                            All right reserved. Template by: <a href="#">WebThemez</a>
                        </p>
                    </center>               
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
	
    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/custom-scripts.js');?>"></script>

    <script type="text/javascript">
        function cekPassword(obj){
            var pass_ulang = obj.value;
            var pass_awal = $('#password').val();
            if(pass_ulang != pass_awal){
                alert("Password tidak sama dengan sebelumnya");
                return false;
            }
        }
    </script>
</body>
</html>