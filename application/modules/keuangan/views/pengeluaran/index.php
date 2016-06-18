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
                            <td style="width:30%"> <input type="text" class="form-control nip" id="nip" name="nip" maxlength="10"></td>

                            <td style="width:9%"></td>

                            <td style="width:10%"><label>Nama</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%"> <input type="text" class="form-control nama" id="nama" name="nama"></td>
                        </tr>
                        <tr>
                            <td><label>Kode Pengeluaran</label></td>
                            <td style="width:1%;"></td>
                            <td> <input type="text" class="form-control kode" id="kode_pengeluaran" name="kode_pengeluaran"></td>

                            <td style="width:9%"></td>

                            <td><label>Tangal Awal</label></td>
                            <td style="width:1%;"></td>
                            <td>
                                <div class="myOwnClass">
                                    <input type="text" class="form-control datepickerNew" id="tanggal_awal" name="tanggal_awal" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label></label></td>
                            <td style="width:1%;"></td>
                            <td></td>

                            <td style="width:9%"></td>

                            <td><label>Tangal Akhir</label></td>
                            <td style="width:1%;"></td>
                            <td>
                                <div class="myOwnClass">
                                    <input type="text" class="form-control datepickerNew" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('keuangan/Pengeluaran/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>
                    <table class="table table-striped table-bordered table-hover" id="data-pengeluaran">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Kode Pengeluaran</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Semester</th>
                                <th>Total Pengeluaran</th>
                                <th>Detail Biaya</th>
                            </tr>
                            <tr>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
                                    <td><?php echo $v->kode_pencairan; ?></td>
                                    <td><?php echo $v->nip; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td style="text-align:center;"><?php echo $v->semester; ?></td>
                                    <td style="text-align:right;"><?php echo $v->berhasil_transfer; ?></td>                                    
                                    <td class="td-actions">
                                        <a href="#detail" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Pengeluaran" onclick="setIdPencairan(<?php echo $v->id_pencairan_biaya; ?>,<?php echo $v->id_pegawai; ?>);"><i class="fa fa-list"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                                <tr><td colspan="8">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo ($halaman != '') ? "Halaman : " : ""; ?><div class="halaman"><?php echo $halaman;?></div>
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- Dialog untuk detail -->
<input type="hidden" id="id_pencairan_biaya">     
<input type="hidden" id="id_pegawai">   
<div class="remodal" data-remodal-id="detail" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title">Detail Biaya</h2>
    <p id="modal1Desc">
        <div id="data-detail">

        </div>
    </p>
  </div>
</div>

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">
function setIdPencairan(id_pencairan_biaya,id_pegawai){
    $('#id_pencairan_biaya').val(id_pencairan_biaya);
    $('#id_pegawai').val(id_pegawai);
    var data = {
      id_pencairan_biaya:id_pencairan_biaya,
      id_pegawai:id_pegawai,
    }

  $.ajax({
      url     : "<?php echo base_url('keuangan/Pengeluaran/detail'); ?>",
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
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();
    var kode_pengeluaran = $('#kode_pengeluaran').val();

    var data = {
      nip: nip,
      nama:nama,
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir,
      kode_pengeluaran:kode_pengeluaran,
    }

  $.ajax({
      url     : "<?php echo base_url('keuangan/Pengeluaran/index'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#data-pengeluaran > tbody').html(data);
      }
    });
}

function print(caraPrint,id_pencairan_biaya,id_pegawai)
{
    var id_pencairan_biaya = id_pencairan_biaya;
    var id_pegawai = id_pegawai
    window.open('<?php echo base_url('keuangan/Pengeluaran/printDetailPengeluaran'); ?>/'+id_pencairan_biaya+'&id_pegawai='+id_pegawai,'printwin','left=100,top=100,width=1000,height=640');
}

$(document).ready(function(){
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
        var kode = document.getElementById('kode_pengeluaran');
        var filter = /^([a-zA-Z0-9 _\`\,\.\-\'])+$/;

        if (!filter.test(kode.value)) {
            alert('Kode Pengajuan hanya boleh diisi dengan huruf dan angka!');
            $('#kode_pengeluaran').val('');
            kode.focus;
        return false;
        }
    });

    $('.nama').keyup(function() {
        var nama = document.getElementById('nama');
        var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

        if (!filter.test(nama.value)) {
            alert('Nama hanya boleh diisi dengan huruf dan karakter!');
            $('#nama').val('');
            nama.focus;
        return false;
        }
    });
});
</script>