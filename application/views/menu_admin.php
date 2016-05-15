<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a <?php if($menu == 'rolePemakai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/rolePemakai'); ?>">Daftar User</a>
        <a <?php if($menu == 'lokasiPendidikan'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/lokasiPendidikan'); ?>">Lokasi Pendidikan</a>
        <a <?php if($menu == 'fakultas'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/fakultas'); ?>">Fakultas</a>
        <a <?php if($menu == 'prodi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/prodi'); ?>">Prodi</a>
        <a <?php if($menu == 'jenisSertifikasi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/jenisSertifikasi'); ?>">Jenis Sertifikasi</a>
    </li>   
</ul>