<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transaksi Pengajuan Biaya
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('pegawai/PengajuanBiaya/insert');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <div class="form-group">
                                <label for="kode_pengajuan">Kode Pengajuan</label>
                                <input class="form-control" type="text" name="kode_pengajuan" placeholder="Isikan Kode Pengajuan" value="<?php echo isset($kode_pengajuan) ? $kode_pengajuan : ""; ?>" readonly=true required>
                                <input class="form-control" type="hidden" name="id_pengajuan_biaya" value="<?php echo isset($datapengajuan->id_pengajuan_biaya) ? $datapengajuan->id_pengajuan_biaya : ""; ?>" readonly=true required>
                            </div>
                             <div class="form-group">
                                <label>Tanggal</label>
                                <input class="form-control" id="tanggal" name="tanggal" type="text" class="span3" value="<?php echo isset($datapengajuan->tanggal) ? date('d/m/Y',strtotime($datapengajuan->tanggal)) : ""; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori Biaya</label>
                                <select class="form-control" name="id_kategori_biaya" id="id_kategori_biaya">
                                    <option value="">-Pilih Kategori Biaya-</option>
                                    <?php foreach ($kategori as $i => $val) { ?>
                                        <option value="<?php echo $val->id_kategori_biaya; ?>"><?php echo $val->nama_kategori; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilih Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                    <option value="">-Pilih Semester-</option>
                                    <?php for ($i = 0; $i < 8; $i++) { ?>
                                        <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_nominal">Jumlah Nominal</label>
                                <input class="form-control numbers-only" type="text" name="jumlah_nominal" value="<?php echo isset($datapengajuan->jumlah_nominal) ? $datapengajuan->jumlah_nominal : ""; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('pegawai/PengajuanBiaya'); ?>">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script src="<?php echo base_url('assets/template/Bluebox/assets/datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript">    
    $(document).ready(function(){  
        var id_kategori_biaya = '<?php echo isset($datapengajuan->id_kategori_biaya) ? $datapengajuan->id_kategori_biaya : ""; ?>';
        if(id_kategori_biaya != ""){           
            $('#id_kategori_biaya').val(id_kategori_biaya);
        }

        var semester = '<?php echo isset($datapengajuan->semester) ? $datapengajuan->semester : ""; ?>';
        if(semester != ""){           
            $('#semester').val(semester);
        }

        $('#tanggal').datepicker({
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