<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Cabang Bank
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:10%"><label>Nama Cabang Bank</label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%">
                                <input type="text"  class="form-control" id="nama_cabang" name="nama_cabang">
                            </td>

                            <td style="width:9%"></td>

                            <td style="width:10%"><label></label></td>
                            <td style="width:1%;"></td>
                            <td style="width:30%"></td>
                        </tr>
                    </table>
                    <br>
                    <a href='javascript:void(0);' onclick="setPencarian();" class="btn btn-small btn-success"><i class="fa fa-search"> </i> Cari</a>
                    <a href='<?php echo base_url('keuangan/cabangBank/index'); ?>' class="btn btn-small btn-info"><i class="fa fa-refresh"> </i> Ulangi</a>
                    <br><br>

                    <table class="table table-striped table-bordered table-hover" id="data-cabang">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Cabang Bank</th>
                                <th class="td-actions" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0){ ?>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->nama_cabang; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('keuangan/CabangBank/edit/'.$v->id_cabang_bank); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Cabang Bank"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('keuangan/CabangBank/hapus/'.$v->id_cabang_bank); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Cabang Bank" onclick="return confirm('Apakah anda yakin akan menghapus Cabang Bank ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <tr><td colspan="3">Data tidak ditemukan.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo isset($halaman) ? "Halaman" : ""; ?> :  <div class="halaman"><?php echo $halaman;?></div>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('keuangan/CabangBank/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Cabang Bank</a>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setPencarian(){
        var nama_cabang = $('#nama_cabang').val();

        var data = {
          nama_cabang: nama_cabang
        }

        $.ajax({
            url     : "<?php echo base_url('keuangan/cabangBank/index'); ?>",
            type    : "POST",
            data    : data,
            dataType: 'json',
            success : function (data) {
              $('#data-cabang > tbody').html(data);
            }
        });
    }
</script>