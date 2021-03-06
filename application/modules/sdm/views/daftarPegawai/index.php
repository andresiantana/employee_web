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
                                <th rowspan="2">No. Telp/HP</th>
                                <th rowspan="2">Foto</th>
                                <th rowspan="2">Fakultas</th>
                                <th rowspan="2">Prodi</th>
                                <th rowspan="2">Nama Bank</th>
                                <th rowspan="2">Nomor Rekening</th>
                                <th rowspan="2">Atas Nama</th>
                                <th rowspan="2">Surat Studi Lanjut</th>
                                <th rowspan="2">Surat Lulus Seleksi</th>
                                <th rowspan="2">Surat Terima Beasiswa</th>
                                <th rowspan="2">Sertifikasi</th>
                                <th rowspan="2">Biaya SPP</th>
                                <th colspan="3" class="td-actions">Aksi</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th>Approve</th>
                                <th>Kirim Pemberitahuan</th>
                                <th>Update Status Lulus</th>
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
                                    <td><?php echo ($v->nama_prodi != '') ? $v->nama_prodi : "-"; ?></td>
                                    <td><?php echo $v->nama_bank; ?></td>
                                    <td><?php echo $v->nomor_rekening; ?></td>
                                    <td><?php echo $v->atasnama_rekening; ?></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_studi_lanjut; ?>')"><?php echo $v->surat_studi_lanjut; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_lulus_seleksi; ?>')"><?php echo $v->surat_lulus_seleksi; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_terima_beasiswa; ?>')"><?php echo $v->surat_terima_beasiswa; ?></a></td>
                                    <td>
                                        <a href="#detail_sertifikasi" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk melihat Detail Sertifikasi Pegawai" onclick="setDetailSertifikasi(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-list"> </i></a>
                                    </td>
                                    <td style="text-align:right;"><?php echo number_format($v->biaya_spp,0,'',','); ?></td>
                                    <td class="td-actions">
                                        <?php 
                                            if($v->status_approve_sdm != "Approved" || $v->status_approve_sdm == ''){
                                        ?>
                                            <font style="color:red;"><?php echo $v->status_approve_sdm; ?></font> <a href="#approved" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve" onclick="setIdPegawai(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-check"> </i></a>
                                        <?php }else{ ?>
                                        <font style="color:green;"><?php echo $v->status_approve_sdm; ?></font>
                                        <?php } ?>
                                        
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('sdm/daftarPegawai/notifikasi/'.$v->id_pegawai); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk kirim notifikasi"><i class="fa fa-bell"> </i></a>
                                    </td>
                                    <td>
                                      <?php if($v->status_kelulusan == '' ){ ?>
                                          <a href="#update_lulus" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Update Lulus" onclick="setIdPegawai(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-pencil"> </i></a>
                                      <?php }else{ ?>
                                      <?php echo $v->status_kelulusan; ?>
                                      <?php } ?>
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
<div class="remodal" data-remodal-id="approved" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Approved Pegawai</h2>
    <p id="modal1Desc"></p>
  </div>
  <button data-remodal-action="confirm" class="remodal-confirm" onclick="approveData();">Approved</button>
  <button data-remodal-action="confirm" class="remodal-cancel" onclick="rejectData();">Reject</button>
  <button data-remodal-action="cancel" class="remodal-cancel">Batal</button>  
</div>

<!-- Dialog untuk Update Staus Lulus -->
<div class="remodal" data-remodal-id="update_lulus" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Ubah Status Kelulusan</h2>
    <p id="modal1Desc">
        <div class="form-group">
            <label>Status Kelulusan</label>
            <select class="form-control" name="status_lulus" id="status_lulus" onchange="setIjazah(this);">
                <option value="">-Pilih Status-</option>
                <option value="Lulus">Lulus</option>
                <option value="Belum Lulus">Belum Lulus</option>
                <option value="Drop Out">Drop Out (DO)</option>
            </select>
        </div>   
        <div id="ijazah">
          <div class="form-group">
            <label>Tanggal Ijazah</label>
              <input type="text" class="form-control datepickerNew" id="tanggal_ijazah" name="tanggal_ijazah" required>
          </div>
          <div class="form-group">
            <label>No. Ijazah</label>
              <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" required>
          </div>
          <div class="form-group ">
              <label>Upload Ijazah</label>
              <div class="controls">
                  <input class="form-control" type="file" name="upload_ijazah" id="upload_ijazah">
              </div>                    
          </div>
        </div>
        <div class="form-group">
          <label>Tanggal Selesai Studi</label>
          <!-- <div class="myOwnClass"> -->
            <input type="text" class="form-control datepickerNew" id="tanggal_selesai_studi" name="tanggal_selesai_studi">
          <!-- </div> -->
        </div>
    </p>
  </div>
  <button data-remodal-action="confirm" class="remodal-confirm" onclick="updateStatusLulus();">Ubah</button>
  <button data-remodal-action="cancel" class="remodal-cancel">Batal</button>  
</div>

<!-- Dialog untuk detail sertifikasi -->
<input type="hidden" id="id_pegawai">   
<div class="remodal" data-remodal-id="detail_sertifikasi" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Detail Sertifikasi Pegawai</h2>
    <p id="modal1Desc">
        <div id="data-detail">

        </div>
    </p>
  </div>
</div>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
$('#ijazah').hide();
function setIjazah(obj){
  var status = obj.value;
  if(status == "Lulus"){
    $('#ijazah').show();
    $('#tanggal_ijazah').attr('required');
    $('#no_ijazah').attr('required');
  }else{
    $('#ijazah').hide();
    $('#tanggal_ijazah').removeAttr('required');
    $('#no_ijazah').removeAttr('required');
  }
}
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

function rejectData(id_pegawai){
    var id_pegawai = $('#pegawai_id').val();
    var data = {
      id_pegawai    : id_pegawai
    }
    $('#sample').attr('style','display:none');
    $.ajax({
      url     : "<?php echo base_url('sdm/daftarPegawai/rejectData'); ?>",
      type    : "GET",
      data    : data,
      dataType: 'json',
      success : function (data) {
          if(data.status == true){
            alert('Data Pegawai berhasil di reject');
            window.location.reload();
          }else{
            alert('Data Pegawai gagal di reject');
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

function updateStatusLulus(id_pegawai){
    var id_pegawai = $('#pegawai_id').val();
    var status_lulus = $('#status_lulus').val();
    var tanggal_selesai_studi = $('#tanggal_selesai_studi').val();
    var tanggal_ijazah = $('#tanggal_ijazah').val();
    var no_ijazah = $('#no_ijazah').val();
    var upload_ijazah = $('#upload_ijazah').val();
    var data = {
      id_pegawai    : id_pegawai,
      status_kelulusan : status_lulus,
      tanggal_selesai_studi:tanggal_selesai_studi,
      tanggal_ijazah:tanggal_ijazah,
      no_ijazah:no_ijazah,
      upload_ijazah:upload_ijazah
    }

    if(status_lulus == "Lulus"){
        if(tanggal_ijazah == ''){
        alert("Tanggal Ijazah wajib diisi");
        return false;
      }
      if(no_ijazah == ''){
        alert("No. Ijazah wajib diisi");
        return false;
      }
    }
    if(status_lulus == ''){
      alert("Status Lulus wajib diisi");
      return false;
    }
    if(tanggal_selesai_studi == ''){
      alert("Tanggal Selesai Studi wajib diisi");
      return false;
    }
    $.ajax({
      url     : "<?php echo base_url('sdm/daftarPegawai/updateStatusLulus'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          if(data.status == true){
            alert('Data Status Pegawai berhasil di ubah');
            window.location.reload();
          }else{
            alert('Data Status Pegawai gagal di ubah');
              window.location.reload();
          }
      }
    });
}

function setDetailSertifikasi(id_pegawai){
    $('#id_pegawai').val(id_pegawai);
    var data = {
      id_pegawai:id_pegawai,
    }

  $.ajax({
      url     : "<?php echo base_url('pegawai/DataPegawai/detailSertifikasi'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#data-detail').html(data);
      }
    });

}

$(document).ready(function() {
  $( ".datepicker" ).datepicker();
  $('#informasi_header').addClass('active');
  $('#informasi').addClass('in');
  $('#informasi').attr('aria-expanded',true);
  $('#informasi').attr('style','');

});
</script>