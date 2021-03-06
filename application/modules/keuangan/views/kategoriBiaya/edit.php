<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Kategori Biaya
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('keuangan/KategoriBiaya/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <input class="form-control" name="id_kategori_biaya" type="hidden" value="<?php echo $editdata->id_kategori_biaya; ?>">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input class="form-control" name="nama_kategori" type="text" placeholder="Isikan Nama Kategori" value="<?php echo $editdata->nama_kategori; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Ulang</button>
                            <a class="btn btn-danger" href="<?php echo base_url('keuangan/KategoriBiaya'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>