<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transaksi Pengajuan Biaya
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart('pegawai/PengajuanBiaya/insert',array('accept-charset'=>"utf-8"));  ?>
                        <?php if(validation_errors()){ ?>
                        <div class="alert alert-warning">
                            <strong><?php echo validation_errors(); ?></strong>
                        </div>              
                        <?php } ?>  
                        <div class="form-group">
                            <label for="kode_pengajuan">Kode Pengajuan</label>
                            <input class="form-control" type="text" name="kode_pengajuan" placeholder="Isikan Kode Pengajuan" value="<?php echo isset($kode_pengajuan) ? $kode_pengajuan : ""; ?>" readonly=true required>
                            <input class="form-control" type="hidden" name="id_pengajuan_biaya" value="<?php echo isset($datapengajuan->id_pengajuan_biaya) ? $datapengajuan->id_pengajuan_biaya : ""; ?>" readonly=true required>
                            <input class="form-control" type="hidden" name="id_lokasi_lama" id="id_lokasi_lama" value="<?php echo isset($datapegawai->id_lokasi) ? $datapegawai->id_lokasi : ""; ?>" readonly=true required>
                        </div>
                         <div class="form-group">
                            <label>Tanggal</label>
                            <br>
                            <!-- <div class="myOwnClass"> -->
                                <input type="text" class="form-control datepickerNew" id="tanggal" name="tanggal" value="<?php echo isset($datapengajuan->tanggal) ? date('d/m/Y',strtotime($datapengajuan->tanggal)) : date('Y-m-d'); ?>">
                            <!-- </div> -->
                            <!-- <input class="form-control" id="tanggal" name="tanggal" type="text" class="span3" value="<?php echo isset($datapengajuan->tanggal) ? date('d/m/Y',strtotime($datapengajuan->tanggal)) : ""; ?>" required> -->
                        </div>
                        <div class="form-group">
                            <label>Pilih Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="">-Pilih Semester-</option>
                                <?php for ($i = 0; $i < 8; $i++) {
                                    if($pengajuan->semester < ($i+1)){
                                 ?>
                                    <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi Pendidikan</label>
                            <select class="form-control" name="nama_lokasi" id="nama_lokasi" onchange="setLokasiPendidikan();">
                                <option value="">-Pilih Lokasi-</option>
                                <option value="Dalam Negeri">Dalam Negeri</option>
                                <option value="Luar Negeri">Luar Negeri</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>Nama Universitas</label>
                            <div class="controls" id="tampil_universitas">
                               <select class="form-control" name="id_lokasi" id="id_lokasi">
                                    <option value="">-Pilih Universitas-</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jurusan_fakultas">Fakultas</label>
                            <input class="form-control" type="text" name="jurusan_fakultas" value="<?php echo isset($datapengajuan->jurusan_fakultas) ? $datapengajuan->jurusan_fakultas : ""; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi</label>
                            <input class="form-control" type="text" name="prodi" value="<?php echo isset($datapengajuan->prodi) ? $datapengajuan->prodi : ""; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang" id="jenjang">
                                <option value="">-Pilih Jenjang-</option>
                                <option value="S3">S3</option>
                                <option value="S2">S2</option>
                                <option value="S1">S1</option>
                                <option value="D3">D3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Jumlah Nominal</label>
                            <input class="form-control numbers-only" type="text" name="jumlah_nominal" id="jumlah_nominal" value="<?php echo isset($datapengajuan->jumlah_nominal) ? $datapengajuan->jumlah_nominal : ""; ?>" required>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                        <!-- <legend>Data Rincian Biaya</legend> -->
                        <!-- <table class="table table-striped table-bordered table-hover" id="tabel-biaya">
                            <thead>
                                <tr>
                                    <th>Kategori Biaya</th>
                                    <th>Nominal</th>
                                    <th class="td-actions">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><select class="form-control kategori_biaya" name="biaya[0][id_kategori_biaya]">
                                            <option value="">-Pilih Kategori Biaya-</option>
                                            <?php foreach ($kategori as $i => $val) { ?>
                                            <option value="<?php echo $val->id_kategori_biaya; ?>"><?php echo $val->nama_kategori; ?></option>
                                            <?php } ?>
                                        </select></td>
                                    <td><input id="biaya_0_nominal" type="text" name="biaya[0][nominal]" class="form-control numbers-only" onblur="hitungTotalBiaya(this);"></td>
                                    <td class="td-actions">
                                        <a href="#" class="btn btn-small btn-success" onclick="tambahBiaya();"><i class="fa fa-plus"> </i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a class="btn btn-danger" href="<?php echo base_url('pegawai/PengajuanBiaya'); ?>">Batal</a>
                    </div>
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">  
    function setLokasiPendidikan(){
        var nama_lokasi = $('#nama_lokasi').val();
        var id_lokasi = $('#id_lokasi_lama').val();
        $.ajax({
            type: 'POST',
            data: "nama_lokasi="+nama_lokasi+"&id_lokasi="+id_lokasi,
            url: '<?php echo base_url('pegawai/DataPegawai/dropDownUniversitas'); ?>',
            success: function(result) {
                $('#tampil_universitas').html(result);       
            }
        });

    }

    function tambahBiaya(){
        var data = {
          tambah_biaya    : 'ya'
        }

        $.ajax({
            url     : "<?php echo base_url('pegawai/PengajuanBiaya/setFormBiaya'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#tabel-biaya tbody').append(data.tr);
              renameInput($('#table-biaya'));  
            }
        });
                          
    }

    function hapusBiaya(obj){
        $(obj).parents("tr").fadeOut();
        $(obj).parents("tr").remove();
    }

    function hitungTotalBiaya(obj){
        total_nominal = 0;
        $('#tabel-biaya tbody tr').each(function(){
            var nominal = parseFloat($(this).find('input[name$="[nominal]"]').val());
            total_nominal += nominal;
        });
        $('#jumlah_nominal').val(total_nominal);
    }

    function renameInput(obj_table){
        var row = 0;
        $('#tabel-biaya tbody tr').each(function(){     
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
      var jml_biaya = 0;
      $(".kategori_biaya").each(function(){
        var kategori_biaya = $(this).parents('tr').find('input[name$="[id_kategori_biaya]"]').val();

        if(kategori_biaya == ''){
          jml_biaya++;
        }
      });

    // Validasi Form pada saat akan disimpan
      if (jml_biaya > 0){
        alert("Rincian Biaya harus diisi!");
        return false;
      }else{
          return true;
      }
    }

    var id_lokasi = '<?php echo isset($datapegawai->id_lokasi) ? $datapegawai->id_lokasi : ""; ?>';
        if(id_lokasi != ''){
            var data = {
              setlokasi     : 'ya',
              id_lokasi     : id_lokasi
            }

            $.ajax({
              url     : "<?php echo base_url('pegawai/DataPegawai/setLokasi'); ?>",
              type    : "POST",
              data    : data,
              dataType: 'json',
              success : function (data) {                                        
                    if(id_lokasi != ''){
                        $('#id_lokasi_lama').val(data.id_lokasi);
                        $('#nama_lokasi').val(data.nama_lokasi);
                    }
                    setLokasiPendidikan();
              }
            });
        }

    $(document).ready(function(){  
        var biaya_spp = '<?php echo isset($datapegawai->biaya_spp) ? $datapegawai->biaya_spp : ""; ?>';
        if(biaya_spp != ''){
            $('#jumlah_nominal').val(biaya_spp);
        }

        var id_kategori_biaya = '<?php echo isset($datapengajuan->id_kategori_biaya) ? $datapengajuan->id_kategori_biaya : ""; ?>';
        if(id_kategori_biaya != ""){           
            $('#id_kategori_biaya').val(id_kategori_biaya);
        }

        var semester = '<?php echo isset($datapengajuan->semester) ? $datapengajuan->semester : ""; ?>';
        if(semester != ""){           
            $('#semester').val(semester);
        }

        var jenjang = '<?php echo isset($datapengajuan->jenjang) ? $datapengajuan->jenjang : ""; ?>';
        if(jenjang != ""){           
            $('#jenjang').val(jenjang);
        }

        $('.numbers-only').keyup(function() {
            var d = $(this).attr('numeric');
            var value = $(this).val();
            var orignalValue = value;
            value = value.replace(/[0-9]*/g, "");
            var msg = "Only Integer Values allowed.";

            if (d == 'decimal') {
            value = value.replace(/\./, "");
            msg = "Only Numeric Values allowed.";
            }

            if (value != '') {
              orignalValue = orignalValue.replace(/([^0-9].*)/g, "")
              $(this).val(orignalValue);
            }
        });
    });
</script>