<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->kode_fakultas; ?></td>
        <td><?php echo $v->nama_fakultas; ?></td>
        <td><?php echo $v->kode_prodi; ?></td>
        <td><?php echo $v->nama_prodi; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/Prodi/edit/'.$v->id_prodi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Prodi"><i class="fa fa-edit"> </i></a>
            <!-- <a href="<?php echo base_url('admin/Prodi/hapus/'.$v->id_prodi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Prodi" onclick="return confirm('Apakah anda yakin akan menghapus prodi ini ?')"><i class="fa fa-times"> </i></a> -->
            <?php
                if($v->status_aktif == 1){
            ?>
                <a href="<?php echo base_url('admin/prodi/block_aktif/'.$v->id_prodi.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Prodi" onclick="return confirm('Apakah anda yakin akan memblokir Prodi ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('admin/prodi/block_aktif/'.$v->id_prodi.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Prodi" onclick="return confirm('Apakah anda yakin akan mengaktifkan Prodi ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>