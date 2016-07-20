<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Pengajuan Biaya
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <legend>Pencarian :</legend>
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>NIP</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%"> <input type="text" class="form-control nip" id="nip" name="nip" maxlength="10"></td>

                            <td style="width:9%"></td>

                            <td><label>Tanggal Awal</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text" onblur="setPencarian();" class="form-control datepickerNew" id="tanggal_awal" name="tanggal_awal"></td>
                        </tr>
                        <tr>
                            <td><label>Kode Pengajuan</label></td>
                            <td style="width:1%;"></td>
                            <td> <input type="text" class="form-control kode" id="kode_pengajuan" name="kode_pengajuan"></td>

                            <td style="width:9%"></td>

                            <td><label>Tangal Akhir</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text" onblur="setPencarian();" class="form-control datepickerNew" id="tanggal_akhir" name="tanggal_akhir"></td>
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
                                <th>Tanggal Pengajuan</th>
                                <th>Kode Pengajuan</th>
                                <th>Nama Pegawai Pengaju</th>
                                <th>Semester</th>
                                <th>Jumlah Pengajuan</th>
                                <th>Detail Pengajuan</th>
                                <th class="td-actions">Cairkan Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
                                    <td><?php echo $v->kode_pengajuan; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td><?php echo $v->semester; ?></td>
                                    <td style='text-align:right;'><?php echo number_format($v->jumlah_nominal,0,'',','); ?></td>  
                                    <td>
                                        <?php 
                                            $button = '<a href="#detail_pengajuan" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk melihat Detail Pengajuan" onclick="setDetailPengajuan('.$v->id_pengajuan_biaya.');"><i class="fa fa-list"> </i></a>';
                                        ?>
                                        <?php echo isset($button) ? $button : ""; ?>
                                    </td>                                    
                                    <td class="td-actions">
                                        <?php 
                                            if(empty($v->id_pencairan_biaya)){
                                        ?>
                                            <a href="<?php echo base_url('keuangan/PengajuanBiaya/pencairanBiaya?id_pengajuan_biaya='.$v->id_pengajuan_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melakukan Pencairan Biaya"><i class="fa fa-check"> </i></a>
                                        <?php }else{ ?>
                                        <font>Sudah Dicairkan</font>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="7">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><br><br>
                <!--<a href='javascript:void(0);' onclick="print();" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a>-->
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


<!-- Dialog untuk detail pengajuan -->
<input type="hidden" id="id_pegawai">   
<div class="remodal" data-remodal-id="detail_pengajuan" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Detail Pengajuan Biaya</h2>
    <p id="modal1Desc">
        <div id="data-detail">

        </div>
    </p>
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

function setDetailPengajuan(id_pengajuan_biaya){
    $('#id_pengajuan_biaya').val(id_pengajuan_biaya);
    var data = {
      id_pengajuan_biaya:id_pengajuan_biaya,
    }

  $.ajax({
      url     : "<?php echo base_url('pegawai/PengajuanBiaya/detail'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#data-detail').html(data);
      }
    });

}

$(document).ready(function(){
   $('#tanggal_awal').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,changeYear: true,
        yearRange: "-80:+10"
    });
    $('#tanggal_akhir').datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,changeYear: true,
        yearRange: "-80:+10"
    });

    $('.nip').keyup(function() {
    var d = $(this).attr('numeric');
    var value = $(this).val();
    var orignalValue = value;
    value = value.replace(/[0-9]-*/g, "");
    var msg = "Only Integer Values allowed.";

    if (d == 'decimal') {
        value = value.replace(/\./, "");
        msg = "Only Numeric Values allowed.";
    }

    if (value != '') {
      orignalValue = orignalValue.replace(/([^0-9].*)/g, "")
      $(this).val(orignalValue);
    }
    });

    $('.kode').keyup(function() {
        var kode = document.getElementById('kode_pengajuan');
        var filter = /^([a-zA-Z0-9 _\`\,\.\-\'])+$/;

        if (!filter.test(kode.value)) {
            alert('Kode Pengajuan hanya boleh diisi dengan huruf dan angka!');
            $('#kode_pengajuan').val('');
            kode.focus;
        return false;
        }
    });
});
</script>