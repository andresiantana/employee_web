<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a>        
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
            <li>
                <a <?php if($menu == 'PengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/PengajuanBiaya'); ?>">Pengajuan Biaya</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart-o"></i> Laporan<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#"></a>
            </li>
        </ul>
    </li>
</ul>