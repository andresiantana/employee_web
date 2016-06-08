<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transaksi Pengajuan Biaya
            </div>
            <div class="panel-body">
                 <?php if(validation_errors()){ ?>
                    <div class="alert alert-warning">
                    <strong><?php echo validation_errors(); ?></strong>
                </div>              
                <?php } ?> 
                <div class="row">                    
                    <?php echo form_open_multipart("sdm/PengajuanBiaya/insert",array('accept-charset'=>"utf-8",'onsubmit'=>'return cekInputan();return false;')); ?>
                    <div class="col-lg-12">                    
                        <div class="form-group">
                            <label for="kode_pengajuan">Kode Pengajuan</label>
                            <input class="form-control" type="text" name="kode_pengajuan" placeholder="Isikan Kode Pengajuan" value="<?php echo isset($kode_pengajuan) ? $kode_pengajuan : ""; ?>" readonly=true required>
                            <input class="form-control" type="hidden" name="id_pengajuan_biaya" value="<?php echo isset($datapengajuan->id_pengajuan_biaya) ? $datapengajuan->id_pengajuan_biaya : ""; ?>" readonly=true required>
                            <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapengajuan->id_pegawai) ? $datapengajuan->id_pegawai : ""; ?>" readonly=true required>
                        </div>
                         <div class="form-group">
                            <label>Tanggal</label>
                            <!-- <br> -->
                            <!-- <div class="myOwnClass"> -->
                            <input type="text" class="form-control"  id="tanggal" name="tanggal" value="<?php echo isset($datapengajuan->tanggal) ? date('Y-m-d',strtotime($datapengajuan->tanggal)) : date('Y-m-d'); ?>" readonly=true>
                            <!-- </div> -->
                        </div>
                        <div class="form-group">
                            <label>Pilih Semester</label>
                            <select class="form-control" name="semester" id="semester" readonly>
                                <option value="">-Pilih Semester-</option>
                                <?php for ($i = 0; $i < 8; $i++) { ?>
                                    <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input class="form-control" type="text" name="nama_lokasi" value="<?php echo isset($datapengajuan->nama_lokasi) ? $datapengajuan->nama_lokasi : ""; ?>" readonly=true required>
                        </div>
                        <div class="form-group">
                            <label for="jurusan_fakultas">Jurusan/Fakultas</label>
                            <input class="form-control" type="text" name="jurusan_fakultas" value="<?php echo isset($datapengajuan->jurusan_fakultas) ? $datapengajuan->jurusan_fakultas : ""; ?>" readonly=true required>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi</label>
                            <input class="form-control" type="text" name="prodi" value="<?php echo isset($datapengajuan->prodi) ? $datapengajuan->prodi : ""; ?>" readonly=true required>
                        </div>
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang" id="jenjang" disabled>
                                <option value="">-Pilih Jenjang-</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="D3">D3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_nominal">Biaya Yang Diajukan</label>
                            <input class="form-control numbers-only" type="text" name="jumlah_nominal" id="jumlah_nominal" onblur="proporsiUraian(this);" value="<?php echo isset($datapengajuan->jumlah_nominal) ? $datapengajuan->jumlah_nominal : ""; ?>" readonly=true required>
                        </div>  

                        <div class="form-group">
                            <label for="jumlah_nominal">Biaya Yang Disetujui</label>
                            <input class="form-control numbers-only" type="text" name="jumlah_disetujui" id="jumlah_disetujui" onblur="proporsiUraian(this);" value="<?php echo isset($datapengajuan->jumlah_disetujui) ? $datapengajuan->jumlah_disetujui : ""; ?>" readonly=true required>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                            <label>Status Pengajuan</label>
                            <select class="form-control" name="status_pengajuan" id="status_pengajuan" onChange='setStatus(this);' required>
                                <option value="">-Pilih Status-</option>
                                <option value="Approved">Approved</option>
                                <option value="Reject">Reject</option>
                            </select>
                        </div>  
                        <div class="form-group" id="reject" style="display:none;">
                            <label>Alasan</label>
                            <textarea class="form-control" name="alasan_pengajuan" id="alasan_pengajuan"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12" id="approved_biaya">
                        <legend>Data Rincian Biaya</legend>
                        <table class="table table-striped table-bordered table-hover" id="tabel-biaya">
                            <thead>
                                <tr>
                                    <th>Kategori Biaya</th>
                                    <th>Nominal Pengajuan</th>
                                    <th>Nominal Disetujui</th>
                                    <th class="td-actions">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($uraian_biaya) > 0){
                                        foreach($uraian_biaya as $i=>$uraian){
                                ?>
                                <tr>
                                    <td><select  id="rincian_0_id_kategori_biaya" name="rincian[0][id_kategori_biaya]" class="form-control kategori_biaya" required>
                                            <option value="">-Pilih Kategori Biaya-</option>
                                            <?php foreach ($kategori as $i => $val) {
                                                if($uraian->id_kategori_biaya == $val->id_kategori_biaya){
                                            ?>
                                            <option value="<?php echo $val->id_kategori_biaya; ?>" selected><?php echo $val->nama_kategori; ?></option>

                                            <?php }else{ ?>
                                                <option value="<?php echo $val->id_kategori_biaya; ?>" ><?php echo $val->nama_kategori; ?></option>                                            
                                            <?php } ?>
                                            <?php } ?>
                                        </select></td>
                                    <td>
                                        <input id="rincian_0_nominal" name="rincian[0][nominal]" type="text" class="form-control numbers-only" onblur="hitungTotalBiaya(this);" value="<?php echo $uraian->nominal; ?>" readonly=true>
                                        <input id="rincian_0_id_uraian" name="rincian[0][id_uraian]" type="hidden" class="form-control numbers-only" onblur="hitungTotalBiaya(this);" value="<?php echo $uraian->id_uraian; ?>">
                                    </td>
                                    <td>
                                        <input id="rincian_0_nominal_disetujui" name="rincian[0][nominal_disetujui]" type="text" class="form-control numbers-only" onblur="hitungTotalBiayaDisetujui(this);" readonly=true>
                                    </td>
                                    <td class="td-actions">
                                        <a href="javascript:tambahBiaya();"><button id="tambahBiaya" type="button" class="btn btn-small btn-success"><i class="fa fa-plus"></i></button></a>
                                    </td>
                                </tr>
                                <?php 
                                        }
                                    }else{
                                ?>

                                <tr>
                                    <td><select id="rincian_0_id_kategori_biaya" name="rincian[0][id_kategori_biaya]"  class="form-control kategori_biaya" required>
                                            <option value="">-Pilih Kategori Biaya-</option>
                                            <?php foreach ($kategori as $i => $val) { ?>
                                            <option value="<?php echo $val->id_kategori_biaya; ?>"><?php echo $val->nama_kategori; ?></option>
                                            <?php } ?>
                                        </select></td>
                                    <td>
                                        <input id="rincian_0_nominal" name="rincian[0][nominal]" type="text" class="form-control numbers-only" onblur="hitungTotalBiaya(this);" readonly=true>
                                        <input id="rincian_0_id_uraian" name="rincian[0][id_uraian]" type="hidden" class="form-control numbers-only" onblur="hitungTotalBiaya(this);">
                                    </td>
                                    <td>
                                        <input id="rincian_0_nominal_disetujui" name="rincian[0][nominal_disetujui]" type="text" class="form-control numbers-only" onblur="hitungTotalBiaya(this);">
                                    </td>
                                    <td class="td-actions">
                                        <a href="javascript:tambahBiaya();"><button id="tambahBiaya" type="button" class="btn btn-small btn-success"><i class="fa fa-plus"></i></button></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a class="btn btn-danger" href="<?php echo base_url('sdm/PengajuanBiaya'); ?>">Batal</a>
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
    function setStatus(obj) {
        var status_pengajuan = $('#status_pengajuan').val();
        if (status_pengajuan == 'Reject') {
            $('#reject').removeAttr('style','display:none;');
            $('#approved').attr('style','display:none;');
            $('#approved_biaya').attr('style','display:none;');
            $('#tabel-biaya > tbody > tr').each(function(){
                $(this).find('input[name$="[nominal_disetujui]"]').attr('readonly',true);
            });
            $('#tambahBiaya').hide();
        } else if(status_pengajuan == 'Approved'){
            $('#reject').attr('style','display:none;');
            $('#approved').removeAttr('style','display:none;');
            $('#approved_biaya').removeAttr('style','display:none;');
            $('#tabel-biaya > tbody > tr').each(function(){
                $(this).find('input[name$="[nominal_disetujui]"]').removeAttr('readonly',true);
            });
            $('#tambahBiaya').show();
        } else {
            $('#reject').attr('style','display:none;');
            $('#approved').removeAttr('style','display:none;');
            $('#approved_biaya').removeAttr('style','display:none;');
            $('#tabel-biaya > tbody > tr').each(function(){
                $(this).find('input[name$="[nominal_disetujui]"]').attr('readonly',true);
            });
            $('#tambahBiaya').hide();
        }
    }

    function proporsiUraian(obj){
        var jumlah_nominal = parseFloat(obj.value);
        var jml_row = $('#tabel-biaya tbody').length;
        var jml_proporsi = jumlah_nominal / jml_row;
        $('#tabel-biaya tbody tr').each(function(){
            $(this).find('input[name$="[nominal]"]').val(jml_proporsi);
        });
    }
    function tambahBiaya(){
        var data = {
          tambah_biaya    : 'ya'
        }

        $.ajax({
            url     : "<?php echo base_url('sdm/PengajuanBiaya/setFormBiaya'); ?>",
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

    function hitungTotalBiayaDisetujui(obj){
        total_nominal_disetujui = 0;
        $('#tabel-biaya tbody tr').each(function(){
            var nominal_disetujui = parseFloat($(this).find('input[name$="[nominal_disetujui]"]').val());
            total_nominal_disetujui += nominal_disetujui;
        });
        $('#jumlah_disetujui').val(total_nominal_disetujui);
    }

    function hitungTotalSemua(){
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
        var jml_disetujui = 0;
        $("#tabel-biaya tbody tr").each(function(){
            var kategori_biaya = $(this).find('input[name$="[id_kategori_biaya]"]').val();

            if(kategori_biaya == ''){
              jml_biaya++;
            }
        });

        $("#tabel-biaya tbody tr").each(function(){
            var nominal_disetujui = $(this).find('input[name$="[nominal_disetujui]"]').val();

            if(nominal_disetujui == ''){
                  jml_disetujui++;
            }
        });
        // Validasi Form pada saat akan disimpan
        if(jml_disetujui > 0){
            alert("Nominal Disetujui biaya harus diisi");
            return false;
        }
        if (jml_biaya > 0){
            alert("Rincian Biaya harus diisi!");
            return false;
        }
        return true;
    }

    $(document).ready(function() {  
        // hitungTotalSemua();
        $('#tambahBiaya').hide();
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