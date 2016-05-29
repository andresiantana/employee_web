<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Role
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID Role</th>
                                <th>Nama Role</th>
                                <th class="td-actions" style="width:150px;">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $v): ?>
                                <tr>
                                    <td><?php echo $v->id_role; ?></td>
                                    <td><?php echo $v->nama_role; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/role/edit/'.$v->id_role); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Role"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/role/hapus/'.$v->id_role); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Role" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    Halaman :  <div class="halaman"><?php echo $halaman;?></div>
                </div>  
                <br>              
                <a class="btn btn-primary" href="<?php echo base_url('admin/role/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Role</a>
            </div>
        </div>
    </div>
</div>
