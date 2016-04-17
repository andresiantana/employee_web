<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Login Aplikasi
        </div>
        <div class="panel-body">
            <?php echo form_open("pegawai/login/cek_login"); ?>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" name="username" placeholder="Username">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button class="button btn btn-primary btn-large">Log In</button>&nbsp;atau&nbsp;<span><a href="<?php echo base_url('pegawai/registrasi'); ?>">Register</a></span>
                <span style="float:right;"><a href="<?php echo base_url('pegawai/Login/resetPassword'); ?>">Lupa Password?</a></span>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>