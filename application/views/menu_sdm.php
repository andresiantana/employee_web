<ul class="nav" id="main-menu">
    <li>
        <a <?php if($menu == 'beranda'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a>        
    </li>
    <li id="informasi_header">
        <a href="#"><i class="fa fa-table"></i> Informasi<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" id="informasi">
            <li>
                <a <?php if($menu == 'daftarPegawai'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/DaftarPegawai'); ?>">Daftar Pegawai</a>
            </li>            
            <li>
                <a <?php if($menu == 'pengajuanBiaya'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/PengajuanBiaya'); ?>">Pengajuan Biaya</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart-o"></i> Laporan<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" id="laporan">
            <li>
                <a <?php if($menu == 'KartuPSL'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('sdm/KartuPSL'); ?>">Kartu PSL (Pegawai Studi Lanjut)</a>
            </li>
            <li>
                <a <?php if($menu == 'pengeluaran'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Pengeluaran'); ?>">Pengeluaran</a>
            </li>
            <li>
                <a <?php if($menu == 'amortisasi'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/Amortisasi'); ?>">Amortisasi</a>
            </li>
            <li>
                <a <?php if($menu == 'posisiPendanaanBeasiswa'){ ?> class="active-menu" <?php } ?> href="<?php echo base_url('keuangan/PosisiPendanaanBeasiswa'); ?>">Posisi Pendanaan Beasiswa</a>
            </li>
        </ul>
    </li>
</ul>