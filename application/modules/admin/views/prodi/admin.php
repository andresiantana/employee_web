<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Prodi
            </div>
            <div class="panel-body">                
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>Fakultas</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%">
                                <select class="form-control" name="kode_fakultas" id="kode_fakultas">
                                    <option value="">-Pilih Fakultas-</option>
                                    <?php foreach ($fakultas as $i => $val) { ?>
                                        <option value="<?php echo $val->kode_fakultas; ?>"><?php echo $val->nama_fakultas; ?></option>
                                    <?php } ?>
                                </select>  
                            </td>

                            <td style="width:9%"></td>
                            <td><label>Prodi</label></td>
                            <td><input type="text" class="form-control" id="nama_prodi" name="nama_prodi"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('admin/prodi/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>
                <div id="isi_table">
                    <table class="table table-striped table-bordered table-hover" id="data-prodi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Fakultas</th>
                                <th>Nama Fakultas</th>
                                <th>Kode Prodi</th>
                                <th>Nama Prodi</th>
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
                                    <td><?php echo $v->kode_prodi; ?></td>
                                    <td><?php echo $v->nama_prodi; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/prodi/edit/'.$v->id_prodi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Prodi"><i class="fa fa-edit"> </i></a>
                                        <!-- <a href="<?php echo base_url('admin/prodi/hapus/'.$v->id_prodi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Prodi" onclick="return confirm('Apakah anda yakin akan menghapus prodi ini ?')"><i class="fa fa-times"> </i></a> -->
                                        <?php
                                            if($v->status_aktif == 1){
                                        ?>
                                            <a href="<?php echo base_url('admin/prodi/block_aktif/'.$v->id_prodi.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Prodi" onclick="return confirm('Apakah anda yakin akan memblokir Prodi ini ?')"><i class="fa fa-ban"> </i></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('admin/prodi/block_aktif/'.$v->id_prodi.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Prodi" onclick="return confirm('Apakah anda yakin akan mengaktifkan Prodi ini ?')"><i class="fa fa-check"> </i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="6">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/Prodi/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Prodi</a>                
                <a class="btn btn-success" href="<?php echo base_url('admin/Prodi/importProdi'); ?>"><i class="fa fa-plus"></i> Import Data Prodi</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var kode_fakultas = $('#kode_fakultas').val();
        var nama_prodi = $('#nama_prodi').val();

        var data = {
          kode_fakultas: kode_fakultas,
          nama_prodi: nama_prodi
        }

      $.ajax({
          url     : "<?php echo base_url('admin/prodi/index'); ?>",
          type    : "POST",
          data    : data,
          dataType: 'json',
          success : function (data) {
              $('#data-prodi > tbody').html(data);
          }
        });
    }
</script>