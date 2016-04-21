<?php
	if(count($isi_notifikasi2) > 0){
		foreach($isi_notifikasi2 as $i=>$data){
?>
<li>
	<a style="color:green;">Notifikasi Pengajuan Pegawai</a>
</li>
 <li>
    <a href="#">
        <div>
            <i class="fa fa-comment fa-fw"></i> <?php echo $data->nama_lengkap; ?>
            <span class="pull-right text-muted small"></span>
        </div>
    </a>
</li>
<li class="divider"></li>

<?php } 
}
?>

<?php
	if(count($isi_notifikasi) > 0){
		foreach($isi_notifikasi as $i=>$data){
?>
<li>
	<a style="color:red;">Notifikasi Update Data Pegawai</a>
</li>
 <li>
    <a href="#">
        <div>
            <i class="fa fa-comment fa-fw"></i> Nama Pegawai : <?php echo $data->nama_lengkap; ?>
            <span class="pull-right text-muted small"><?php echo date('d M Y H:i:s',strtotime($data->tanggal)); ?></span>
        </div>
    </a>
</li>
<li class="divider"></li>

<?php } 
}
?>

