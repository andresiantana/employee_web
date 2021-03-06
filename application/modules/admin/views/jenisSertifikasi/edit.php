<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Jenis Sertifikasi
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/JenisSertifikasi/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Nama Jenis Sertifikasi</label>
                                <input class="form-control" type="text" name="nama_jenis_sertifikasi" type="text" placeholder="Isikan Nama Jenis Sertifikasi" value="<?php echo $editdata->nama_jenis_sertifikasi; ?>">
                                <input class="form-control" name="id_jenis_sertifikasi" type="hidden" value="<?php echo $editdata->id_jenis_sertifikasi; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/JenisSertifikasi'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>