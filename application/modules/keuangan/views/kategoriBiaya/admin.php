<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Kategori Biaya
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>Nama Kategori</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%">
                                <input type="text"  class="form-control" id="nama_kategori" name="nama_kategori">
                            </td>

                            <td style="width:9%"></td>

                            <td style="width:10%"><label></label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('keuangan/kategoriBiaya/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-kategori">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Status</th>
                                <th class="td-actions" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->nama_kategori; ?></td>
                                    <td><?php echo ($v->status_aktif == true) ? "Aktif" : "Tidak Aktif" ; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('keuangan/kategoriBiaya/edit/'.$v->id_kategori_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Kategori Biaya"><i class="fa fa-edit"> </i></a>
                                        <?php
                                            if($v->status_aktif == 1){
                                        ?>
                                            <a href="<?php echo base_url('keuangan/kategoriBiaya/block_aktif/'.$v->id_kategori_biaya.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir kategori biaya" onclick="return confirm('Apakah anda yakin akan memblokir kategori biaya ini ?')"><i class="fa fa-ban"> </i></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('keuangan/kategoriBiaya/block_aktif/'.$v->id_kategori_biaya.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan kategori biaya" onclick="return confirm('Apakah anda yakin akan mengaktifkan kategori biaya ini ?')"><i class="fa fa-check"> </i></a>
                                        <?php } ?>
                                        <a href="<?php echo base_url('keuangan/kategoriBiaya/hapus/'.$v->id_kategori_biaya); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Kategori Biaya" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a>
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
                <a class="btn btn-primary" href="<?php echo base_url('keuangan/kategoriBiaya/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Kategori Biaya</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var nama_kategori = $('#nama_kategori').val();

        var data = {
          nama_kategori: nama_kategori
        }

        $.ajax({
            url     : "<?php echo base_url('keuangan/kategoriBiaya/index'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#data-kategori > tbody').html(data);
            }
        });
    }
</script>