<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Coa
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Akun</th>
                                <th>Nama Akun</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->no_akun; ?></td>
                                    <td><?php echo $v->nama_akun; ?></td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url('keuangan/Coa/edit/'.$v->no_akun); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Akun"><i class="fa fa-edit"> </i></a>
                                        <a href="<?php echo base_url('keuangan/Coa/hapus/'.$v->no_akun); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Akun" onclick="return confirm('Apakah anda yakin akan menghapus Akun ini ?')"><i class="fa fa-times"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('keuangan/Coa/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Coa</a>                
            </div>
        </div>
    </div>
</div>