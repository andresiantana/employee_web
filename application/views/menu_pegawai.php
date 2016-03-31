<ul class="nav" id="main-menu">

    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/Dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a <?php if($menu == 'dataPegawai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('pegawai/DataPegawai'); ?>">Daftar Pegawai</a>
    </li>
</ul>