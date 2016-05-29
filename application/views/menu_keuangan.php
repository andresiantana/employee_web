<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a>
    </li>
    <li id="master">
        <a href="#"><i class="fa fa-book"></i> Master<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'coa'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Coa'); ?>">Coa</a>
            </li>
            <li>
                <a <?php if($menu == 'kategoriBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/KategoriBiaya'); ?>">Kategori Biaya Pengajuan</a>
            </li>
            <li>
                <a <?php if($menu == 'cabangBank'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/CabangBank'); ?>">Cabang Bank</a>
            </li>
        </ul>
    </li>
    <li id="informasi">
        <a href="#"><i class="fa fa-table"></i> Informasi<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'PengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/PengajuanBiaya'); ?>">Pengajuan Biaya</a>
            </li>
        </ul>
    </li>
    <li id="laporan">
        <a href="#"><i class="fa fa-bar-chart-o"></i> Laporan<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a <?php if($menu == 'jurnal'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Jurnal'); ?>">Jurnal</a>
            </li>
            <li>
                <a <?php if($menu == 'bukuBesar'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/BukuBesar'); ?>">Buku Besar</a>
            </li>
            <li>
                <a <?php if($menu == 'KartuPID'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/KartuPID'); ?>">Kartu PID</a>
            </li>
            <li>
                <a <?php if($menu == 'pengeluaran'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Pengeluaran'); ?>">Pengeluaran</a>
            </li>
            <li>
                <a <?php if($menu == 'amortisasi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Amortisasi'); ?>">Amortisasi</a>
            </li>
        </ul>
    </li>
</ul>