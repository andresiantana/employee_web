<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Fakultas
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/Fakultas/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Kode Fakultas</label>
                                <input type="hidden" class="form-control" name="id_fakultas" type="text" value="<?php echo $editdata->id_fakultas; ?>">
                                <input class="form-control" name="kode_fakultas" type="text" placeholder="Isikan Kode Fakultas" value="<?php echo $editdata->kode_fakultas; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Fakultas</label>
                                <input type="text" class="form-control" name="nama_fakultas" value="<?php echo $editdata->nama_fakultas; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/Fakultas'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>