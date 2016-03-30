<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a <?php if($menu == 'rolePemakai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('admin/rolePemakai'); ?>">Daftar User</a>
    </li>   
</ul>