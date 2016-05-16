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
                                        Semester                                            
                                        <select class="form-control" name="semester" id="semester">
                                            <option value="">-Pilih Semester-</option>
                                            <?php for ($i = 0; $i < 8; $i++) { ?>
                                                <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Kategori Biaya                                            
                                        <select class="form-control" name="id_kategori_biaya" id="id_kategori_biaya">
                                            <option value="">-Pilih Kategori Biaya-</option>
                                            <?php foreach ($kategori as $i => $val) { ?>
                                                <option value="<?php echo $val->id_kategori_biaya; ?>"><?php echo $val->nama_kategori; ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Tanggal Awal                                            
                                        <input class="form-control" id="tanggal_awal" name="tanggal_awal" type="text" class="span3" required>
                                    </label>
                                </div>
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Tanggal Akhir                                            
                                        <input class="form-control" id="tanggal_akhir" name="tanggal_akhir" type="text" class="span3" required>
                                    </label>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('pegawai/PengajuanBiaya/informasi'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>
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
                                <th>Status Pengajuan</th>
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
                                        <?php if(isset($v->status_pengajuan)) { 
                                            if($v->status_pengajuan == 'Approved'){
                                                $data = 'Approved';
                                                $warna = 'green';
                                                $huruf = '<a href="#"><font style="color:'.$warna.';">'.$data.'</font></a>';
                                                $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                                            }else if($v->status_pengajuan == 'Reject'){
                                                $data = 'Reject';
                                                $warna = 'red';
                                                $huruf = '<a href="#" rel="tooltip" title="Lihat Alasan" onclick="setDialog(\''.$v->alasan_status.'\');"><font style="color:'.$warna.';">'.$data.'</font></a>';
                                                $button = '-';
                                            }else{
                                                $data = '';
                                                $warna = '';
                                                $huruf = '';
                                                $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                                            }
                                        ?>
                                            <?php echo isset($huruf) ? $huruf : ""; ?>
                                        <?php }else{ 
                                                $data = '';
                                                $warna = '';
                                                $huruf = '';
                                                $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($v->id_pencairan_biaya)) {
                                            $button = "-";
                                        ?>
                                        Sudah Dicairkan
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions">
                                        <?php echo isset($button) ? $button : ""; ?>
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
<img src="<?php echo base_url('assets/template/Bluebox/assets/popup/images/close.gif');?>" alt="" width="9" height="9" />Alasan Reject</div>
<div   class="popup_window_css_body">
    <div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;">
        <div class="form-group">
            <label>Alasan Reject : </label>
            <span id="status"></span>
        </div>

        <a href="<?php echo base_url('pegawai/PengajuanBiaya/index'); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i>Buat Pengajuan Baru</a>
    </div>
</div>


<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">
function setDialog(status) {
    $('#status').html(status);
    popup_window_show("#sample", { pos : "window-center",width : "800px" });
}
function setPencarian(){
    var semester = $('#semester').val();
    var id_kategori_biaya = $('#id_kategori_biaya').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();

    var data = {
      semester: semester,
      id_kategori_biaya: id_kategori_biaya,
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir
    }

  $.ajax({
      url     : "<?php echo base_url('pegawai/PengajuanBiaya/informasi'); ?>",
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