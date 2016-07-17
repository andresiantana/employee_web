<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->kode_fakultas; ?></td>
        <td><?php echo $v->nama_fakultas; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/Fakultas/edit/'.$v->kode_fakultas); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Fakultas"><i class="fa fa-edit"> </i></a>
            <!-- <a href="<?php echo base_url('admin/Fakultas/hapus/'.$v->kode_fakultas); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Fakultas" onclick="return confirm('Apakah anda yakin akan menghapus fakultas ini ?')"><i class="fa fa-times"> </i></a> -->
            <?php
                if($v->status_aktif == 1){
            ?>
                <a href="<?php echo base_url('admin/Fakultas/block_aktif/'.$v->kode_fakultas.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Fakultas" onclick="return confirm('Apakah anda yakin akan memblokir Fakultas ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('admin/Fakultas/block_aktif/'.$v->kode_fakultas.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Fakultas" onclick="return confirm('Apakah anda yakin akan mengaktifkan Fakultas ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>