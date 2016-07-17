<?php if (count($data) > 0) { ?>
<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td><?php echo $v->nip; ?></td>
        <td><?php echo 'Rp '.number_format($amortisasi).',00'; ?></td>
        <td class="td-actions">
            <a href="#detail" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Amortisasi" onclick="setIdPencairan(<?php echo $v->id_pegawai; ?>);"><i class="fa fa-list"> </i></a>
        </td>
        <!-- <td class="td-actions">
            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Cetak Rincian Amortisasi" onclick="print('PRINT',<?php echo $v->id_pegawai; ?>);"><i class="fa fa-print"> </i></a>
        </td> -->
    </tr>
<?php endforeach; ?>
<?php } else { echo "<tr><td colspan='5'><i>Tidak ada data</i></td></tr>"; } ?>