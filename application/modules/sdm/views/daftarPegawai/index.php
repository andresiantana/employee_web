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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Daftar Pegawai
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr style="text-align:center;">
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama Lengkap</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">NIDN</th>
                                <th rowspan="2">Tanggal Lahir</th>
                                <th rowspan="2">E-mail</th>
                                <th rowspan="2">No. Telp</th>
                                <th rowspan="2">Foto</th>
                                <th rowspan="2">Fakultas</th>
                                <th rowspan="2">Prodi</th>
                                <th rowspan="2">Nama Bank</th>
                                <th rowspan="2">Nomor Rekening</th>
                                <th rowspan="2">Atas Nama</th>
                                <th rowspan="2">Surat Studi Lanjut</th>
                                <th rowspan="2">Surat Lulus Seleksi</th>
                                <th rowspan="2">Surat Terima Beasiswa</th>
                                <th rowspan="2">Biaya SPP</th>
                                <th colspan="2" class="td-actions">Aksi</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th>Approve</th>
                                <th>Kirim Pemberitahuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td><?php echo $v->nip; ?></td>
                                    <td><?php echo $v->nidn; ?></td>
                                    <td><?php echo date('d M Y',strtotime($v->tanggal_lahir)); ?></td>
                                    <td><?php echo $v->email; ?></td>
                                    <td><?php echo $v->no_telp_hp; ?></td>
                                    <td><img src="<?php echo base_url().'data/images/pegawai/'.$v->foto; ?>" width="50px" height="50px"></td>
                                    <td><?php echo $v->nama_fakultas; ?></td>
                                    <td><?php echo $v->nama_prodi; ?></td>
                                    <td><?php echo $v->nama_bank; ?></td>
                                    <td><?php echo $v->nomor_rekening; ?></td>
                                    <td><?php echo $v->atasnama_rekening; ?></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_studi_lanjut; ?>')"><?php echo $v->surat_studi_lanjut; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_lulus_seleksi; ?>')"><?php echo $v->surat_lulus_seleksi; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_terima_beasiswa; ?>')"><?php echo $v->surat_terima_beasiswa; ?></a></td>
                                    <td style="text-align:right;"><?php echo $v->biaya_spp; ?></td>
                                    <td class="td-actions">
                                        <?php 
                                            if($v->status_approve_sdm != "Approved" || $v->status_approve_sdm == ''){
                                        ?>
                                            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve" onclick="popup_window_show('#sample', { pos : 'window-center',width : '800px' });setIdPegawai(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-check"> </i></a>
                                        <?php }else{ ?>
                                        <font style="color:green;"><?php echo $v->status_approve_sdm; ?></font>
                                        <?php } ?>
                                        
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('sdm/daftarPegawai/notifikasi/'.$v->id_pegawai); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk kirim notifikasi"><i class="fa fa-bell"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Dialog untuk Approve -->
<input type="hidden" id="pegawai_id">
<div   class="popup_window_css" id="sample">
<table class="popup_window_css">
<tr    class="popup_window_css">
<td    class="popup_window_css">
<div   class="popup_window_css_head">
<img src="<?php echo base_url('assets/template/Bluebox/assets/popup/images/close.gif');?>" alt="" width="9" height="9" />Approve Data Pegawai</div>
<div   class="popup_window_css_body">
    <div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;">
        <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve" onclick="approveData();"><i class="fa fa-check"></i> Approved</a>
        <a href="javascript:void(0)" class="btn btn-small btn-danger" rel="tooltip" title="Klik batal Approve" onclick="batalApprove();"><i class="fa fa-ban"></i> Batal</a>
    </div>
</div>


<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">
function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('sdm/daftarPegawai/file_download') ?>?file_name="+ file_name;
}
function approveData(id_pegawai){
    var id_pegawai = $('#pegawai_id').val();
    var data = {
      id_pegawai    : id_pegawai
    }
    $('#sample').attr('style','display:none');
    $.ajax({
      url     : "<?php echo base_url('sdm/daftarPegawai/approveData'); ?>",
      type    : "GET",
      data    : data,
      dataType: 'json',
      success : function (data) {
          if(data.status == true){
            alert('Data Pegawai berhasil di approve');
            window.location.reload();
          }else{
            alert('Data Pegawai gagal di approve');
              window.location.reload();
          }
      }
    });
}

function kirimNotifikasi(id_pegawai){
    var id_pegawai = $('#pegawai_id').val();
    var tanggal = $('#tanggal').val();
    var pesan = $('#pesan').val();

    var data = {
      id_pegawai    : id_pegawai,
      tanggal       : tanggal,
      pesan         : pesan
    }
    $('#sample').attr('style','display:none');
    $.ajax({
      url     : "<?php echo base_url('sdm/daftarPegawai/kirimNOtifikasi'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          if(data.status == true){
            alert('Notifikasi berhasil dikirim');
            window.location.reload();
          }else{
            alert('Notifikasi gagal dikirim');
              window.location.reload();
          }
      }
    });
}

function setIdPegawai(id_pegawai){
    $('#pegawai_id').val(id_pegawai)
}

function batalApprove(){
    $('#sample').attr('style','display:none');   
}

function batalNotifikas(){
    $('#notifikasi').attr('style','display:none');    
}
$(document).ready(function(){
    $('#tanggal').datepicker({
        format:'dd/mm/yyyy',
    });
});
</script>