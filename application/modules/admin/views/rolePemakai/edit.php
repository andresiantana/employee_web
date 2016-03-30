<?php $nama_role = 'id="id_role" name="id_role" class="form-control"'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Role Pemakai
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/RolePemakai/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" type="text" placeholder="Isikan Username" value="<?php echo $editdata->username; ?>">
                                <input class="form-control" name="username_lama" type="hidden" value="<?php echo $editdata->username; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" name="nama_lengkap" type="text" placeholder="Isikan Nama Lengkap" value="<?php echo $editdata->nama_lengkap; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Role</label>
                                <?php                  
                                    echo form_dropdown('id_role', $role, $role_selected, $nama_role);
                                ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/RolePemakai'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){        
        var id_role = '<?php echo $editdata->id_role; ?>';
        if(id_role != ''){
            $('#id_role').val(id_role);
        }
    });
</script>