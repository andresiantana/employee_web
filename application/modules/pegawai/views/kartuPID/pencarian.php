<?php foreach($data as $key => $v): ?>
    <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $v->nama_lengkap; ?></td>
        <td><?php echo $v->nip; ?></td>
        <td><?php echo $v->nidn; ?></td>
        <td><?php echo date('d M Y',strtotime($v->tanggal_lahir)); ?></td>
        <td><?php echo $v->email; ?></td>
        <td><?php echo $v->no_telp; ?></td>
        <td><img src="<?php echo base_url().'data/images/pegawai/'.$v->foto; ?>" width="50px" height="50px"></td>
        <td><?php echo $v->nama_fakultas; ?></td>
        <td><?php echo $v->nama_prodi; ?></td>
        <td><?php echo $v->nama_bank; ?></td>
        <td><?php echo $v->nomor_rekening; ?></td>
        <td><?php echo $v->atasnama_rekening; ?></td>
        <td><a href="javascript:prd_download('<?php echo $v->surat_studi_lanjut; ?>')"><?php echo $v->surat_studi_lanjut; ?></a></td>
        <td><a href="javascript:prd_download('<?php echo $v->surat_lulus_seleksi; ?>')"><?php echo $v->surat_lulus_seleksi; ?></a></td>
        <td><a href="javascript:prd_download('<?php echo $v->surat_terima_beasiswa; ?>')"><?php echo $v->surat_terima_beasiswa; ?></a></td>
        <td style="text-align:right;"><?php echo $v->biaya_spp; ?></td>
        <td class="td-actions">
            <a href="javascript:void(0)" class="btn btn-small btn-success" rel="tooltip" title="Klik untuk Cetak Kartu PID" onclick="print('PRINT',<?php echo $v->id_pegawai; ?>);"><i class="fa fa-print"> </i></a>            
        </td>
    </tr>
<?php endforeach; ?>