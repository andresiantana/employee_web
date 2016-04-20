<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Daftar Pegawai
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="col-sm-6">
                                 <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        NIDN                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="nidn" name="nidn">
                                    </label>
                                </div>
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        Nama                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="nama" name="nama">
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>        
                                        NIP                                            
                                        <input type="text" onblur="setPencarian();" class="form-control" id="nip" name="nip">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>Tanggal Lahir</th>
                                <th>E-mail</th>
                                <th>No. Telp</th>
                                <th>Foto</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Atas Nama</th>
                                <th>Sertifikasi</th>
                                <th>Surat Studi Lanjut</th>
                                <th>Surat Lulus Seleksi</th>
                                <th>Surat Terima Beasiswa</th>
                                <th>Biaya SPP</th>
                                <th>Username</th>
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
                                    <td><?php echo $v->no_telp; ?></td>
                                    <td><img src="<?php echo base_url().'data/images/pegawai/'.$v->foto; ?>" width="50px" height="50px"></td>
                                    <td><?php echo $v->fakultas; ?></td>
                                    <td><?php echo $v->prodi; ?></td>
                                    <td><?php echo $v->nama_bank; ?></td>
                                    <td><?php echo $v->nomor_rekening; ?></td>
                                    <td><?php echo $v->atasnama_rekening; ?></td>
                                    <td><?php echo $v->sertifikasi; ?></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_studi_lanjut; ?>')"><?php echo $v->surat_studi_lanjut; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_lulus_seleksi; ?>')"><?php echo $v->surat_lulus_seleksi; ?></a></td>
                                    <td><a href="javascript:prd_download('<?php echo $v->surat_terima_beasiswa; ?>')"><?php echo $v->surat_terima_beasiswa; ?></a></td>
                                    <td style="text-align:right;"><?php echo $v->username; ?></td>
                                    <td><?php echo $v->username; ?></td>
                                    <td class="td-actions">
                                        <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Cetak Kartu PID" onclick="print('PRINT',<?php echo $v->id_pegawai; ?>);"><i class="fa fa-print"> </i></a>
                                        &nbsp;
                                        <a href="javascript:void(0)" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk Kirim Notifikasi" onclick="sendNotifikasi(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-bell"> </i></a>
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

<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('sdm/daftarPegawai/file_download') ?>?file_name="+ file_name;
}
function cetakKartuPID(id_pegawai){
    alert(id_pegawai);
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
            // if(data == ''){
            //     window.location.reload();
            // }
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