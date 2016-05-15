<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tambah Prodi
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php echo form_open('admin/Prodi/insert',array('onsubmit'=>'return cekInputan();return false;'));  ?>
                    <div class="col-lg-12">
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Fakultas</label>
                                <select class="form-control" name="id_fakultas">
                                    <option value="">-Pilih Fakultas-</option>
                                    <?php foreach ($fakultas as $i => $val) { ?>
                                        <option value="<?php echo $val->id_fakultas; ?>"><?php echo $val->nama_fakultas; ?></option>
                                    <?php } ?>
                                </select>  
                            </div>                            
                    </div>
                    <div class="col-lg-12">
                        <!-- <div class="table-responsive"> -->
                            <table class="table table-striped table-bordered table-hover" id="tabel-prodi">
                                <thead>
                                    <tr>
                                        <th>Kode Prodi</th>
                                        <th>Nama Prodi</th>
                                        <th class="td-actions">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td><input id="prodi_0_kode_prodi" type="text" name="prodi[0][kode_prodi]" class="form-control kode_prodi" ></td>
                                        <td><input id="prodi_0_nama_prodi" name="prodi[0][nama_prodi]" type="text" class="form-control"></td>
                                        <td class="td-actions">
                                            <a href="#" class="btn btn-small btn-success" onclick="tambahProdi();"><i class="fa fa-plus"> </i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a class="btn btn-danger" href="<?php echo base_url('admin/Prodi'); ?>">Batal</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function tambahProdi(){
  var data = {
      tambah_prodi    : 'ya'
    }

  $.ajax({
      url     : "<?php echo base_url('admin/Prodi/setFormProdi'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#tabel-prodi tbody').append(data.tr);
          renameInput($('#table-prodi'));  
      }
    });
                      
}

function hapusProdi(obj){
    $(obj).parents("tr").fadeOut();
    $(obj).parents("tr").remove();
}

function renameInput(obj_table){
    var row = 0;
    $('#tabel-prodi tbody tr').each(function(){     
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
  var jml_prodi = 0;
  $(".kode_prodi").each(function(){
    var kode_prodi = $(this).parents('tr').find('input[name$="[kode_prodi]"]').val();

    if(kode_prodi == ''){
      jml_prodi++;
    }
  });

// Validasi Form pada saat akan disimpan
  if (jml_prodi > 0){
    alert("Kode Prodi baru harus diisi!");
    return false;
  }else{
      return true;
  }
}
</script>