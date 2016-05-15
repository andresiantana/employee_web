<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tambah Fakultas
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php echo form_open('admin/Fakultas/insert',array('onsubmit'=>'return cekInputan();return false;'));  ?>         
                    <div class="col-lg-12">
                        <!-- <div class="table-responsive"> -->
                            <table class="table table-striped table-bordered table-hover" id="tabel-fakultas">
                                <thead>
                                    <tr>
                                        <th>Kode Fakultas</th>
                                        <th>Nama Fakultas</th>
                                        <th class="td-actions">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td><input id="fakultas_0_kode_fakultas" type="text" name="fakultas[0][kode_fakultas]" class="form-control kode_fakultas" ></td>
                                        <td><input id="fakultas_0_nama_fakultas" type="text" name="fakultas[0][nama_fakultas]" class="form-control"></td>
                                        <td class="td-actions">
                                            <a href="#" class="btn btn-small btn-success" onclick="tambahFakultas();"><i class="fa fa-plus"> </i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a class="btn btn-danger" href="<?php echo base_url('admin/Fakultas'); ?>">Batal</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function tambahFakultas(){
  var data = {
      tambah_fakultas    : 'ya'
    }

  $.ajax({
      url     : "<?php echo base_url('admin/Fakultas/setFormFakultas'); ?>",
      type    : "POST",
      data    : data,
      dataType: 'json',
      success : function (data) {
          $('#tabel-fakultas tbody').append(data.tr);
          renameInput($('#table-fakultas'));  
      }
    });
                      
}

function hapusFakultas(obj){
    $(obj).parents("tr").fadeOut();
    $(obj).parents("tr").remove();
}

function renameInput(obj_table){
    var row = 0;
    $('#tabel-fakultas tbody tr').each(function(){     
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
  var jml_fakultas = 0;
  $(".kode_fakultas").each(function(){
    var kode_fakultas = $(this).parents('tr').find('input[name$="[kode_fakultas]"]').val();

    if(kode_fakultas == ''){
      jml_fakultas++;
    }
  });

// Validasi Form pada saat akan disimpan
  if (jml_fakultas > 0){
    alert("Kode Fakultas baru harus diisi!");
    return false;
  }else{
      return true;
  }
}
</script>