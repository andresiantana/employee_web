<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Lokasi Pendidikan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/LokasiPendidikan/update');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label>Nama Lokasi</label>
                                <select name="nama_lokasi" id="nama_lokasi" class="form-control">
                                    <option value="">--Pilih Lokasi--</option>
                                    <option value="Dalam Negeri">Dalam Negeri</option>
                                    <option value="Luar Negeri">Luar Negeri</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Universitas</label>
                                <input type="hidden" class="form-control" name="id_lokasi" type="text" value="<?php echo $editdata->id_lokasi; ?>">
                                <input class="form-control" name="nama_universitas" type="text" placeholder="Isikan Nama Lengkap" value="<?php echo $editdata->nama_universitas; ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" ><?php echo $editdata->nama_universitas; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telp</label>
                                <input class="form-control" name="no_telp" type="text" value="<?php echo $editdata->no_telp; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/LokasiPendidikan'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){        
        var nama_lokasi = '<?php echo $editdata->nama_lokasi; ?>';
        if(nama_lokasi != ''){
            $('#nama_lokasi').val(nama_lokasi);
        }
    });
</script>