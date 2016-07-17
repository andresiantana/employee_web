<?php foreach($data as $i=>$v): ?>
    <tr>
        <td><?php echo ($i+1); ?></td>
        <td><?php echo $v->nama_jenis_sertifikasi; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/jenisSertifikasi/edit/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Jenis Sertifikasi"><i class="fa fa-edit"> </i></a>
            <!-- <a href="<?php echo base_url('admin/jenisSertifikasi/hapus/'.$v->id_jenis_sertifikasi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a> -->
            <?php
                if($v->jenis_sertifikasi_aktif == 1){
            ?>
                <a href="<?php echo base_url('admin/jenisSertifikasi/block_aktif/'.$v->id_jenis_sertifikasi.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan memblokir Jenis Sertifikasi ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('admin/jenisSertifikasi/block_aktif/'.$v->id_jenis_sertifikasi.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan Jenis Sertifikasi" onclick="return confirm('Apakah anda yakin akan mengaktifkan Jenis Sertifikasi ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>