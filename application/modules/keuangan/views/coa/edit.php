<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tambah Coa
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('keuangan/Coa/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label for="username">No. Akun</label>
                                <input class="form-control" type="text" name="no_akun" placeholder="Isikan No. Akun" readonly=true value="<?php echo $editdata->no_akun; ?>" required >
                            </div>
                            <div class="form-group">
                                <label for="password">Nama Akun</label>
                                <input class="form-control" type="text" name="nama_akun" placeholder="Isikan Nama Akun" value="<?php echo $editdata->nama_akun; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('keuangan/Coa'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>