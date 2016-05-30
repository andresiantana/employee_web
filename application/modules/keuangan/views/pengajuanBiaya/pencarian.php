<?php if(count($data) > 0){ ?>
<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
        <td><?php echo $v->kode_pengajuan; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td><?php echo $v->semester; ?></td>
        <td><?php echo $v->jumlah_nominal; ?></td>                                    
        <td class="td-actions">
            <?php 
                if(empty($v->id_pencairan_biaya)){
            ?>
                <a href="<?php echo base_url('keuangan/PengajuanBiaya/pencairanBiaya?id_pengajuan_biaya='.$v->id_pengajuan_biaya); ?>" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Melakukan Pencairan Biaya"><i class="fa fa-check"> </i></a>
            <?php }else{ ?>
            <font>Sudah Dicairkan</font>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>
<?php }else{ ?>
    <tr><td colspan="9">Data tidak ditemukan.</td></tr>
<?php } ?>