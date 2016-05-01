<ul class="nav" id="main-menu">

    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-book"></i> Master<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'coa'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Coa'); ?>">Coa</a>
            </li>
            <li>
                <a <?php if($menu == 'kategoriBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/KategoriBiaya'); ?>">Kategori Biaya Pengajuan</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-list"></i> Transaksi<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#">Transaksi 1</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-table"></i> Informasi<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'PengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/PengajuanBiaya'); ?>">Pengajuan Biaya</a>
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