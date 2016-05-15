<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Jenis Sertifikasi
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Jenis Sertifikasi</th>
                                <th class="td-actions">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $i=>$v): ?>
                                <tr>
                                    <td><?php echo ($i+1); ?></td>
                                    <td><?php echo $v->nama_jenis_sertifikasi; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/jenisSertifikasi/edit/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Jenis Sertifikasi"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/jenisSertifikasi/hapus/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>  
                <br>              
                <a class="btn btn-primary" href="<?php echo base_url('admin/jenisSertifikasi/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Jenis Sertifikasi</a>
            </div>
        </div>
    </div>
</div>
