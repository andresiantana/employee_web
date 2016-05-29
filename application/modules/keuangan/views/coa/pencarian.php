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