<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
        <td><?php echo $v->kode_pengajuan; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td><?php echo $v->semester; ?></td>
        <td><?php echo $v->jumlah_nominal; ?></td>                                    
        <td>
            <?php if(!empty($v->id_pencairan_dana)) { ?>
            Dana Cair
            <?php } ?>
        </td>
        <td class="td-actions">
            <?php 
                if($v->status_pengajuan == ''){
            ?>
                <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Approve/Reject Pengajuan" onclick="popup_window_show('#sample', { pos : 'window-center',width : '800px' });setIdPengajuanBiaya(<?php echo $v->id_pengajuan_biaya; ?>);"><i class="fa fa-check"> </i></a>
            <?php }else{ 
                if($v->status_pengajuan == 'Approved'){
                    $warna = 'color:green;';
                }else{
                    $warna = 'color:red;';
                }
            ?>
            <font style="<?php echo $warna; ?>"><?php echo $v->status_pengajuan; ?></font>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>