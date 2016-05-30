<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Fakultas
            </div>
            <div class="panel-body">                
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td><label>Kode Fakultas</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text"  class="form-control" id="kode_fakultas" name="kode_fakultas"></td>

                            <td style="width:9%"></td>

                            <td><label>Nama Fakultas</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text"  class="form-control" id="nama_fakultas" name="nama_fakultas"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('admin/fakultas/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-fakultas">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Fakultas</th>
                                <th>Nama Fakultas</th>
                                <th class="td-actions" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->kode_fakultas; ?></td>
                                    <td><?php echo $v->nama_fakultas; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/Fakultas/edit/'.$v->kode_fakultas); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Fakultas"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/Fakultas/hapus/'.$v->kode_fakultas); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Fakultas" onclick="return confirm('Apakah anda yakin akan menghapus fakultas ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="4">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/Fakultas/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Fakultas</a>                
                <a class="btn btn-success" href="<?php echo base_url('admin/Fakultas/importFakultas'); ?>"><i class="fa fa-plus"></i> Import Data Fakultas</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var kode_fakultas = $('#kode_fakultas').val();
        var nama_fakultas = $('#nama_fakultas').val();

        var data = {
          kode_fakultas: kode_fakultas,
          nama_fakultas: nama_fakultas
        }

        $.ajax({
            url     : "<?php echo base_url('admin/fakultas/index'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#data-fakultas > tbody').html(data);
            }
        });
    }
</script>