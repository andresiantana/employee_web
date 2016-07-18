<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->nama_lokasi; ?></td>
        <td><?php echo $v->nama_universitas; ?></td>
        <td><?php echo $v->alamat; ?></td>
        <td><?php echo $v->no_telp; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/lokasiPendidikan/edit/'.$v->id_lokasi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Lokasi Pendidikan"><i class="fa fa-edit"> </i></a>
            <!-- <a href="<?php echo base_url('admin/lokasiPendidikan/hapus/'.$v->id_lokasi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Lokasi Pendidikan" onclick="return confirm('Apakah anda yakin akan menghapus lokasi pendidikan ini ?')"><i class="fa fa-times"> </i></a> -->
            <?php
                if($v->lokasi_aktif == 1){
            ?>
                <a href="<?php echo base_url('admin/lokasiPendidikan/block_aktif/'.$v->id_lokasi.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Lokasi Pendidikan" onclick="return confirm('Apakah anda yakin akan memblokir Lokasi Pendidikan ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('admin/lokasiPendidikan/block_aktif/'.$v->id_lokasi.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Lokasi Pendidikan" onclick="return confirm('Apakah anda yakin akan mengaktifkan Lokasi Pendidikan ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>