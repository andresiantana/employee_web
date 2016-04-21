<style type="text/css">
dl   { margin:  0px 0px  0px  0px; }
dt   { margin:  0px 0px  0px  0px; }
dd   { margin:  0px 0px  0px 25px; }
form { margin:  0px 0px  0px  0px; }
h1   { margin:  0px 0px 20px  0px; }
h2   { margin: 20px 0px 10px  0px; }
p    { margin:  0px 0px  5px  0px; }

body  { font: 100  13px   Arial, Sans-Serif; }
b     { font: 900 1.0em   Arial, Sans-Serif; }
h1    { font: 900 1.4em   Arial, Sans-Serif; }
h2    { font: 900 1.4em   Arial, Sans-Serif; }
small { font: 100 0.8em Verdana, Sans-Serif; }
</style>
<?php
	if(count($isi_notifikasi) > 0){
		foreach($isi_notifikasi as $i=>$data){
?>
<li>
	<a style="color:red;">Notifikasi dari SDM</a>
</li>
 <li>
    <a href="javascript:void(0);" onclick="popup_window_show('#sample', { pos : 'window-center',width : '800px' });setNotifikasi(<?php echo $data->id_notifikasi; ?>);">
        <div>
            <i class="fa fa-comment fa-fw"></i> Nama SDM : <?php echo $data->nama_lengkap; ?>
            <span class="pull-right text-muted small"><?php echo date('d M Y H:i:s',strtotime($data->tanggal)); ?></span>
        </div>
    </a>
</li>
<li class="divider"></li>

<?php } 
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
          $('#isi_pesan').html(data.isi_pesan);
      }
    });
}
</script>

