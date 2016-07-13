<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Transaksi Pencairan Biaya
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('keuangan/PengajuanBiaya/insert_pencairan',array('onsubmit'=>'return checkFormat();'));  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <legend>Data Pegawai</legend>
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input class="form-control" type="text" name="nip" value="<?php echo isset($datapegawai->nip) ? $datapegawai->nip : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Pegawai</label>
                                <input class="form-control" type="text" name="nama_pegawai" value="<?php echo isset($datapegawai->nama_lengkap) ? $datapegawai->nama_lengkap : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label for="status_pegawai">Status Pegawai</label>
                                <input class="form-control" type="text" name="status_pegawai" value="<?php echo isset($datapegawai->status_pegawai) ? $datapegawai->status_pegawai : ""; ?>" readonly=true required>
                            </div>

                            <?php if($datapegawai->status_pegawai == 'DOSEN'){ ?>
                            <div class="form-group">
                                <label for="nama_fakultas">Fakultas Asal</label>
                                <input class="form-control" type="text" name="nama_fakultas" value="<?php echo isset($datapegawai->nama_fakultas) ? $datapegawai->nama_fakultas : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label for="nama_prodi">Prodi</label>
                                <input class="form-control" type="text" name="nama_prodi" value="<?php echo isset($datapegawai->nama_prodi) ? $datapegawai->nama_prodi : ""; ?>" readonly=true required>
                            </div>
                            <?php }else{ ?>
                            <div class="form-group">
                                <label for="nama_fakultas">Unit Kerja</label>
                                <input class="form-control" type="text" name="nama_fakultas_tpa" value="<?php echo isset($datapegawai->nama_fakultas) ? $datapegawai->nama_fakultas : ""; ?>" readonly=true required>
                            </div>
                            <?php } ?>

                            <legend> Data Pengajuan Biaya </legend>
                            <div class="form-group">
                                <label for="kode_pengajuan">Kode Pengajuan</label>
                                <input class="form-control" type="text" name="kode_pengajuan" placeholder="Isikan Kode Pengajuan" value="<?php echo isset($datapengajuan->kode_pengajuan) ? $datapengajuan->kode_pengajuan : ""; ?>" readonly=true required>
                                <input class="form-control" type="hidden" name="id_pengajuan_biaya" value="<?php echo isset($datapengajuan->id_pengajuan_biaya) ? $datapengajuan->id_pengajuan_biaya : ""; ?>" readonly=true required>
                                <input class="form-control" type="hidden" name="id_pegawai" value="<?php echo isset($datapengajuan->id_pegawai) ? $datapengajuan->id_pegawai : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                <input class="form-control" type="text" name="tanggal" placeholder="Isikan Tanggal" value="<?php echo isset($datapengajuan->tanggal) ? date('d/m/Y',strtotime($datapengajuan->tanggal)) : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label>Pilih Semester</label>
                                <select class="form-control" name="semester" id="semester" disabled>
                                    <option value="">-Pilih Semester-</option>
                                    <?php for ($i = 0; $i < 8; $i++) { ?>
                                        <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_nominal">Jumlah Nominal</label>
                                <input class="form-control integer" type="text" name="jumlah_nominal" value="<?php echo isset($datapengajuan->jumlah_nominal) ? $datapengajuan->jumlah_nominal : ""; ?>" readonly=true required style="text-align:right;width:150px;">
                            </div>

                            <legend> Data Pencairan Biaya </legend>
                            <div class="form-group">
                                <label for="kode_pencairan">Kode Pencairan</label>
                                <input class="form-control" type="text" name="kode_pencairan" placeholder="Isikan Kode Pencairan" value="<?php echo isset($kode_pencairan) ? $kode_pencairan : ""; ?>" readonly=true required>
                                <input class="form-control" type="hidden" name="id_pencairan_biaya" value="<?php echo isset($datapencairan->id_pencairan_biaya) ? $datapencairan->id_pencairan_biaya : ""; ?>" readonly=true required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pencairan</label>
                                <div class="myOwnClass">
                                    <input type="text" class="form-control"  id="tanggal_pencairan" name="tanggal_pencairan" value="<?php echo isset($datapencairan->tanggal_pencairan) ? date('Y-m-d',strtotime($datapencairan->tanggal_pencairan)) : date('Y-m-d'); ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Jumlah Biaya</label>
                                <input class="form-control integer" id="jumlah_biaya" name="jumlah_biaya" type="text" class="span3" value="<?php echo isset($uraian->nominal_disetujui) ? $uraian->nominal_disetujui : ""; ?>" readonly=true required style="text-align:right;width:150px;">
                            </div>


                            <div class="form-group">
                                <label>Jumlah Berhasil Transfer</label>
                                <input class="form-control integer" id="berhasil_transfer" name="berhasil_transfer" type="text" class="span3" value="<?php echo isset($uraian->nominal_disetujui) ? $uraian->nominal_disetujui : ""; ?>" onblur="setJmlBerhasil(this);" required style="text-align:right;width:150px;">                                        
                            </div>
                            
                            <div class="form-group">
                                <label>Jumlah Gagal Transfer</label>
                                <input class="form-control integer" id="gagal_transfer" name="gagal_transfer" type="text" class="span3" value="<?php echo isset($datapengajuan->gagal_transfer) ? $datapengajuan->gagal_transfer : ""; ?>" onblur="setJmlGagal(this);"  value="0" required style="text-align:right;width:150px;">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"><?php echo isset($datapencairan->keterangan) ? $datapencairan->keterangan : ""; ?> </textarea>
                            </div>
                            <?php
                                if(isset($_GET['id']) && isset($_GET['id_pengajuan_biaya'])){
                            ?>
                                <button type="submit" class="btn btn-primary" disabled=true>Cairkan</button>
                                <button type="button" class="btn btn-info" onclick="print('PRINT');"><i class="fa fa-print"></i> Cetak </button>
                            <?php }else{ ?>
                                <button type="submit" class="btn btn-primary">Cairkan</button>
                            <button type="button" class="btn btn-info" onclick="print('PRINT');" disabled=true><i class="fa fa-print"></i> Cetak </button>
                            <?php } ?>
                            <button type="reset" class="btn btn-success">Reset</button>
                            <a class="btn btn-danger" href="<?php echo base_url('keuangan/PengajuanBiaya'); ?>">Batal</a>
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
    function setJmlBerhasil(obj){
        unformatNumberSemua();
        var jml_biaya = parseFloat($('#jumlah_biaya').val());
        var jml_berhasil = parseFloat($('#berhasil_transfer').val());
        var jml_gagal = parseFloat($('#gagal_transfer').val());

        if(!jQuery.numeric(jml_berhasil)){
            $('#berhasil_transfer').val(0);
            $('#gagal_transfer').val(0);
        }
        if(jml_berhasil > jml_biaya){
            alert("Jumlah berhasil transfer tidak boleh lebih dari Jumlah Biaya");
            return false;
        }else{
            jml_berhasil = jml_berhasil;
            jml_gagal = jml_biaya - jml_berhasil;
        }


        $('#berhasil_transfer').val(jml_berhasil);
        $('#gagal_transfer').val(jml_gagal);
        formatNumberSemua();
    }

    function setJmlGagal(obj){
        unformatNumberSemua();
        var jml_biaya = parseFloat($('#jumlah_biaya').val());
        var jml_berhasil = parseFloat($('#berhasil_transfer').val());
        var jml_gagal = parseFloat($('#gagal_transfer').val());

        if(jml_gagal > jml_biaya){
            alert("Jumlah berhasil transfer tidak boleh lebih dari Jumlah Biaya");
            return false;
        }else{
            jml_berhasil = jml_biaya - jml_gagal;
            jml_gagal = jml_gagal;
        }
        $('#berhasil_transfer').val(jml_berhasil);
        $('#gagal_transfer').val(jml_gagal);
        formatNumberSemua();
    }
    function print(caraPrint)
    {
        var id_pencairan_biaya = '<?php echo isset($datapencairan->id_pencairan_biaya) ? $datapencairan->id_pencairan_biaya : null; ?>';
        window.open('<?php echo base_url('keuangan/PengajuanBiaya/printPencairanBiaya/'); ?>/'+id_pencairan_biaya,'printwin','left=100,top=100,width=1000,height=640');
    }

    $(document).ready(function(){  
        var id_kategori_biaya = '<?php echo isset($datapengajuan->id_kategori_biaya) ? $datapengajuan->id_kategori_biaya : ""; ?>';
        if(id_kategori_biaya != ""){           
            $('#id_kategori_biaya').val(id_kategori_biaya);
        }

        var semester = '<?php echo isset($datapengajuan->semester) ? $datapengajuan->semester : ""; ?>';
        if(semester != ""){           
            $('#semester').val(semester);
        }

        var jumlah_biaya = '<?php echo isset($uraian->nominal_disetujui) ? $uraian->nominal_disetujui: ""; ?>';
        if(jumlah_biaya != ""){           
            $('#berhasil_transfer').val(jumlah_biaya);
            $('#gagal_transfer').val(0);
        }else{
            $('#berhasil_transfer').val(0);
            $('#gagal_transfer').val(0);
        }

        $('#tanggal').datepicker({
            format:'dd/mm/yyyy',
        });

        $('#tanggal_pencairan').datepicker({
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