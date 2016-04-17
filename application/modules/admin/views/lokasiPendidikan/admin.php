<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Lokasi Pendidikan
            </div>
            <div class="panel-body">
                
                <div class="table-responsive">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                <label>        
                                    Lokasi Pendidikan :                                            
                                    <select class="form-control input-sm" aria-controls="dataTables-example" onChange="setPencarian(this);">
                                        <option value="">-Pilih Lokasi-</option>
                                        <option value="Dalam Negeri">Dalam Negeri</option>
                                        <option value="Luar Negeri">Luar Negeri</option>
                                    </select>                                  
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="isi_table">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lokasi</th>
                                <th>Nama Universitas</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th class="td-actions">Aksi</th>
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
                </div>
                    
                </div>
                <a class="btn btn-primary" href="<?php echo base_url('admin/lokasiPendidikan/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Lokasi Pendidikan</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(obj){
        if(obj.value == ''){
            window.location.reload();
        }
        var data = {
          lokasi    : obj.value
        }

      $.ajax({
          url     : "<?php echo base_url('admin/LokasiPendidikan'); ?>",
          type    : "GET",
          data    : data,
          dataType: 'json',
          success : function (data) {
              $('#dataTables-example > tbody').html(data);
          }
        });
    }
</script>