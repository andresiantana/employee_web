<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Pengajuan Biaya
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <legend>Pencarian :</legend>
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">                            
                            <div class="col-sm-6">
                                 <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Nama Pegawai                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="nama_pegawai" name="nama_pegawai">
                                    </label>
                                </div>
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Kategori Biaya                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="nama" name="nama">
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Tanggal Awal                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="tanggal_awal" name="tanggal_awal">
                                    </label>
                                </div>
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Tanggal Akhir                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                                    </label>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Kode Pengajuan</th>
                                <th>Nama Pegawai Pengaju</th>
                                <th>Kategori Biaya Pengajuan</th>
                                <th>Semester</th>
                                <th>Jumlah Pengajuan</th>
                                <th>Status Pencairan</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
                                    <td><?php echo $v->kode_pengajuan; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td><?php echo $v->nama_kategori; ?></td>
                                    <td><?php echo $v->semester; ?></td>
                                    <td><?php echo $v->jumlah_nominal; ?></td>                                    
                                    <td>
                                        <?php if(!empty($v->id_pencairan_dana)) { ?>
                                        Dana Cair
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions">
                                        <?php 
                                            if($v->status_pengajuan == ''){
                                        ?>
                                            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve/Reject Pengajuan" onclick="popup_window_show('#sample', { pos : 'window-center',width : '800px' });setIdPengajuanBiaya(<?php echo $v->id_pengajuan_biaya; ?>);"><i class="fa fa-check"> </i></a>
                                        <?php }else{ 
                                            if($v->status_pengajuan == 'Approved'){
                                                $warna = 'color:green;';
                                            }else{
                                                $warna = 'color:red;';
                                            }
                                        ?>
                                        <font style="<?php echo $warna; ?>"><?php echo $v->status_pengajuan; ?></font>
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
    var nama_pegawai = $('#nama_pegawai').val();
    var id_kategori_biaya = $('#id_kategori_biaya').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();

    var data = {
      nama_pegawai: nama_pegawai,
      id_kategori_biaya: id_kategori_biaya,
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir
    }

  $.ajax({
      url     : "<?php echo base_url('pengajuan/PengajuanBiaya/informasi'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#dataTables-example > tbody').html(data);
      }
    });
}
</script>