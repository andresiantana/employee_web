<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel User
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->username; ?></td>
                                    <td><?php echo $v->password; ?></td>
                                    <td><?php echo $v->nama_role; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('admin/rolePemakai/edit/'.$v->username); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Role"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('admin/rolePemakai/hapus/'.$v->username); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir user" onclick="return confirm('Apakah anda yakin akan memblokir user ini ?')"><i class="fa fa-ban"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-primary" href="<?php echo base_url('admin/rolePemakai/tambah'); ?>"><i class="fa fa-plus"></i> Tambah User</a>                
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
