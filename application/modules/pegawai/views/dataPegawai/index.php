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
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>Tanggal Lahir</th>
                                <th>E-mail</th>
                                <th>No. Telp/HP</th>
                                <th>Foto</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Atas Nama</th>
                                <th>Surat Studi Lanjut</th>
                                <th>Surat Lulus Seleksi</th>
                                <th>Surat Terima Beasiswa</th>
                                <th>Sertifikasi</th>
                                <th>Biaya SPP</th>
                                <th class="td-actions">Aksi</th>
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
                                    <td><?php echo number_format($v->biaya_spp); ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('pegawai/DataPegawai/lengkapiData/'.$v->id_pegawai); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Data Pegawai"><i class="fa fa-edit"> </i></a>
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
function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('pegawai/DataPegawai/file_download') ?>?file_name="+ file_name;
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
</script>