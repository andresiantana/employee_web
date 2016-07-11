<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengembangan SDM</title>
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
    <!-- Pagination Styles-->
    <link href="<?php echo base_url('assets/css/pagination.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/datepicker.css');?>" rel="stylesheet" />
    <!-- Google Fonts-->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/cssCharts.css');?>">     
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/modal/jquery.modal.css');?>">     
    <link rel="stylesheet" href="<?php echo base_url('assets/template/Bluebox/assets/modal/hightlight/github.css');?>">     

    <!-- untuk dialog box -->
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery/Remodal-master/dist/remodal.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery/Remodal-master/dist/remodal-default-theme.css');?>">
    <style>
        .remodal-bg.with-red-theme.remodal-is-opening,
        .remodal-bg.with-red-theme.remodal-is-opened {
          filter: none;
        }

        .remodal-overlay.with-red-theme {
          background-color: #f44336;
        }

        .remodal.with-red-theme {
          background: #fff;
        }
    </style>

    <!-- untuk datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datepicker/css/ws-calendar.default.min.css');?>"/>    
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
                            <td>&nbsp;&nbsp;&nbsp;<strong><font size="4"><?php echo $judul; ?></font></strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i>
                        <?php
                            $tanda = '';
                            if(count($isi_notifikasi) > 0 && count($isi_notifikasi2) > 0){
                                $tanda = '-';
                            }
                        ?>
                        <?php 
                            echo isset($isi_notifikasi) ? ((count($isi_notifikasi) > 0) ? count($isi_notifikasi) : "") : ''; 
                        ?>
                        <?php 
                            echo isset($isi_notifikasi2) ? ((count($isi_notifikasi2) > 0) ? $tanda.count($isi_notifikasi2) : "") : '';
                        ?>
                        <i class="fa fa-caret-down"></i>
                    </a>                    
                    <?php
                       if (count($isi_notifikasi) > 0 || count($isi_notifikasi2) > 0) {
                            echo '<ul class="dropdown-menu dropdown-alerts" style="overflow: scroll; height: 300px;">';
                            echo $_notifikasi; 
                            echo '</ul>';
                       } else {
                            echo '<ul class="dropdown-menu dropdown-alerts" height: 100px;">';
                            echo "<center><i><font color='red'>Tidak ada pemberitahuan</font></i></center>";
                            echo '</ul>';
                       }
                   ?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url().strtolower($nama_role)."/Dashboard/editProfile/".$username; ?>"><i class="fa fa-user fa-fw"></i> Profil User</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url().strtolower($nama_role)."/Dashboard/logout"; ?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div id="sideNav" href="">
                <i class="fa fa-caret-right"></i>
            </div>
            <div class="sidebar-collapse">
                <?php echo $_menu; ?>              
            </div>
        </nav>
      
		<div id="page-wrapper">
            <div class="header"> 
                <h1 class="page-header">
                    <?php echo isset($judulHeader) ? $judulHeader : ""; ?> <small></small>
                    <div id="tgl" style="width:200px;float:right;">                        
                        <div class="form-group">
                            <label>
                                <font style="font-size:10px;margin-left:-50px;">Tanggal :</font>                                
                            </label>                            
                            <div class="controls">
                                <input class="form-control" style="width:200px;float:right;margin-top:-30px;" type="text" name="tanggal_input" id="tanggal_input" value="<?php echo date('d M Y'); ?>" readonly=true>
                            </div>
                        </div>
                    </div>
                </h1>									
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
        </div>
    </div>
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url("assets/jquery/Remodal-master/libs/jquery/dist/jquery.min.js"); ?>"><\/script>')</script>
    <script src="<?php echo base_url('assets/jquery/Remodal-master/dist/remodal.js');?>"></script>

    <!-- Bootstrap Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/bootstrap.min.js');?>"></script>	 
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery.metisMenu.js');?>"></script>
    <!-- Morris Chart Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/morris/raphael-2.1.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/morris/morris.js');?>"></script>	
	<!--<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart.js');?>"></script>-->
	<!--<script src="<?php echo base_url('assets/template/Bluebox/assets/js/easypiechart-data.js');?>"></script>	-->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/Lightweight-Chart/jquery.chart.js');?>"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/dataTables/jquery.dataTables.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/dataTables/dataTables.bootstrap.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/popup/popup-window.js');?>"> </script>    
    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/template/Bluebox/assets/js/custom-scripts.js');?>"></script>
    <script src="<?php echo base_url('assets/template/Bluebox/assets/modal/highlight/highlight.pack.js');?>"></script>
    
    <script src="<?php echo base_url('assets/datepicker/js/jquery-1.11.3.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datepicker/js/ws-calendar-min.js');?>"></script>
    <script src="<?php echo base_url('assets/jquery/datepicker_a.min.js');?>"></script>
    <script src="<?php echo base_url('assets/jquery/datepicker_b.min.js');?>"></script>
    <script src="<?php echo base_url('assets/jquery/jquery.maskMoney.min.js');?>"></script>
    <script src="<?php echo base_url('assets/jquery/accounting.min.js');?>"></script>
    <script src="<?php echo base_url('assets/jquery/accounting.js');?>"></script>

    <script type="text/javascript">
        $(function(){
            $( ".datepickerNew" ).datepicker(
            { 
                dateFormat: 'yy-mm-dd',
                changeMonth: true,changeYear: true,
                yearRange: "-80:+10"
            }
            );
            $(document).on('opening', '.remodal', function () {
                console.log('opening');
            });

              $(document).on('opened', '.remodal', function () {
                console.log('opened');
              });

              $(document).on('closing', '.remodal', function (e) {
                console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
              });

              $(document).on('closed', '.remodal', function (e) {
                console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
              });

              $(document).on('confirmation', '.remodal', function () {
                console.log('confirmation');
              });

              $(document).on('cancellation', '.remodal', function () {
                console.log('cancellation');
              });
        });
    </script>

    <!-- Events -->
    <!--<script>
      

    //  Usage:
    //  $(function() {
    //
    //    // In this case the initialization function returns the already created instance
    //    var inst = $('[data-remodal-id=modal]').remodal();
    //
    //    inst.open();
    //    inst.close();
    //    inst.getState();
    //    inst.destroy();
    //  });

      //  The second way to initialize:
      // $('[data-remodal-id=modal2]').remodal({
      //   modifier: 'with-red-theme'
      // });
    </script>-->

    <script type="text/javascript">
        function checkFormat(){
            unformatNumberSemua();
            return true;
        }

        $(document).ready(function(){
            formatNumberSemua();
            $(".integer").maskMoney(
                {"symbol":"","defaultZero":true,"allowZero":true,"decimal":".","thousands":",","precision":0}
            );
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
        });
    </script>
</body>
</html>