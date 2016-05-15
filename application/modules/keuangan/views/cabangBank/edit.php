<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tambah Cabang Bank
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('keuangan/CabangBank/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label for="nama_cabang">Nama Cabang Bank</label>
                                <input class="form-control" type="text" name="nama_cabang" placeholder="Isikan Nama Cabang" value="<?php echo $editdata->nama_cabang; ?>" required >
                                <input class="form-control" type="hidden" name="id_cabang_bank" readonly=true value="<?php echo $editdata->id_cabang_bank; ?>" required >
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('keuangan/CabangBank'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>