<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Lokasi Pendidikan
            </div>
            <div class="panel-body">                
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>Lokasi Pendidikan</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%">
                                <select class="form-control input-sm" id="nama_lokasi" name="nama_lokasi" aria-controls="dataTables-example">
                                    <option value="">-Pilih Lokasi-</option>
                                    <option value="Dalam Negeri">Dalam Negeri</option>
                                    <option value="Luar Negeri">Luar Negeri</option>
                                </select>  
                            </td>

                            <td style="width:9%"></td>

                            <td><label>Nama Universitas</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text"  class="form-control" id="nama_universitas" name="nama_universitas"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('admin/lokasiPendidikan/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>
                <div id="isi_table">
                    <table class="table table-striped table-bordered table-hover" id="data-pendidikan">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lokasi</th>
                                <th>Nama Universitas</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th class="td-actions" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->nama_lokasi; ?></td>
                                    <td><?php echo $v->nama_universitas; ?></td>
                                    <td><?php echo $v->alamat; ?></td>
                                    <td><?php echo $v->no_telp; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/lokasiPendidikan/edit/'.$v->id_lokasi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Lokasi Pendidikan"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/lokasiPendidikan/hapus/'.$v->id_lokasi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Lokasi Pendidikan" onclick="return confirm('Apakah anda yakin akan menghapus lokasi pendidikan ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    Halaman :  <div class="halaman"><?php echo $halaman;?></div>
                </div>                    
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/lokasiPendidikan/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Lokasi Pendidikan</a>                
                <a class="btn btn-success" href="<?php echo base_url('admin/lokasiPendidikan/importLokasiPendidikan'); ?>"><i class="fa fa-plus"></i> Import Data Lokasi Pendidikan</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var nama_lokasi = $('#nama_lokasi').val();
        var nama_universitas = $('#nama_universitas').val();

        var data = {
          nama_lokasi: nama_lokasi,
          nama_universitas: nama_universitas
        }

        $.ajax({
            url     : "<?php echo base_url('admin/lokasiPendidikan/index'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#data-pendidikan > tbody').html(data);
            }
        });
    }
</script>