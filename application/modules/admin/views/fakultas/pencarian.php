<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->kode_fakultas; ?></td>
        <td><?php echo $v->nama_fakultas; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/Fakultas/edit/'.$v->kode_fakultas); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Fakultas"><i class="fa fa-edit"> </i></a>
            <a href="<?php echo base_url('admin/Fakultas/hapus/'.$v->kode_fakultas); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Fakultas" onclick="return confirm('Apakah anda yakin akan menghapus fakultas ini ?')"><i class="fa fa-times"> </i></a>
        </td>
    </tr>
<?php endforeach; ?>