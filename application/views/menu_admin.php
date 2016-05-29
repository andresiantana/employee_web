<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a>
        <a <?php if($menu == 'rolePemakai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/rolePemakai'); ?>"><i class="fa fa-user"></i> Daftar User</a>
        <a <?php if($menu == 'lokasiPendidikan'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/lokasiPendidikan'); ?>"><i class="fa fa-map-marker"></i> Lokasi Pendidikan</a>
        <a <?php if($menu == 'fakultas'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/fakultas'); ?>"><i class="fa fa-home"></i> Fakultas</a>
        <a <?php if($menu == 'prodi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/prodi'); ?>"><i class="fa fa-thumb-tack"></i> Prodi</a>
        <a <?php if($menu == 'jenisSertifikasi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/jenisSertifikasi'); ?>"><i class="fa fa-files-o"></i> Jenis Sertifikasi</a>
    </li>   
</ul>