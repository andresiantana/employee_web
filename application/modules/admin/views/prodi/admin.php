<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Prodi
            </div>
            <div class="panel-body">                
                <div class="table-responsive">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                <label>        
                                    Fakultas:                                          
                                    <select class="form-control" name="id_fakultas">
                                        <option value="">-Pilih Fakultas-</option>
                                        <?php foreach ($fakultas as $i => $val) { ?>
                                            <option value="<?php echo $val->id_fakultas; ?>"><?php echo $val->nama_fakultas; ?></option>
                                        <?php } ?>
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
                                <th>Kode Fakultas</th>
                                <th>Nama Fakultas</th>
                                <th>Kode Prodi</th>
                                <th>Nama Prodi</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->kode_fakultas; ?></td>
                                    <td><?php echo $v->nama_fakultas; ?></td>
                                    <td><?php echo $v->kode_prodi; ?></td>
                                    <td><?php echo $v->nama_prodi; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/prodi/edit/'.$v->id_prodi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Prodi"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/prodi/hapus/'.$v->id_prodi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Prodi" onclick="return confirm('Apakah anda yakin akan menghapus prodi ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>                    
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/Prodi/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Prodi</a>                
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
          id_fakultas    : obj.value
        }

      $.ajax({
          url     : "<?php echo base_url('admin/Prodi'); ?>",
          type    : "GET",
          data    : data,
          dataType: 'json',
          success : function (data) {
              $('#dataTables-example > tbody').html(data);
          }
        });
    }
</script>