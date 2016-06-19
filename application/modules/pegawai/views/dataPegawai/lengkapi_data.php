<div class="row">                 
    <div class="col-md-12">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Lengkapi Data Pegawai
        </div>
        <div class="panel-body">
            <?php if(validation_errors()){ ?>
            <div class="alert alert-warning">
                <strong><?php echo validation_errors(); ?></strong>
            </div>              
            <?php } ?>
    
            <?php echo form_open_multipart("pegawai/DataPegawai/insert",array('accept-charset'=>"utf-8")); ?>
            <div class="col-md-6">
                <legend>Data Pegawai</legend>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control nama" type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo isset($datapegawai->nama_lengkap) ? $datapegawai->nama_lengkap : ""; ?>" maxlength="50">
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapegawai->id_pegawai) ? $datapegawai->id_pegawai : ""; ?>">
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input class="form-control nip" type="text" name="nip" value="<?php echo isset($datapegawai->nip) ? $datapegawai->nip : ""; ?>" maxlength=10 readonly=true>
                </div>
                <div class="form-group">
                    <label>NIDN</label>
                    <input class="form-control nidn" type="text" name="nidn" value="<?php echo isset($datapegawai->nidn) ? $datapegawai->nidn : ""; ?>" maxlength=10>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input class="form-control tempat_lahir" type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo isset($datapegawai->tempat_lahir) ? $datapegawai->tempat_lahir : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <br>
                    <!-- <div class="myOwnClass"> -->
                        <input type="text" class="form-control datepickerNew" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo isset($datapegawai->tanggal_lahir) ? date('Y-m-d',strtotime($datapegawai->tanggal_lahir)) : date('Y-m-d'); ?>" required> (Tahun-Bulan-Tanggal)
                    <!-- </div> -->
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="text" onblur='validasiEmail();' name="email" id="email" value="<?php echo isset($datapegawai->email) ? $datapegawai->email : ""; ?>" >
                </div>
                <div class="form-group">
                    <label>No. Telp/HP</label>
                    <input class="form-control notelp" type="text" name="no_telp_hp" id="no_telp_hp" value="<?php echo isset($datapegawai->no_telp_hp) ? $datapegawai->no_telp_hp : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Foto</label> 
                    <div class="controls">
                        <?php if((count($datapegawai) > 0) && $datapegawai->foto != '') { ?>                    
                            <img src="<?php echo base_url().'data/images/pegawai/'.$datapegawai->foto; ?>" width="50px" height="50px">
                        <?php } ?><br><br>
                        <input class="form-control" type="file" name="foto">
                        <input class="form-control" type="hidden" name="file_foto" value="<?php echo isset($datapegawai->foto) ? $datapegawai->foto : ""; ?>">
                    </div>                    
                </div>
                <div class="form-group ">
                    <label>Status Pegawai</label>
                    <select class="form-control" name="status_pegawai" id="status_pegawai" onchange="setStatusPegawai();">
                        <option value="">-Pilih Status Pegawai-</option>
                        <option value="DOSEN">Dosen</option>
                        <option value="TPA">TPA</option>
                    </select>
                </div>
                <div id="dosen" style="display:none;">                    
                    <div class="form-group">
                        <label>Fakultas</label>
                        <select class="form-control" name="kode_fakultas_dosen" id="kode_fakultas_dosen" onChange="setProdi();">
                            <option value="">-Pilih Fakultas-</option>
                            <?php foreach ($fakultas as $i => $val) { ?>
                                <option value="<?php echo $val->kode_fakultas; ?>"><?php echo $val->kode_fakultas." - ".$val->nama_fakultas; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <div class="controls" id="tampil_prodi">
                           <select class="form-control" name="id_prodi" id="id_prodi">
                                <option value="">-Pilih Prodi-</option>
                            </select>                            
                        </div>
                    </div> 
                </div>
                <div id="tpa" style="display:none;">                    
                    <div class="form-group">
                        <label>Fakultas - Unit Kerja</label>
                        <select class="form-control" name="kode_fakultas_tpa" id="kode_fakultas_tpa">
                            <option value="">-Pilih-</option>
                            <?php foreach ($fakultas as $i => $val) { 
                                    if($datapegawai->kode_fakultas == $val->kode_fakultas){
                            ?>
                                <option value="<?php echo $val->kode_fakultas; ?>" selected><?php echo $val->kode_fakultas." - ".$val->nama_fakultas; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $val->kode_fakultas; ?>"><?php echo $val->kode_fakultas." - ".$val->nama_fakultas; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
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
                    <label>Prediksi Tanggal Mulai Studi</label>
                    <br>
                    <!-- <div class="myOwnClass"> -->
                        <input type="text" class="form-control datepickerNew" id="tanggal_mulai_studi" name="tanggal_mulai_studi" value="<?php echo isset($datapegawai->tanggal_mulai_studi) ? date('Y-m-d',strtotime($datapegawai->tanggal_mulai_studi)) : date('Y-m-d'); ?>" required> (Tahun-Bulan-Tanggal)
                    <!-- </div> -->
                </div>
                <div class="form-group">
                    <label>Target Semester</label>
                    <input class="form-control numbers-only" type="text" name="lama_bulan_studi" value="<?php echo isset($datapegawai->lama_bulan_studi) ? $datapegawai->lama_bulan_studi : ""; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <legend>Data Rekening</legend>
                <div class="form-group ">
                    <label>Nama Bank</label>
                    <input class="form-control nama_bank" type="text" id="nama_bank" name="nama_bank" value="<?php echo isset($datapegawai->nama_bank) ? $datapegawai->nama_bank : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Cabang Bank</label>
                    <input class="form-control cabang" type="text" id="cabang_bank" name="cabang_bank" value="<?php echo isset($datapegawai->cabang_bank) ? $datapegawai->cabang_bank : ""; ?>">
                </div>
                <!-- <div class="form-group">
                    <label>Cabang Bank</label>
                    <select class="form-control" name="id_cabang_bank">
                        <option value="">-Pilih Cabang-</option>
                        <?php foreach ($cabang_bank as $i => $val) { ?>
                            <option value="<?php echo $val->id_cabang_bank; ?>"><?php echo $val->nama_cabang; ?></option>
                        <?php } ?>
                    </select>
                </div> -->
                <div class="form-group ">
                    <label>Nomor Rekening</label>
                    <input class="form-control numbers-only" type="text" name="nomor_rekening" value="<?php echo isset($datapegawai->nomor_rekening) ? $datapegawai->nomor_rekening : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Atas Nama</label>
                    <input class="form-control atas_nama" type="text" id="atasnama_rekening" name="atasnama_rekening" value="<?php echo isset($datapegawai->atasnama_rekening) ? $datapegawai->atasnama_rekening : ""; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <legend>Data Studi Lanjut</legend>
                <div class="form-group ">
                    <label>Fakultas Studi</label>
                    <input class="form-control nama" type="text" id="fakultas_studi" name="fakultas_studi" value="<?php echo isset($datapegawai->fakultas_studi) ? $datapegawai->fakultas_studi : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Prodi Studi</label>
                    <input class="form-control nama" type="text" id="prodi_studi" name="prodi_studi" value="<?php echo isset($datapegawai->prodi_studi) ? $datapegawai->prodi_studi : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Jenjang Studi</label>
                    <input class="form-control nama" type="text" id="jenjang_studi" name="jenjang_studi" value="<?php echo isset($datapegawai->jenjang_studi) ? $datapegawai->jenjang_studi : ""; ?>">
                </div>

                <legend>Data Pengajuan</legend>
                <div class="form-group ">
                    <label>Surat Pengajuan Studi Lanjut</label>
                    <div class="controls">
                        <?php if((count($datapegawai) > 0) && $datapegawai->surat_studi_lanjut != '') { ?>
                        File yang sudah di upload: <a href="javascript:prd_download('<?php echo $datapegawai->surat_studi_lanjut; ?>')"><?php echo $datapegawai->surat_studi_lanjut; ?></a><br>
                        <?php } ?>
                        <input class="form-control" type="file" name="surat_studi_lanjut">
                        <input class="form-control" type="hidden" name="file_studi_lanjut" value="<?php echo isset($datapegawai->surat_studi_lanjut) ? $datapegawai->surat_studi_lanjut : ""; ?>">
                    </div>                    
                </div>
                <div class="form-group ">
                    <label>Surat Tanda Lulus Seleksi</label>
                    <div class="controls">
                        <?php if((count($datapegawai) > 0) && $datapegawai->surat_lulus_seleksi != '') { ?>
                        File yang sudah di upload: <a href="javascript:prd_download('<?php echo $datapegawai->surat_lulus_seleksi; ?>')"><?php echo $datapegawai->surat_lulus_seleksi; ?></a><br>
                        <?php } ?>
                        <input class="form-control" type="file" name="surat_lulus_seleksi">
                        <input class="form-control" type="hidden" name="file_lulus_seleksi" value="<?php echo isset($datapegawai->surat_lulus_seleksi) ? $datapegawai->surat_lulus_seleksi : ""; ?>">
                    </div>                    
                </div>
                <div class="form-group ">
                    <label>Surat Tanda Penerimaan Beasiswa</label>
                    <div class="controls">
                        <?php if((count($datapegawai) > 0) && $datapegawai->surat_terima_beasiswa != '') { ?>
                        File yang sudah di upload: <a href="javascript:prd_download('<?php echo $datapegawai->surat_terima_beasiswa; ?>')"><?php echo $datapegawai->surat_terima_beasiswa; ?></a><br>
                        <?php } ?>
                        <input class="form-control" type="file" name="surat_terima_beasiswa">
                        <input class="form-control" type="hidden" name="file_terima_beasiswa" value="<?php echo isset($datapegawai->surat_terima_beasiswa) ? $datapegawai->surat_terima_beasiswa : ""; ?>">
                    </div>
                    
                </div>
                <div class="form-group ">
                    <label>Biaya SPP Yang Diajukan Per Semester</label>
                    <input class="form-control numbers-only" type="text" name="biaya_spp" value="<?php echo isset($datapegawai->biaya_spp) ? $datapegawai->biaya_spp : ""; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div id="sertifikat_dosen" style="display:none;">
                    <legend>Data Sertifikasi</legend>
                        <table class="table table-striped table-bordered table-hover" id="tabel-sertifikasi">
                            <thead>
                                <tr>
                                    <th>Jenis Sertifikasi</th>
                                    <th>Penyelenggara</th>
                                    <th>Skor</th>
                                    <th>Upload</th>
                                    <th style="width:110px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($datasertifikasi) > 0){
                                        foreach($datasertifikasi as $i=>$datas){
                                ?>
                                <tr>
                                    <td><select class="form-control jenis_sertifikasi" name="sertifikasi[0][id_jenis_sertifikasi]">
                                            <option value="">-Pilih Jenis Sertifikasi-</option>
                                            <?php foreach ($jenis_sertifikasi as $i => $val) { 
                                                if($val->id_jenis_sertifikasi == $datas->id_jenis_sertifikasi){
                                            ?>
                                            <option value="<?php echo $val->id_jenis_sertifikasi; ?>" selected><?php echo $val->nama_jenis_sertifikasi; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $val->id_jenis_sertifikasi; ?>"><?php echo $val->nama_jenis_sertifikasi; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select></td>
                                    <td>
                                        <input id="sertifikasi_0_penyelenggara" type="text" name="sertifikasi[0][penyelenggara]" class="form-control" value="<?php echo $datas->penyelenggara; ?>">
                                        <input id="sertifikasi_0_id_sertifikasi" type="hidden" name="sertifikasi[0][id_sertifikasi]" class="form-control" value="<?php echo $datas->id_sertifikasi; ?>">
                                        <input id="sertifikasi_0_file_upload" type="hidden" name="sertifikasi[0][file_upload]" class="form-control" value="<?php echo $datas->upload; ?>">
                                    </td>
                                    <td><input id="sertifikasi_0_skor" name="sertifikasi[0][skor]" type="text" class="form-control" value="<?php echo $datas->skor; ?>"></td>
                                    <td><a href="javascript:prd_download('<?php echo $datas->upload; ?>')"><?php echo $datas->upload; ?></a><br><input id="sertifikasi_0_upload" name="sertifikasi[0][upload]" type="file" class="form-control"></td>
                                    <td class="td-actions">
                                        <a href="#" class="btn btn-small btn-success" onclick="tambahSertifikasi();"><i class="fa fa-plus"> </i></a>
                                    </td>
                                </tr>
                                <?php 
                                        }
                                    }else{
                                ?>
                                <tr>
                                    <td><select class="form-control jenis_sertifikasi" name="sertifikasi[0][id_jenis_sertifikasi]">
                                            <option value="">-Pilih Jenis Sertifikasi-</option>
                                            <?php foreach ($jenis_sertifikasi as $i => $val) {                                                    
                                             ?>
                                            <option value="<?php echo $val->id_jenis_sertifikasi; ?>"><?php echo $val->nama_jenis_sertifikasi; ?></option>
                                            <?php } ?>
                                        </select></td>
                                    <td>
                                        <input id="sertifikasi_0_penyelenggara" type="text" name="sertifikasi[0][penyelenggara]" class="form-control" >
                                        <input id="sertifikasi_0_id_sertifikasi" type="hidden" name="sertifikasi[0][id_sertifikasi]" class="form-control">
                                        <input id="sertifikasi_0_file_upload" type="hidden" name="sertifikasi[0][file_upload]" class="form-control">
                                    </td>
                                    <td><input id="sertifikasi_0_skor" name="sertifikasi[0][skor]" type="text" class="form-control"></td>
                                    <td><input id="sertifikasi_0_upload"  name="sertifikasi[0][upload]" type="file" accept="images/*" class="form-control"></td>
                                    <td class="td-actions">
                                        <a href="#" class="btn btn-small btn-success" onclick="tambahSertifikasi();"><i class="fa fa-plus"> </i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-success">Reset</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12"></div>      
</div>  
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">
    function setLokasiPendidikan(){
        var nama_lokasi = $('#nama_lokasi').val();
        var id_lokasi = '<?php echo isset($datapegawai->id_lokasi) ? $datapegawai->id_lokasi : ""; ?>';
        $.ajax({
            type: 'POST',
            data: "nama_lokasi="+nama_lokasi+"&id_lokasi="+id_lokasi,
            url: '<?php echo base_url('pegawai/DataPegawai/dropDownUniversitas'); ?>',
            success: function(result) {
                $('#tampil_universitas').html(result);       
            }
        });

    }

    function setProdi(){
        var kode_fakultas_dosen = $('#kode_fakultas_dosen').val();
        var kode_fakultas_tpa= $('#kode_fakultas_tpa').val();
        var status_pegawai= $('#status_pegawai').val();
        var id_prodi = '<?php echo isset($datapegawai->id_prodi) ? $datapegawai->id_prodi : null; ?>';

        if(status_pegawai == 'DOSEN'){
           kode_fakultas = kode_fakultas_dosen;
        }else{
            kode_fakultas = kode_fakultas_tpa;
        }
        $.ajax({
           type: 'POST',
           data: "kode_fakultas="+kode_fakultas,
           url: '<?php echo base_url('pegawai/DataPegawai/dropDownProdi'); ?>',
           success: function(result) {
            $('#tampil_prodi').html(result);       
            $('#id_prodi').val(id_prodi);
            }
        });

    }

    function prd_download(file)
    {   
        file_name = file;
        window.location.href =  "<?php echo site_url('sdm/daftarPegawai/file_download') ?>?file_name="+ file_name;
    }

    function validasiEmail(){
        var email = document.getElementById('email');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email.value)) {
            alert('Masukan alamat e-mail dengan benar!');
            email.focus;
            return false;
        }
    }

    function setStatusPegawai(){
        var pilihstatus_pegawai = $('#status_pegawai option:selected').val();
        if(pilihstatus_pegawai == 'DOSEN'){
            $('#dosen').removeAttr('style','display:none;');
            $('#tpa').attr('style','display:none;');
            $('#sertifikat_dosen').removeAttr('style','display:none;');
        }else{
            $('#dosen').attr('style','display:none;');
            $('#tpa').removeAttr('style','display:none;');
            $('#sertifikat_dosen').attr('style','display:none;');
        }
    }

    function tambahSertifikasi(){
        var data = {
          tambah_sertifikasi    : 'ya'
        }

        $.ajax({
          url     : "<?php echo base_url('pegawai/DataPegawai/setFormSertifikasi'); ?>",
          type    : "POST",
          data    : data,
          dataType: 'json',
          success : function (data) {
              $('#tabel-sertifikasi tbody').append(data.tr);
              renameInput($('#table-sertifikasi'));  
          }
        });                          
    }

    function hapusSertifikasi(obj){
        $(obj).parents("tr").fadeOut();
        $(obj).parents("tr").remove();
    }

    function renameInput(obj_table){
        var row = 0;
        $('#tabel-sertifikasi tbody tr').each(function(){     
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
      var jml_sertifikasi = 0;
      $(".jenis_sertifikasi").each(function(){
        var jenis_sertifikasi = $(this).parents('tr').find('input[name$="[jenis_sertifikasi]"]').val();

        if(jenis_sertifikasi == ''){
          jml_sertifikasi++;
        }
      });

    // Validasi Form pada saat akan disimpan
      if (jml_sertifikasi > 0){
        alert("Jenis Sertifikasi baru harus diisi!");
        return false;
      }else{
          return true;
      }
    }
    $(document).ready(function(){             
        var status_pegawai = '<?php echo isset($datapegawai->status_pegawai) ? $datapegawai->status_pegawai : ""; ?>';
        if(status_pegawai != ""){           
            $('#status_pegawai').val(status_pegawai);
            if(status_pegawai == 'DOSEN'){
                setStatusPegawai();
            }else{
                setStatusPegawai();
            }
        }

        var fakultas = '<?php echo isset($datapegawai->kode_fakultas) ? $datapegawai->kode_fakultas : ""; ?>';
        if(fakultas != ''){            
             if(status_pegawai == 'DOSEN'){
                $('#kode_fakultas_dosen').val(fakultas);
            }else{
                $('#kode_fakultas_tpa').val(fakultas);
            }
            setProdi()
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
                    $('#nama_lokasi').val(data.nama_lokasi);
                    setLokasiPendidikan();
                    if(id_lokasi != ''){
                        $('#id_lokasi').val(id_lokasi);
                    }
              }
            });
        }

        var id_prodi = '<?php echo isset($datapegawai->id_prodi) ? $datapegawai->id_prodi : ""; ?>';
        if(id_prodi != ''){
            $('#id_prodi').val(id_prodi);
        }
        // $( ".myOwnClass" ).wsCalender({ "min-year" : ( new Date() ).getFullYear() - 80 });
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

        $('.nip').keyup(function() {
            var d = $(this).attr('numeric');
            var value = $(this).val();
            var orignalValue = value;
            value = value.replace(/[0-9]-*/g, "");
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

        $('.nidn').keyup(function() {
            var d = $(this).attr('numeric');
            var value = $(this).val();
            var orignalValue = value;
            value = value.replace(/[0-9]-*/g, "");
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

        $('.notelp').keyup(function() {
            var no_telp_hp = document.getElementById('no_telp_hp');
            var filter = /^([0-9\_\-\/])+$/;

            if (!filter.test(no_telp_hp.value)) {
                alert('No. Telepon/HP hanya boleh diisi dengan angka dan karakter!');
                $('#no_telp_hp').val('');
                no_telp_hp.focus;
            return false;
            }
        });

        $('.nama').keyup(function() {
            var nama = document.getElementById('nama_lengkap');
            var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

            if (!filter.test(nama.value)) {
                alert('Nama hanya boleh diisi dengan huruf dan karakter!');
                $('#nama_lengkap').val('');
                nama.focus;
            return false;
            }
        });

        $('.cabang').keyup(function() {
            var cabang_bank = document.getElementById('cabang_bank');
            var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

            if (!filter.test(cabang_bank.value)) {
                alert('Cabang Bank hanya boleh diisi dengan huruf dan karakter!');
                $('#cabang_bank').val('');
                cabang_bank.focus;
            return false;
            }
        });

        $('.nama_bank').keyup(function() {
            var nama_bank = document.getElementById('nama_bank');
            var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

            if (!filter.test(nama_bank.value)) {
                alert('Nama Bank hanya boleh diisi dengan huruf dan karakter!');
                $('#nama_bank').val('');
                nama_bank.focus;
            return false;
            }
        });

        $('.atas_nama').keyup(function() {
            var atasnama_rekening = document.getElementById('atasnama_rekening');
            var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

            if (!filter.test(atasnama_rekening.value)) {
                alert('Atas Nama Rekening hanya boleh diisi dengan huruf dan karakter!');
                $('#atasnama_rekening').val('');
                atasnama_rekening.focus;
            return false;
            }
        });

        $('.tempat_lahir').keyup(function() {
            var tempat_lahir = document.getElementById('tempat_lahir');
            var filter = /^([a-zA-Z _\`\,\.\-\'])+$/;

            if (!filter.test(tempat_lahir.value)) {
                alert('Tempat Lahir hanya boleh diisi dengan huruf!');
                $('#tempat_lahir').val('');
                tempat_lahir.focus;
            return false;
            }
        });
    });
</script>