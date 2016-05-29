<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Amortisasi
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>Jumlah Amortisasi</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($data) > 0) { ?>
                                <?php foreach($data as $key => $v): ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $v->nama_lengkap; ?></td>
                                        <td><?php echo $v->nip; ?></td>
                                        <td class="td-actions">
                                            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Cetak Rincian Amortisasi" onclick="print('PRINT',<?php echo $v->id_pegawai; ?>);"><i class="fa fa-print"> </i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } else { echo "<tr><td colspan='5'><i>Tidak ada data</i></td></tr>"; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('sdm/daftarPegawai/file_download') ?>?file_name="+ file_name;
}

function setPencarian(){
    var nip = $('#nip').val();
    var nama = $('#nama').val();
    var nidn = $('#nidn').val();

    var data = {
      nip     : nip,
      nama    : nama,
      nidn    : nidn
    }

  $.ajax({
      url     : "<?php echo base_url('sdm/kartuPID'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#dataTables-example > tbody').html(data);
      }
    });
}
function print(caraPrint,id_pegawai)
{
    var id_pegawai = id_pegawai;
    window.open('<?php echo base_url('sdm/kartuPID/printKartu/'); ?>/'+id_pegawai,'printwin','left=100,top=100,width=1000,height=640');
}
</script>