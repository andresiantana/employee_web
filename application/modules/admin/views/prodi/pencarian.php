<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->kode_fakultas; ?></td>
        <td><?php echo $v->nama_fakultas; ?></td>
        <td><?php echo $v->kode_prodi; ?></td>
        <td><?php echo $v->nama_prodi; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('admin/Prodi/edit/'.$v->id_prodi); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Prodi"><i class="fa fa-edit"> </i></a>
            <a href="<?php echo base_url('admin/Prodi/hapus/'.$v->id_prodi); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Prodi" onclick="return confirm('Apakah anda yakin akan menghapus prodi ini ?')"><i class="fa fa-times"> </i></a>
        </td>
    </tr>
<?php endforeach; ?>