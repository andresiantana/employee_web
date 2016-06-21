<?php if(count($data) > 0){ ?>
<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
        <td><?php echo $v->kode_pencairan; ?></td>
        <td><?php echo $v->nip; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td style="text-align:center;"><?php echo $v->semester; ?></td>
        <td><?php echo ($v->tanggal_approve_sdm != '') ? date('d M Y',strtotime($v->tanggal_approve_sdm)) : "-"; ?></td>
        <td><?php echo ($v->tanggal_approve != '') ? date('d M Y',strtotime($v->tanggal_approve)) : "-"; ?></td>
        <td><?php echo ($v->tanggal_approve_pencairan != '') ? date('d M Y',strtotime($v->tanggal_approve_pencairan)) : "-"; ?></td>
        <td><?php echo ($v->tanggal_penerimaan != '') ? date('d M Y',strtotime($v->tanggal_penerimaan)) : "-"; ?></td>
        <td style="text-align:right;"><?php echo $v->berhasil_transfer; ?></td>                                    
        <td class="td-actions">
            <a href="#detail" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melihat Detail Pengeluaran" onclick="setIdPencairan(<?php echo $v->id_pencairan_biaya; ?>,<?php echo $v->id_pegawai; ?>);"><i class="fa fa-list"> </i></a>
        </td>
    </tr>
<?php endforeach; ?>
<?php }else{ ?>
    <tr><td colspan="8">Data tidak ditemukan.</td></tr>
<?php } ?>