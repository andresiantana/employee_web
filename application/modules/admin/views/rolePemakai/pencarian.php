<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->username; ?></td>
        <td><?php echo $v->password; ?></td>
        <td><?php echo $v->nama_role; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/rolePemakai/edit/'.$v->id_user); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah User"><i class="fa fa-edit"> </i></a>
            <?php
                if($v->user_aktif == 1){
            ?>
                <a href="<?php echo base_url('admin/rolePemakai/block_aktif/'.$v->id_user.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir User" onclick="return confirm('Apakah anda yakin akan memblokir User ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('admin/rolePemakai/block_aktif/'.$v->id_user.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan User" onclick="return confirm('Apakah anda yakin akan mengaktifkan User ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>