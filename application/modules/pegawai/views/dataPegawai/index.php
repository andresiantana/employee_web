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
    
            <?php echo form_open("pegawai/registrasi/register_proses"); ?>
            <div class="col-md-6">
                <legend>Data Pegawai</legend>
                <div class="form-group input-group">
                    <span class="input-group-addon">Nama Lengkap</span>
                    <input class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">NIP</span>
                    <input class="form-control" name="nip" placeholder="NIP">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">NIDN</span>
                    <input class="form-control" name="nidn" placeholder="NIDN">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Tanggal Lahir</span>
                    <input class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">E-mail</span>
                    <input class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">No. Telp</span>
                    <input class="form-control" name="no_telp" placeholder="No. Telp">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Foto</span>
                    <input class="form-control" type="file" name="foto" placeholder="Foto">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Profesi</span>
                    <input class="form-control" name="profesi" placeholder="Profesi">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Fakultas</span>
                    <input class="form-control" name="fakultas" placeholder="Fakultas">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Prodi</span>
                    <input class="form-control" name="prodi" placeholder="Sertifikasi">
                </div> 
                <div class="form-group input-group">
                    <span class="input-group-addon">Sertifikasi</span>
                    <input class="form-control" name="sertifikasi" placeholder="Sertifikasi">
                </div> 
            </div>
            <div class="col-md-6">
                <legend>Data Rekening</legend>
                <div class="form-group input-group">
                    <span class="input-group-addon">Nama Bank</span>
                    <input class="form-control" name="nama_bank" placeholder="Nama Bank">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Nomor Rekening</span>
                    <input class="form-control" name="nomor_rekening" placeholder="Nomor Rekening">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Atas Nama</span>
                    <input class="form-control" name="atasnama_rekening" placeholder="Atas Nama">
                </div>
            </div>
            <div class="col-md-6">
                <legend>Data Pengajuan</legend>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Pengajuan Studi Lanjut</span>
                    <input class="form-control" type="file" name="surat_studi_lanjut" placeholder="Surat Pengajuan Studi Lanjut">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Tanda Lulus Seleksi</span>
                    <input class="form-control" type="file" name="surat_lulus_seleksi" placeholder="Surat Tanda Lulus Seleksi">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Surat Tanda Penerimaan Beasiswa</span>
                    <input class="form-control" type="file" name="surat_terima_beasiswa" placeholder="Surat Tanda Penerimaan Beasiswa">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Biaya SPP</span>
                    <input class="form-control" name="biaya_spp" placeholder="Biaya SPP">
                </div>
            </div>
            <div class="col-md-12">
                <button class="button btn btn-primary btn-large" type="submit">Simpan</button>
                <button class="button btn btn-primary btn-large" type="reset">Reset</button> 
            </div>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12"></div>      
</div>  