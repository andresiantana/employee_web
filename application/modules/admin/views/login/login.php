<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Masuk Aplikasi
        </div>
        <div class="panel-body">
            <?php echo form_open("admin/login/cek_login"); ?>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" type="text" name="username" placeholder="Username">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="Kata Kunci">
                </div>
                <button class="button btn btn-primary btn-large">Masuk</button>
                &nbsp;<span><a href="<?php echo base_url('admin/Login/resetPassword'); ?>">Lupa Kata Kunci?</a></span>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
    <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12"></div>      
    </div>  
</div>