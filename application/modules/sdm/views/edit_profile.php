<?php 
    $nama_role = 'id="id_role" name="id_role" class="form-control"'; 
?>
<div class="row">                    
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Ubah Profile
        </div>
        <div class="panel-body">
            <?php if(validation_errors()){ ?>
            <div class="alert alert-warning">
                <strong><?php echo validation_errors(); ?></strong>
            </div>              
            <?php } ?>
    
            <?php echo form_open("sdm/dashboard/updateProfile"); ?>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $editdata->username; ?>">
                    <input class="form-control" type="hidden" name="id_user" placeholder="Username" value="<?php echo $editdata->id_user; ?>">
                    <input class="form-control" type="hidden" name="password_lama" placeholder="Kata Kunci" value="<?php echo $editdata->password; ?>">
                </div>
              
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $editdata->nama_lengkap; ?>">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
                    <input class="form-control" type="text" name="no_telp" placeholder="No. Telepon/HP" value="<?php echo $editdata->no_telp; ?>">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-home"></i></span>
                    <textarea class="form-control" name="alamat" placeholder="Alamat"><?php echo $editdata->alamat; ?></textarea>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="Kata Kunci">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input class="form-control" type="password" id="password_ulang" name="password_ulang" placeholder="Ulangi Kata Kunci" onblur="cekPassword(this);">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-success">Ulang</button>
                <a class="btn btn-danger" href="<?php echo base_url('sdm/dashboard'); ?>">Batal</a>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-12"></div>      
</div>  
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
    function cekPassword(obj){
        var pass_ulang = obj.value;
        var pass_awal = $('#password').val();
        if(pass_ulang != pass_awal){
            alert("Kata Kunci tidak sama dengan sebelumnya");
            return false;
        }
    }
        
    $(document).ready(function(){        
        var id_role = '<?php echo $editdata->id_role; ?>';
        if(id_role != ''){
            $('#id_role').val(id_role);
        }
    });
</script>