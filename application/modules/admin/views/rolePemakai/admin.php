<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Role Pemakai
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama Role</th>
                                <th class="td-actions">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $v): ?>
                                <tr>
                                    <td><?php echo $v->username; ?></td>
                                    <td><?php echo $v->nama_role; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/rolePemakai/edit/'.$v->username); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Role"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/rolePemakai/hapus/'.$v->username); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Role" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
