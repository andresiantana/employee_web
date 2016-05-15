<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ubah Prodi
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
                                <label>Fakultas</label>
                                <select class="form-control" name="id_fakultas" id="id_fakultas">
                                    <option value="">-Pilih Fakultas-</option>
                                    <?php foreach ($fakultas as $i => $val) { ?>
                                        <option value="<?php echo $val->id_fakultas; ?>"><?php echo $val->nama_fakultas; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode Prodi</label>
                                <input type="hidden" class="form-control" name="id_prodi" type="text" value="<?php echo $editdata->id_prodi; ?>">
                                <input class="form-control" name="kode_prodi" type="text" placeholder="Isikan Kode Prodi" value="<?php echo $editdata->kode_prodi; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Prodi</label>
                                <input class="form-control" name="nama_prodi" type="text" value="<?php echo $editdata->nama_prodi; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/Prdi'); ?>">Batal</a>
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
        var id_fakultas = '<?php echo $editdata->id_fakultas; ?>';
        if(id_fakultas != ''){
            $('#id_fakultas').val(id_fakultas);
        }
    });
</script>