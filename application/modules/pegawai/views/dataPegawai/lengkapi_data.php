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
                    <input class="form-control" type="text" name="email" value="<?php echo isset($datapegawai->email) ? $datapegawai->email : ""; ?>" >
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input class="form-control" type="text" name="no_telp" value="<?php echo isset($datapegawai->no_telp) ? $datapegawai->no_telp : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Foto</label> 
                    <input class="form-control" type="file" name="foto">
                </div>
                <div class="form-group ">
                    <label>Profesi</label>
                    <input class="form-control" type="text" name="profesi" value="<?php echo isset($datapegawai->profesi) ? $datapegawai->profesi : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Fakultas</label>
                    <input class="form-control" type="text" name="fakultas" value="<?php echo isset($datapegawai->fakultas) ? $datapegawai->fakultas : ""; ?>">
                </div>
                <div class="form-group ">
                    <label>Prodi</label>
                    <input class="form-control" type="text" name="prodi" value="<?php echo isset($datapegawai->prodi) ? $datapegawai->prodi : ""; ?>">
                </div> 
                <div class="form-group ">
                    <label>Sertifikasi</label>
                    <input class="form-control" type="text" name="sertifikasi" value="<?php echo isset($datapegawai->sertifikasi) ? $datapegawai->sertifikasi : ""; ?>">
                </div> 
            </div>
            <div class="col-md-6">
                <legend>Data Rekening</legend>
                <div class="form-group ">
                    <label>Nama Bank</label>
                    <input class="form-control" type="text" name="nama_bank" value="<?php echo isset($datapegawai->nama_bank) ? $datapegawai->nama_bank : ""; ?>">
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
                    <input class="form-control" type="file" name="surat_studi_lanjut">
                </div>
                <div class="form-group ">
                    <label>Surat Tanda Lulus Seleksi</label>
                    <input class="form-control" type="file" name="surat_lulus_seleksi">
                </div>
                <div class="form-group ">
                    <label>Surat Tanda Penerimaan Beasiswa</label>
                    <input class="form-control" type="file" name="surat_terima_beasiswa">
                </div>
                <div class="form-group ">
                    <label>Biaya SPP</label>
                    <input class="form-control numbers-only" type="text" name="biaya_spp" value="<?php echo isset($datapegawai->biaya_spp) ? $datapegawai->biaya_spp : ""; ?>">
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
    $(document).ready(function(){     
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