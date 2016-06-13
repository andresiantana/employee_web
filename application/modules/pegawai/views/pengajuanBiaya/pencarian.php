<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
        <td><?php echo $v->kode_pengajuan; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td><?php echo $v->semester; ?></td>
        <td><?php echo $v->jumlah_nominal; ?></td>
        <td>
            <?php if(isset($v->status_pengajuan)) { 
                if($v->status_pengajuan == 'Approved'){
                    $data = 'Approved';
                    $warna = 'green';
                    $huruf = '<a href="#"><font style="color:'.$warna.';">'.$data.'</font></a>';
                    $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                }else if($v->status_pengajuan == 'Reject'){
                    $data = 'Reject';
                    $warna = 'red';
                    $huruf = '<a href="#" rel="tooltip" title="Lihat Alasan" onclick="setDialog(\''.$v->alasan_status.'\');"><font style="color:'.$warna.';">'.$data.'</font></a>';
                    $button = '-';
                }else{
                    $data = '';
                    $warna = '';
                    $huruf = '';
                    $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                }
            ?>
                <?php echo isset($huruf) ? $huruf : ""; ?>
            <?php }else{ 
                    $data = '';
                    $warna = '';
                    $huruf = '';
                    $button = '<a href='.base_url('pegawai/PengajuanBiaya/index/'.$v->id_pengajuan_biaya).'" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk ubah Pengajuan Biaya Pegawai"><i class="fa fa-edit"> </i></a>';
                }
            ?>
        </td>
         <td>
            <?php if(!empty($v->id_pencairan_biaya)) {
                $button = "-";                                            
            ?>
            Sudah Dicairkan
            <?php }else{ ?>
            <?php echo "<font color=blue>Belum ada verifikasi</font>"; ?>
            <?php } ?>
        </td>
        <td class="td-actions">
            <?php echo isset($button) ? $button : ""; ?>
        </td>
    </tr>
<?php endforeach; ?>