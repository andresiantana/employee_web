<div class="row">                    
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Ulang Kata Kunci
        </div>
        <div class="panel-body">
            <?php if(validation_errors()){ ?>
            <div class="alert alert-warning">
                <strong><?php echo validation_errors(); ?></strong>
            </div>              
            <?php } ?>

            <form>
                <div id="resetPassword">
                    <div class="form-group input-group" id="resetPassword">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input class="form-control" id="username" name="username" placeholder="Masukan Username" required>
                </div>                
                <button class="button btn btn-primary btn-large" type="button" onclick="resetPassword();">Ulang Kata Kunci</button>
                </div>
                <div id="showPassword">
                    <span>Kata Kunci baru Anda : <b id="password_baru"> </b></span>
                    <br>
                    <span><a href="<?php echo base_url('admin/login'); ?>">Masuk</a></span>
                </div>
            </form>
        </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
$('#resetPassword').show();
$('#showPassword').hide();
    function resetPassword(){
        var username = $("#username").val();
        if(username == ''){
            alert("Masukan username terlebih dahulu!");
            return false;
        }
        var data = {
          username    : username
        }

        $.ajax({
            url     : "<?php echo base_url('admin/Login/cekUser'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
                if(data.status == true){
                    randomPassword(username);
                }else{
                    alert(data.pesan);
                }
            }
        });
    }

    function randomPassword(username){
        var data = {
          username    : username
        }
        $.ajax({
            url     : "<?php echo base_url('admin/Login/randomPassword'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
                if(data.status == true){
                    $('#resetPassword').hide();
                    $('#showPassword').show();
                    $('#password_baru').html(data.password_baru);
                }else{
                    alert("Kata Kunci baru gagal digenerate!");
                }
            }
        });
    }

    $(document).ready(function(){        

    });
</script>