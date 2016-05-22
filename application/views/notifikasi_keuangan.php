<?php 
    if(count($isi_notifikasi) > 0){
?>
        <li>
            <a style="color:red;">Notifikasi Pengajuan Dana Baru</a>
        </li>
<?php 
    }
?>

<?php
	if(count($isi_notifikasi) > 0){
        foreach($isi_notifikasi as $i=>$data){
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