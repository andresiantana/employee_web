<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Jenis Sertifikasi
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:20%"><label>Jenis Sertifikasi</label></td>
                            <td style="width:30%"><input type="text"  class="form-control" id="nama_sertifikasi" name="nama_sertifikasi"></td>

                            <td style="width:9%"></td>

                            <td><label>&nbsp;</label></td>
                            <td style="width:1%;">&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('admin/fakultas/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-sertifikasi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Jenis Sertifikasi</th>
                                <th class="td-actions" style="width:150px;">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $i=>$v): ?>
                                <tr>
                                    <td><?php echo ($i+1); ?></td>
                                    <td><?php echo $v->nama_jenis_sertifikasi; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/jenisSertifikasi/edit/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Jenis Sertifikasi"><i class="fa fa-edit"> </i></a>
                                        <!-- <a href="<?php echo base_url('admin/jenisSertifikasi/hapus/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a> -->
                                        <?php
                                            if($v->status == 1){
                                        ?>
                                            <a href="<?php echo base_url('admin/jenisSertifikasi/block_aktif/'.$v->id_jenis_sertifikasi.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan memblokir Jenis Sertifikasi ini ?')"><i class="fa fa-ban"> </i></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('admin/jenisSertifikasi/block_aktif/'.$v->id_jenis_sertifikasi.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan mengaktifkan Jenis Sertifikasi ini ?')"><i class="fa fa-check"> </i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="3">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>  
                <br>              
                <a class="btn btn-primary" href="<?php echo base_url('admin/jenisSertifikasi/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Jenis Sertifikasi</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var nama_sertifikasi = $('#nama_sertifikasi').val();

        var data = {
          nama_sertifikasi: nama_sertifikasi
        }

        $.ajax({
            url     : "<?php echo base_url('admin/jenisSertifikasi/index'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#data-sertifikasi > tbody').html(data);
            }
        });
    }
</script>
