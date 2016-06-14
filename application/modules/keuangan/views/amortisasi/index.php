<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Amortisasi
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

                            <td><label>Nama</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text" class="form-control" id="nama" name="nama"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('keuangan/Amortisasi/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-amortisasi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>Jumlah Amortisasi</th>
                                <th class="td-actions">Detail</th>
                                <th class="td-actions">Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($data) > 0) { ?>
                                <?php foreach($data as $key => $v): ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $v->nama_lengkap; ?></td>
                                        <td><?php echo $v->nip; ?></td>
                                        <td><?php echo 'Rp '.number_format($v->biaya).',00'; ?></td>
                                        <td class="td-actions">
                                            <a href="#detail" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Amortisasi" onclick="setIdPencairan(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-list"> </i></a>
                                        </td>
                                        <td class="td-actions">
                                            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Cetak Rincian Amortisasi" onclick="print('PRINT',<?php echo $v->id_pegawai; ?>);"><i class="fa fa-print"> </i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } else { echo "<tr><td colspan='5'><i>Tidak ada data</i></td></tr>"; } ?>
                        </tbody>
                    </table>
                    <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dialog untuk detail -->
<input type="hidden" id="id_pegawai">   
<div class="remodal" data-remodal-id="detail" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Detail Amortisasi</h2>
    <p id="modal1Desc">
        <div id="data-detail">

        </div>
    </p>
  </div>
</div>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
function setIdPencairan(id_pegawai){
    $('#id_pegawai').val(id_pegawai);
    var data = {
      id_pegawai:id_pegawai,
    }

  $.ajax({
      url     : "<?php echo base_url('keuangan/Amortisasi/detail'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#data-detail').html(data);
      }
    });

}
function setPencarian(){
    var nip = $('#nip').val();
    var nama = $('#nama').val();

    var data = {
      nip     : nip,
      nama    : nama,
    }

  $.ajax({
      url     : "<?php echo base_url('keuangan/Amortisasi'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#data-amortisasi > tbody').html(data);
      }
    });
}
function print(caraPrint,id_pegawai)
{
    var id_pegawai = id_pegawai;
    window.open('<?php echo base_url('keuangan/Amortisasi/printAmortisasi/'); ?>/'+id_pegawai,'printwin','left=100,top=100,width=1000,height=640');
}
</script>