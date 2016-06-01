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
                            <td style="width:30%"> <input type="text" class="form-control" id="nip" name="nip"></td>

                            <td style="width:9%"></td>

                            <td><label>Tanggal Awal</label></td>
                            <td style="width:1%;"></td>
                            <td>
                              <div class="myOwnClass">
                                  <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Kode Pengajuan</label></td>
                            <td style="width:1%;"></td>
                            <td> <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan"></td>

                            <td style="width:9%"></td>

                            <td><label>Tangal Akhir</label></td>
                            <td style="width:1%;"></td>
                            <td>
                              <div class="myOwnClass">
                                <input type="text" onblur="setPencarian();" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Status</label></td>
                            <td style="width:1%;"></td>
                            <td>
                                <select class="form-control" name="status" id="status" style="width:140px;">
                                    <option value="">-Pilih Status-</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Reject">Reject</option>
                                </select>
                            </td>

                            <td style="width:9%"></td>

                            <td></td>
                            <td style="width:1%;"></td>
                            <td></td>
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
                                    <td><?php echo $v->semester; ?></td>
                                    <td>
                                        <?php if(!empty($v->id_pencairan_biaya)) { ?>
                                        Dana Cair
                                        <?php }else{ ?>
                                        Belum Ada Verifikasi
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions">
                                        <?php 
                                            if($v->status_pengajuan == ''){
                                        ?>
                                            <a href="<?php echo base_url('sdm/PengajuanBiaya/edit/'.$v->id_pengajuan_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>
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
                </div><br><br>
                <!-- <a href='javascript:void(0);' onclick="print();" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a> -->
            </div>            
        </div>
    </div>
</div>

<!-- Dialog untuk Approve -->
<input type="hidden" id="id_pengajuan_biaya">
<div class="remodal" data-remodal-id="update_lulus" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Ubah Status Kelulusan</h2>
    <p id="modal1Desc">
       
    </p>
  </div>
  <button data-remodal-action="confirm" class="remodal-confirm" onclick="approveData();">Approved</button>
  <button data-remodal-action="cancel" class="remodal-cancel">Batal</button>  
</div>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">


function approveData(){
    var id_pengajuan_biaya = $('#id_pengajuan_biaya').val();
    var status_pengajuan = $('#status_pengajuan').val();
    var alasan_pengajuan = $('#alasan_pengajuan').val();
    var jumlah_nominal = $('#jumlah_nominal').val();
    var data = {
      id_pengajuan_biaya: id_pengajuan_biaya,
      status_pengajuan:status_pengajuan,
      alasan_pengajuan:alasan_pengajuan,
      jumlah_nominal:jumlah_nominal
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

function setIdPengajuanBiaya(id_pengajuan_biaya,jumlah_nominal){
    $('#id_pengajuan_biaya').val(id_pengajuan_biaya)
    $('#jumlah_nominal').val(jumlah_nominal)
}

function batalApprove(){
    $('#sample').attr('style','display:none');   
}

function setPencarian(){
    var nip = $('#nip').val();
    var id_kategori_biaya = $('#id_kategori_biaya').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();
    var kode_pengajuan = $('#kode_pengajuan').val();
    var status_pengajuan = $('#status').val();

    var data = {
      nip: nip,
      id_kategori_biaya: id_kategori_biaya,
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir,
      kode_pengajuan:kode_pengajuan,
      status_pengajuan:status_pengajuan
    }

  $.ajax({
      url     : "<?php echo base_url('sdm/PengajuanBiaya/index'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#dataTables-example > tbody').html(data);
      }
    });
}
</script>