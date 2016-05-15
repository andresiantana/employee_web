<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Fakultas
            </div>
            <div class="panel-body">                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Fakultas</th>
                                <th>Nama Fakultas</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->kode_fakultas; ?></td>
                                    <td><?php echo $v->nama_fakultas; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/Fakultas/edit/'.$v->id_fakultas); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Fakultas"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/Fakultas/hapus/'.$v->id_fakultas); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Fakultas" onclick="return confirm('Apakah anda yakin akan menghapus fakultas ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('admin/Fakultas/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Fakultas</a>                
            </div>
        </div>
    </div>
</div>