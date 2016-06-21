<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/Dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a>
        <a <?php if($menu == 'lengkapiData'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/DataPegawai/lengkapiData'); ?>"><i class="fa fa-pencil-square-o"></i> Lengkapi Data</a>
        <a <?php if($menu == 'daftarPegawai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/DataPegawai'); ?>"><i class="fa fa-user"></i> Data Pegawai</a>
        <?php 
        	if(isset($userPegawai) && ($userPegawai->status_approve_sdm == 'Approved')){ 
		?>
        	<a <?php if($menu == 'pengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/PengajuanBiaya'); ?>"><i class="fa fa-file-text"></i> Pengajuan Biaya</a>
        	<a <?php if($menu == 'informasiPengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/PengajuanBiaya/informasi'); ?>"><i class="fa fa-table"></i> Informasi Pengajuan Biaya</a>
            <a <?php if($menu == 'kartuPID'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/KartuPID?pages=pegawai'); ?>"><i class="fa fa-credit-card"></i> Kartu PID</a>
            <a <?php if($menu == 'posisiPendanaanBeasiswa'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/PosisiPendanaanBeasiswa?pages=pegawai'); ?>"><i class="fa fa-money"></i> Posisi Pendanaan Beasiswa</a>
        <?php 
            }
        ?>
    </li>
</ul>