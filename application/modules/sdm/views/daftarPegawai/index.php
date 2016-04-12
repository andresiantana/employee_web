<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Daftar Pegawai
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>Tanggal Lahir</th>
                                <th>E-mail</th>
                                <th>No. Telp</th>
                                <th>Foto</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Atas Nama</th>
                                <th>Sertifikasi</th>
                                <th>Surat Studi Lanjut</th>
                                <th>Surat Lulus Seleksi</th>
                                <th>Surat Terima Beasiswa</th>
                                <th>Biaya SPP</th>
                                <th>Username</th>
                                <th class="td-actions">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $v->nama_lengkap; ?></td>
                                    <td><?php echo $v->nip; ?></td>
                                    <td><?php echo $v->nidn; ?></td>
                                    <td><?php echo $v->tanggal_lahir; ?></td>
                                    <td><?php echo $v->email; ?></td>
                                    <td><?php echo $v->no_telp; ?></td>
                                    <td><img src="<?php echo base_url().'data/images/'.$v->foto.'.jpg'; ?>" width="50px" height="50px"></td>
                                    <td><?php echo $v->fakultas; ?></td>
                                    <td><?php echo $v->prodi; ?></td>
                                    <td><?php echo $v->nama_bank; ?></td>
                                    <td><?php echo $v->nomor_rekening; ?></td>
                                    <td><?php echo $v->atasnama_rekening; ?></td>
                                    <td><?php echo $v->sertifikasi; ?></td>
                                    <td><?php echo $v->surat_studi_lanjut; ?></td>
                                    <td><?php echo $v->surat_lulus_seleksi; ?></td>
                                    <td><?php echo $v->surat_terima_beasiswa; ?></td>
                                    <td style="text-align:right;"><?php echo $v->username; ?></td>
                                    <td><?php echo $v->username; ?></td>
                                    <td class="td-actions">
                                        <a href="#" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Role"><i class="fa fa-edit"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>