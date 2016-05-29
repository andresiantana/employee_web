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