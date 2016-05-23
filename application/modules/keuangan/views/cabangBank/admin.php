<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Cabang Bank
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Cabang Bank</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
                <br>
                <a class="btn btn-primary" href="<?php echo base_url('keuangan/CabangBank/tambah'); ?>"><i class="fa fa-plus"></i> Tambah Cabang Bank</a>                
            </div>
        </div>
    </div>
</div>