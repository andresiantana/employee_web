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
    
            <?php echo form_open_multipart("pegawai/DataPegawai/insert"); ?>
            <div class="col-md-6">
                <legend>Data Pegawai</legend>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama_lengkap" value="<?php echo isset($datapegawai->nama_lengkap) ? $datapegawai->nama_lengkap : ""; ?>">
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapegawai->id_pegawai) ? $datapegawai->id_pegawai : ""; ?>">
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input class="form-control" type="text" name="nip" value="<?php echo isset($datapegawai->nip) ? $datapegawai->nip : ""; ?>">
                </div>
                <div class="form-group">
                    <label>NIDN</label>
                    <input class="form-control" type="text" name="nidn" value="<?php echo isset($datapegawai->nidn) ? $datapegawai->nidn : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="text" class="span3" value="<?php echo isset($datapegawai->tanggal_lahir) ? date('d/m/Y',strtotime($datapegawai->tanggal_lahir)) : date('d/m/Y'); ?>" required>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="text" onblur='validasiEmail();' name="email" id="email" value="<?php echo isset($datapegawai->email) ? $datapegawai->email : ""; ?>" >
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input class="form-control" type="text" name="no_telp" value="<?php echo isset($datapegawai->no_telp) ? $datapegawai->no_telp : ""; ?>">
                </div>
                <div class="form-group">
                    <label>No. Handphone</label>
                    <input class="form-control" type="text" name="no_hp" value="<?php echo isset($datapegawai->no_hp) ? $datapegawai->no_hp : ""; ?>">
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
                        <select class="form-control" name="kode_fakultas" id="kode_fakultas" onChange="setProdi();">
                            <option value="">-Pilih Fakultas-</option>
                            <?php foreach ($fakultas as $i => $val) { ?>
                                <option value="<?php echo $val->kode_fakultas; ?>"><?php echo $val->nama_fakultas; ?></option>
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
                <div class="form-group">
                    <label>Lokasi Pendidikan</label>
                    <select class="form-control" name="nama_lokasi" id="nama_lokasi" onchange="setLokasiPendidikan(this);">
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
            </div>
            <div class="col-md-6">
                <legend>Data Rekening</legend>
                <div class="form-group ">
                    <label>Nama Bank</label>
                    <input class="form-control" type="text" name="nama_bank" value="<?php echo isset($datapegawai->nama_bank) ? $datapegawai->nama_bank : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Cabang Bank</label>
                    <select class="form-control" name="id_cabang_bank">
                        <option value="">-Pilih Cabang-</option>
                        <?php foreach ($cabang_bank as $i => $val) { ?>
                            <option value="<?php echo $val->id_cabang_bank; ?>"><?php echo $val->nama_cabang; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group ">
                    <label>Nomor Rekening</label>
                    <input class="form-control" type="text" name="nomor_rekening" value="<?php echo isset($datapegawai->nomor_rekening) ? $datapegawai->nomor_rekening : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Atas Nama</label>
                    <input class="form-control" type="text" name="atasnama_rekening" value="<?php echo isset($datapegawai->atasnama_rekening) ? $datapegawai->atasnama_rekening : ""; ?>">
                </div>
            </div>
            <div class="col-md-6">
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
                    <label>Biaya SPP</label>
                    <input class="form-control numbers-only" type="text" name="biaya_spp" value="<?php echo isset($datapegawai->biaya_spp) ? $datapegawai->biaya_spp : ""; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <legend>Data Sertifikasi</legend>
                <table class="table table-striped table-bordered table-hover" id="tabel-sertifikasi">
                    <thead>
                        <tr>
                            <th>Jenis Sertifikasi</th>
                            <th>Penyelenggara</th>
                            <th>Skor</th>
                            <th>Upload</th>
                            <th class="td-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                            <td><select class="form-control jenis_sertifikasi" name="sertifikasi[0][id_jenis_sertifikasi]">
                                    <option value="">-Pilih Jenis Sertifikasi-</option>
                                    <?php foreach ($jenis_sertifikasi as $i => $val) { ?>
                                    <option value="<?php echo $val->id_jenis_sertifikasi; ?>"><?php echo $val->nama_jenis_sertifikasi; ?></option>
                                    <?php } ?>
                                </select></td>
                            <td><input id="sertifikasi_0_penyelenggara" type="text" name="sertifikasi[0][penyelenggara]" class="form-control" ></td>
                            <td><input id="sertifikasi_0_skor" name="sertifikasi[0][skor]" type="text" class="form-control"></td>
                            <td><input id="sertifikasi_0_upload" name="sertifikasi[0][upload]" type="file" class="form-control"></td>
                            <td class="td-actions">
                                <a href="#" class="btn btn-small btn-success" onclick="tambahSertifikasi();"><i class="fa fa-plus"> </i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    function setLokasiPendidikan(obj){
        var nama_lokasi = obj.value;
        
        $.ajax({
           type: 'POST',
           data: "nama_lokasi="+nama_lokasi,
           url: '<?php echo base_url('pegawai/DataPegawai/dropDownUniversitas'); ?>',
           success: function(result) {
            $('#tampil_universitas').html(result);       }
        });

    }

    function setProdi(){
        var kode_fakultas = $('#kode_fakultas').val();
        
        $.ajax({
           type: 'POST',
           data: "kode_fakultas="+kode_fakultas,
           url: '<?php echo base_url('pegawai/DataPegawai/dropDownProdi'); ?>',
           success: function(result) {
            $('#tampil_prodi').html(result);       }
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
        }else{
            $('#dosen').attr('style','display:none;');
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
            }
        }
        var fakultas = '<?php echo isset($datapegawai->kode_fakultas) ? $datapegawai->kode_fakultas : ""; ?>';
        if(fakultas != ''){
            $('#kode_fakultas').val(fakultas);
            setProdi()
        }
        var id_prodi = '<?php echo isset($datapegawai->id_prodi) ? $datapegawai->id_prodi : ""; ?>';
        if(id_prodi != ''){
            $('#id_prodi').val(id_prodi);
        }
        $('#tanggal_lahir').datepicker({
            format:'dd/mm/yyyy',
        });

        $('.numbers-only').keyup(function() {
            console.log("a");
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