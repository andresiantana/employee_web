<ul class="nav" id="main-menu">

    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>        
    </li>
    <li>
        <a href="#"><i class="fa fa-book"></i> Master<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#">Master 1</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-table"></i> Informasi<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'DaftarPegawai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/DaftarPegawai'); ?>">Daftar Pegawai</a>
            </li>
            <li>
                <a <?php if($menu == 'KartuPID'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/KartuPID'); ?>">Kartu PID</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart-o"></i> Laporan<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#">Laporan 1</a>
            </li>
        </ul>
    </li>
</ul>