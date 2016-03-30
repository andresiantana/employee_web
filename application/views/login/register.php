<div class="row">                    
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">                            
                            <div class="panel-heading" style="text-align:center;">
                            Registrasi User
                        </div>
                        <div class="panel-body">
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>

                            <?php echo form_open("login/register_proses"); ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" name="username" placeholder="Username">
                                </div>
                              
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
                                    <input class="form-control" name="no_telp" placeholder="No. Telepon/HP">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" name="password" placeholder="Password">
                                </div>
                                <button class="button btn btn-primary btn-large">Registrasi</button>
                            <?php echo form_close(); ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-12"></div>      
                </div>  