<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tambah Lokasi Pendidikan
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php echo form_open('admin/LokasiPendidikan/insert',array('onsubmit'=>'return cekInputan();return false;'));  ?>
                    <div class="col-lg-12">
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Lokasi Pendidikan</label>
                                <select class="form-control" name="nama_lokasi">
                                    <option value="">-Pilih Lokasi-</option>
                                    <option value="Dalam Negeri">Dalam Negeri</option>
                                    <option value="Luar Negeri">Luar Negeri</option>
                                </select>
                            </div>                            
                    </div>
                    <div class="col-lg-12">
                        <!-- <div class="table-responsive"> -->
                            <table class="table table-striped table-bordered table-hover" id="tabel-lokasi">
                                <thead>
                                    <tr>
                                        <th>Nama Universitas</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                        <th class="td-actions">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td><input id="pendidikan_0_nama_universitas" type="text" name="pendidikan[0][nama_universitas]" class="form-control nama_universitas" ></td>
                                        <td><textarea id="pendidikan_0_alamat" name="pendidikan[0][alamat]" class="form-control"></textarea></td>
                                        <td><input id="pendidikan_0_no_telp" name="pendidikan[0][no_telp]" type="text" class="form-control"></td>
                                        <td class="td-actions">
                                            <a href="#" class="btn btn-small btn-success" onclick="tambahUniversitas();"><i class="fa fa-plus"> </i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a class="btn btn-danger" href="<?php echo base_url('admin/LokasiPendidikan'); ?>">Batal</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function tambahUniversitas(){
  var data = {
      tambah_universitas    : 'ya'
    }

  $.ajax({
      url     : "<?php echo base_url('admin/LokasiPendidikan/setFormUniversitas'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#tabel-lokasi tbody').append(data.tr);
          renameInput($('#table-lokasi'));  
      }
    });
                      
}

function hapusUniversitas(obj){
    $(obj).parents("tr").fadeOut();
    $(obj).parents("tr").remove();
}

function renameInput(obj_table){
    var row = 0;
    $('#tabel-lokasi tbody tr').each(function(){     
        $(this).find('input,select,textarea').each(function(){ //element <input>
            var old_name = $(this).attr("name").replace(/]/g,"");
            var old_name_arr = old_name.split("[");
            if(old_name_arr.length == 3){
                $(this).attr("id",old_name_arr[0]+"_"+row+"_"+old_name_arr[2]);
                $(this).attr("name",old_name_arr[0]+"["+row+"]["+old_name_arr[2]+"]");
            }
        });
        row++;
    });
    
}

function cekInputan(){
// Menghitung jumlah data yang akan disimpan
  var jml_universitas = 0;
  $(".nama_universitas").each(function(){
    var nama_universitas = $(this).parents('tr').find('input[name$="[nama_universitas]"]').val();

    if(nama_universitas == ''){
      jml_universitas++;
    }
  });

// Validasi Form pada saat akan disimpan
  if (jml_universitas > 0){
    alert("Nama Universitas baru harus diisi!");
    return false;
  }else{
      return true;
  }
}
</script>