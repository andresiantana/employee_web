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
                <div class="form-group input-group">
                    <span class="input-group-addon">Nama Lengkap</span>
                    <input class="form-control" type="text" name="nama_lengkap" value="<?php echo isset($datapegawai->nama_lengkap) ? $datapegawai->nama_lengkap : ""; ?>">
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapegawai->id_pegawai) ? $datapegawai->id_pegawai : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">NIP</span>
                    <input class="form-control" type="text" name="nip" value="<?php echo isset($datapegawai->nip) ? $datapegawai->nip : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">NIDN</span>
                    <input class="form-control" type="text" name="nidn" value="<?php echo isset($datapegawai->nidn) ? $datapegawai->nidn : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Tanggal Lahir</span>
                    <input class="form-control" type="text" name="tanggal_lahir" value="<?php echo isset($datapegawai->tanggal_lahir) ? $datapegawai->tanggal_lahir : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">E-mail</span>
                    <input class="form-control" type="text" name="email" value="<?php echo isset($datapegawai->email) ? $datapegawai->email : ""; ?>" >
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">No. Telp</span>
                    <input class="form-control" type="text" name="no_telp" value="<?php echo isset($datapegawai->no_telp) ? $datapegawai->no_telp : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Foto</span>
                    <input class="form-control" type="file" name="foto" value="<?php echo isset($datapegawai->foto) ? $datapegawai->foto : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Profesi</span>
                    <input class="form-control" type="text" name="profesi" value="<?php echo isset($datapegawai->profesi) ? $datapegawai->profesi : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Fakultas</span>
                    <input class="form-control" type="text" name="fakultas" value="<?php echo isset($datapegawai->fakultas) ? $datapegawai->fakultas : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Prodi</span>
                    <input class="form-control" type="text" name="prodi" value="<?php echo isset($datapegawai->prodi) ? $datapegawai->prodi : ""; ?>">
                </div> 
                <div class="form-group input-group">
                    <span class="input-group-addon">Sertifikasi</span>
                    <input class="form-control" type="text" name="sertifikasi" value="<?php echo isset($datapegawai->sertifikasi) ? $datapegawai->sertifikasi : ""; ?>">
                </div> 
            </div>
            <div class="col-md-6">
                <legend>Data Rekening</legend>
                <div class="form-group input-group">
                    <span class="input-group-addon">Nama Bank</span>
                    <input class="form-control" type="text" name="nama_bank" value="<?php echo isset($datapegawai->nama_bank) ? $datapegawai->nama_bank : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Nomor Rekening</span>
                    <input class="form-control" type="text" name="nomor_rekening" value="<?php echo isset($datapegawai->nomor_rekening) ? $datapegawai->nomor_rekening : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Atas Nama</span>
                    <input class="form-control" type="text" name="atasnama_rekening" value="<?php echo isset($datapegawai->atasnama_rekening) ? $datapegawai->atasnama_rekening : ""; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <legend>Data Pengajuan</legend>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Pengajuan Studi Lanjut</span>
                    <input class="form-control" type="file" name="surat_studi_lanjut" value="<?php echo isset($datapegawai->surat_studi_lanjut) ? $datapegawai->surat_studi_lanjut : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Tanda Lulus Seleksi</span>
                    <input class="form-control" type="file" name="surat_lulus_seleksi" value="<?php echo isset($datapegawai->surat_lulus_seleksi) ? $datapegawai->surat_lulus_seleksi : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Tanda Penerimaan Beasiswa</span>
                    <input class="form-control" type="file" name="surat_terima_beasiswa" value="<?php echo isset($datapegawai->surat_terima_beasiswa) ? $datapegawai->surat_terima_beasiswa : ""; ?>">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Biaya SPP</span>
                    <input class="form-control" type="text" name="biaya_spp" value="<?php echo isset($datapegawai->biaya_spp) ? $datapegawai->biaya_spp : ""; ?>">
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