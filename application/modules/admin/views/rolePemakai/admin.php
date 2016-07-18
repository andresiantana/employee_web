<div class="row">
    <div class="col-md-12">
        <?php if(isset($message) && $message == 'sukses'){ ?>
            <div class="alert alert-success">
                <center><strong>Berhasil!</strong> Data berhasil disimpan </center>
            </div>  
        <?php }else if(isset($message) && $message == 'gagal'){ ?>
            <div class="alert alert-error">
                <center><strong>Gagal!</strong> Data gagal disimpan </center>
            </div>
        <?php } ?>
        <div class="panel panel-default">            
            <div class="panel-heading">
                Tabel User
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td><label>Role</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%">
                                <select class="form-control" name="id_role" id="id_role" onchange="setPencarian();">
                                    <option value="">-Pilih Role-</option>
                                    <?php foreach ($role as $i => $val) { ?>
                                        <option value="<?php echo $val->id_role; ?>"><?php echo $val->nama_role; ?></option>
                                    <?php } ?>
                                </select>  
                            </td>

                            <td style="width:9%"></td>

                            <td><label>Nama User</label></td>
                            <td style="width:1%;"></td>
                            <td><input type="text"  class="form-control" id="username" name="username" onkeypress="setPencarian()"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('admin/rolePemakai/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-user">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Kata Kunci</th>
                                <th>Role</th>
                                <th class="td-actions" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->username; ?></td>
                                    <td><?php echo $v->password; ?></td>
                                    <td><?php echo $v->nama_role; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/rolePemakai/edit/'.$v->id_user); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah User"><i class="fa fa-edit"> </i></a>
                                        <?php
                                            if($v->user_aktif == 1){
                                        ?>
                                            <a href="<?php echo base_url('admin/rolePemakai/block_aktif/'.$v->id_user.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir User" onclick="return confirm('Apakah anda yakin akan memblokir User ini ?')"><i class="fa fa-ban"> </i></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('admin/rolePemakai/block_aktif/'.$v->id_user.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan User" onclick="return confirm('Apakah anda yakin akan mengaktifkan User ini ?')"><i class="fa fa-check"> </i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="5">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/rolePemakai/tambah'); ?>"><i class="fa fa-plus"></i> Tambah User</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var id_role = $('#id_role').val();
        var username = $('#username').val();

        var data = {
          id_role: id_role,
          username: username
        }

      $.ajax({
          url     : "<?php echo base_url('admin/rolePemakai/index'); ?>",
          type    : "POST",
          data    : data,
          dataType: 'json',
          success : function (data) {
              $('#data-user > tbody').html(data);
          }
        });
    }
</script>