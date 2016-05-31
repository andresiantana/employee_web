<div class="row">                    
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Registrasi Pegawai
        </div>
        <div class="panel-body">
            <?php if(validation_errors()){ ?>
            <div class="alert alert-warning">
                <strong><?php echo validation_errors(); ?></strong>
            </div>              
            <?php } ?>
    
            <?php echo form_open("pegawai/registrasi/register_proses"); ?>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" name="username" placeholder="NIP" required>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Kata Kunci" required>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input class="form-control" type="password" id="password_ulang" name="password_ulang" placeholder="Ulangi Kata Kunci" onblur="cekPassword(this);" required>
                </div>
                <button class="button btn btn-danger btn-large">Registrasi</button> 
                </i>&nbsp;<span><a href="<?php echo base_url('pegawai/login'); ?>">Masuk</a></span>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>