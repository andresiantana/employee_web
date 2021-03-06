<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Role
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/role/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Nama Role</label>
                                <input class="form-control" type="text" name="nama_role" type="text" placeholder="Isikan Nama Role" value="<?php echo $editdata->nama_role; ?>">
                                <input class="form-control" name="id_role" type="hidden" placeholder="Isikan ID Role" value="<?php echo $editdata->id_role; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/Role'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>