<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Import Data Prodi
            </div>
            <div class="panel-body">
                <h3>Sebelum mengupload, pastikan file anda berformat .xls/.xlsx</h3>
                <br>
                <div class="row">
                    <?php echo form_open_multipart('admin/Prodi/do_upload',array('accept-charset'=>"utf-8"));  ?>         
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Unduh Format Prodi</label>
                            <td><a href="javascript:prd_download('prodi.xls')"><?php echo "prodi.xls"; ?></a></td>
                        </div>
                        <div class="form-group">
                            <label>File Prodi</label>
                            <input class="form-control" type="file" name="file" id="file">
                            <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Import</button>
                        <a class="btn btn-danger" href="<?php echo base_url('admin/Prodi'); ?>">Batal</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/template/Bluebox/assets/js/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">
function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('admin/Dashboard/file_download') ?>?file_name="+ file_name;
}
</script>