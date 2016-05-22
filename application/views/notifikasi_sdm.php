<?php 
    if(isset($isi_notifikasi3)) {
        if(count($isi_notifikasi3) > 0){
?>
            <li>
                <a style="color:green;">Notifikasi Pengajuan Biaya Pegawai</a>
            </li>
<?php 
        } 
?>
<?php
    if(count($isi_notifikasi3) > 0){
        foreach($isi_notifikasi3 as $j=>$data3){
?>
            <li>
                <a href="javascript:void(0);" onclick="setNotifikasi(<?php echo $data3->id_notifikasi; ?>)">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> 
                        Nama Pegawai : <?php echo $data3->nama_lengkap; ?><br>
                        Pesan : <?php echo isset($data3->pesan) ? $data3->pesan : "-"; ?>
                        <span class="pull-right text-muted small"></span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
<?php 
        }
    } 
}
?>

<?php 
    if(count($isi_notifikasi2) > 0){
?>
        <li>
            <a style="color:green;">Notifikasi Pengajuan Pegawai</a>
        </li>
<?php 
    }
?>
<?php
	if(count($isi_notifikasi2) > 0){
		foreach($isi_notifikasi2 as $i=>$data2){
?>
            <li>
                <a href="javascript:void(0);">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> 
                        Nama Pegawai : <?php echo $data2->nama_lengkap; ?><br>
                        Pesan : Pengajuan Data Pegawai
                        <span class="pull-right text-muted small"></span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>

<?php 
        } 
    }
?>

<?php 
    if(count($isi_notifikasi) > 0){
?>
        <li>
            <a style="color:red;">Notifikasi Update Data Pegawai</a>
        </li>
<?php 
    }
?>
<?php
	if(count($isi_notifikasi) > 0){
	   foreach($isi_notifikasi as $k=>$data){
?>
            <li>
                <a href="javascript:void(0);" onclick="setNotifikasi(<?php echo $data->id_notifikasi; ?>)">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> 
                        Nama Pegawai : <?php echo $data->nama_lengkap; ?><br>
                        Pesan : <?php echo $data->pesan; ?>
                        <span class="pull-right text-muted small"><?php echo date('d M Y H:i:s',strtotime($data->tanggal)); ?></span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>

<?php 
        } 
    }
?>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
    function setNotifikasi(id_notifikasi){
        $('#id_notifikasi').val(id_notifikasi);
        var data = {
          id_notifikasi    : id_notifikasi
        }
        $.ajax({
          url     : "<?php echo base_url('sdm/daftarPegawai/loadNotifikasi'); ?>",
          type    : "POST",
          data    : data,
          dataType: 'json',
          success : function (data) {          
            if(data.status == true){
                window.location.reload();
            }
            $('#isi_pesan').html(data.isi_pesan);
          }
        });
    }
</script>