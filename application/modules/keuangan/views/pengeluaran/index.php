<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Pengeluaran
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <legend>Pencarian :</legend>
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>NIP</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%"> <input type="text" class="form-control" id="nip" name="nip"></td>

                            <td style="width:9%"></td>

                            <td><label>Tanggal Awal</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text" onblur="setPencarian();" class="form-control" id="tanggal_awal" name="tanggal_awal"></td>
                        </tr>
                        <tr>
                            <td><label>Kode Pengajuan</label></td>
                            <td style="width:1%;"></td>
                            <td> <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan"></td>

                            <td style="width:9%"></td>

                            <td><label>Tangal Akhir</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text" onblur="setPencarian();" class="form-control" id="tanggal_akhir" name="tanggal_akhir"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('sdm/PengajuanBiaya/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Kode Pengeluaran</th>
                                <td>NIP</td>
                                <th>Nama Pegawai</th>
                                <th>Semester</th>
                                <th>Biaya</th>
                            </tr>
                            <tr>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
                                    <td><?php echo $v->kode_pencairan; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td style="text-align:center;"><?php echo $v->semester; ?></td>
                                    <td style="text-align:right;"><?php echo $v->berhasil_transfer; ?></td>                                    
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('keuangan/Pengeluaran/pencairanBiaya?id_pengajuan_biaya='.$v->id_pengajuan_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Pengeluaran"><i class="fa fa-list"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><br><br>
                <a href='javascript:void(0);' onclick="print();" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a>
            </div>            
        </div>
    </div>
</div>

<!-- Dialog untuk Approve -->
<input type="hidden" id="id_pengajuan_biaya">
<div   class="popup_window_css" id="sample">
<table class="popup_window_css">
<tr    class="popup_window_css">
<td    class="popup_window_css">
<div   class="popup_window_css_head">
<img src="<?php echo base_url('assets/template/Bluebox/assets/popup/images/close.gif');?>" alt="" width="9" height="9" />Approve Pengajuan Biaya Pegawai</div>
<div   class="popup_window_css_body">
    <div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;">
        <div class="form-group">
            <label>Status Pengajuan</label>
            <select class="form-control" name="status_pengajuan" id="status_pengajuan" onChange='setStatus(this);'>
                <option value="">-Pilih Status-</option>
                <option value="Approved">Approved</option>
                <option value="Reject">Reject</option>
            </select>
        </div>
        <div class="form-group" id="reject" style="display:none;">
            <label>Alasan Pengajuan</label>
            <textarea class="form-control" name="alasan_pengajuan" id="alasan_pengajuan"></textarea>
        </div>
        <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve" onclick="approveData();"><i class="fa fa-check"></i> Approved</a>
        <a href="javascript:void(0)" class="btn btn-small btn-danger" rel="tooltip" title="Klik batal Approve" onclick="batalApprove();"><i class="fa fa-ban"></i> Batal</a>
    </div>
</div>


<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">
function setStatus(obj) {
    var status_pengajuan = $('#status_pengajuan').val();
    alert(status_pengajuan);
    if(status_pengajuan == 'Reject') {
        $('#reject').removeAttr('style','display:none;');
    }else{
        $('#reject').attr('style','display:none;');
    }
}

function approveData(){
    var id_pengajuan_biaya = $('#id_pengajuan_biaya').val();
    var status_pengajuan = $('#status_pengajuan').val();
    var alasan_pengajuan = $('#alasan_pengajuan').val();
    var data = {
      id_pengajuan_biaya: id_pengajuan_biaya,
      status_pengajuan:status_pengajuan,
      alasan_pengajuan:alasan_pengajuan
    }
    $('#sample').attr('style','display:none');
    $.ajax({
      url     : "<?php echo base_url('sdm/pengajuanBiaya/approveData'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          if(data.status == true){
            alert(data.pesan);
            window.location.reload();
          }else{
            alert(data.pesan);
            window.location.reload();
          }
      }
    });
}

function setIdPengajuanBiaya(id_pengajuan_biaya){
    $('#id_pengajuan_biaya').val(id_pengajuan_biaya)
}

function batalApprove(){
    $('#sample').attr('style','display:none');   
}

function setPencarian(){
    var nip = $('#nip').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();
    var kode_pengajuan = $('#kode_pengajuan').val();

    var data = {
      nip: nip,
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir,
      kode_pengajuan:kode_pengajuan,
    }

  $.ajax({
      url     : "<?php echo base_url('keuangan/PengajuanBiaya/index'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#dataTables-example > tbody').html(data);
      }
    });
}

$(document).ready(function(){
    $('#tanggal_awal').datepicker({
        format:'dd/mm/yyyy',
    });
    $('#tanggal_akhir').datepicker({
        format:'dd/mm/yyyy',
    });
});
</script>