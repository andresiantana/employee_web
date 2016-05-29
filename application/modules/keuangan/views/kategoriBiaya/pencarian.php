<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->nama_kategori; ?></td>
        <td><?php echo ($v->status_aktif == true) ? "Aktif" : "Tidak Aktif" ; ?></td>
        <td class="td-actions">
            <a href="<?php echo base_url('keuangan/kategoriBiaya/edit/'.$v->id_kategori_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Kategori Biaya"><i class="fa fa-edit"> </i></a>
            <?php
                if($v->status_aktif == 1){
            ?>
                <a href="<?php echo base_url('keuangan/kategoriBiaya/block_aktif/'.$v->id_kategori_biaya.'?aksi=block'); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk blokir kategori biaya" onclick="return confirm('Apakah anda yakin akan memblokir kategori biaya ini ?')"><i class="fa fa-ban"> </i></a>
            <?php } else { ?>
                <a href="<?php echo base_url('keuangan/kategoriBiaya/block_aktif/'.$v->id_kategori_biaya.'?aksi=aktif'); ?>" class="btn btn-small btn-info" rel="tooltip" title="Klik untuk aktifkan kategori biaya" onclick="return confirm('Apakah anda yakin akan mengaktifkan kategori biaya ini ?')"><i class="fa fa-check"> </i></a>
            <?php } ?>
            <a href="<?php echo base_url('keuangan/kategoriBiaya/hapus/'.$v->id_kategori_biaya); ?>" class="btn btn-small btn-danger" rel="tooltip" title="Klik untuk hapus Kategori Biaya" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa fa-times"> </i></a>
        </td>
    </tr>
<?php endforeach; ?>