<?php if(count($data) > 0){ ?>
<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
        <td><?php echo $v->kode_pencairan; ?></td>
        <td><?php echo $v->nip; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td style="text-align:center;"><?php echo $v->semester; ?></td>
        <td style="text-align:right;"><?php echo $v->berhasil_transfer; ?></td>                                    
        <td class="td-actions">
            <a href="<?php echo base_url('keuangan/Pengeluaran/pencairanBiaya?id_pengajuan_biaya='.$v->id_pengajuan_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Pengeluaran"><i class="fa fa-list"> </i></a>
        </td>
    </tr>
<?php endforeach; ?>
<?php }else{ ?>
    <tr><td colspan="8">Data tidak ditemukan.</td></tr>
<?php } ?>