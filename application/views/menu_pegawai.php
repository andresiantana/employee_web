<ul class="nav" id="main-menu">

    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/Dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a <?php if($menu == 'lengkapiData'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/DataPegawai/lengkapiData'); ?>">Lengkapi Data</a>
        <a <?php if($menu == 'daftarPegawai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/DataPegawai'); ?>">Data Pegawai</a>
    </li>
</ul>