<div class="row">                 
    <div class="col-md-12">
        <div class="panel panel-default">                            
            <div class="panel-heading" style="text-align:center;">
            Kirim Pemberitahuan
        </div>
        <div class="panel-body">
            <?php if(validation_errors()){ ?>
            <div class="alert alert-warning">
                <strong><?php echo validation_errors(); ?></strong>
            </div>              
            <?php } ?>
    
            <?php echo form_open_multipart("sdm/daftarPegawai/kirimNotifikasi"); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapegawai->id_pegawai) ? $datapegawai->id_pegawai : ""; ?>">
                    <div class="myOwnClass">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo isset($datapegawai->tanggal) ? date('Y-m-d',strtotime($datapegawai->tanggal)) : date('Y-m-d'); ?>" required> (Tahun-Bulan-Tanggal)
                    </div>
                </div>
                <div class="form-group">
                    <label>Isi Pesan</label>
                    <textarea class="form-control" name="isi_pesan" > </textarea>
                </div>                
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-success">Ulang</button>
                <a class="btn btn-danger" href="<?php echo base_url('sdm/DaftarPegawai'); ?>">Batal</a>
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
        $('#tanggal').datepicker({
            format:'dd/mm/yyyy',
        });
    });
</script>