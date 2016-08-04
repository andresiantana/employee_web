<table class="table table-striped table-bordered table-hover">            
  <tr>
      <th>Nama Pegawai:</th>
      <td><?php echo $datapegawai->nama_lengkap; ?></td>

      <th>Semester:</th>
      <td><?php echo $data_row->semester; ?></td>
  </tr>
  <tr>
      <th>NIP:</th>
      <td><?php echo $datapegawai->nip; ?></td>

      <th>NIDN:</th>
      <td><?php echo $datapegawai->nidn; ?></td>      
  </tr>
</table>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal Pengeluaran</th>
            <th>Kode Pengeluaran</th>
            <th>Kategori Biaya</th>
            <th>Nominal Pengajuan</th>
            <th>Nominal Dicairkan</th>
        </tr>
        <tr>
            
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; $nominal_disetujui = 0; $nominal_pengajuan = 0; if(count($detail) > 0){ ?>
        <?php foreach($detail as $key => $v){ ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
                <td><?php echo $v->kode_pencairan; ?></td>
                <td><?php echo $v->nama_kategori; ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal,0,'',','); ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal_disetujui,0,'',','); ?></td>
            </tr>
        <?php 
        $total += $v->nominal_disetujui;
        $nominal_pengajuan += $v->nominal;
        $nominal_disetujui += $v->nominal_disetujui;

        } ?>
        <?php }else{ ?>
            <tr><td colspan="5" style="text-align:left;">Data tidak ditemukan.</td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align:right;"><b><i>Biaya Pengajuan</i></a></td>
            <td style='text-align:right;'><?php echo number_format($nominal_pengajuan); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right;"><b><i>Biaya Disetujui</i></a></td>
            <td style='text-align:right;'><?php echo number_format($nominal_disetujui); ?></td>
        </tr>
        <tr>
            <td colspan="5"><b><i>Total</i></b></td>
            <td style="text-align:right;"><?php echo number_format($total); ?></td>
        </tr>
    </tfoot>
</table>
<a href='javascript:void(0);' onclick="print('PRINT',<?php echo $id_pencairan_biaya; ?>,<?php echo $id_pegawai;?>);" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a> 

<script type="text/javascript">
function print(caraPrint,id_pencairan_biaya,id_pegawai)
{
    var id_pencairan_biaya = id_pencairan_biaya;
    var id_pegawai = id_pegawai
    window.open('<?php echo base_url('keuangan/Pengeluaran/printDetailPengeluaran'); ?>/'+id_pencairan_biaya+'/'+id_pegawai,'printwin','left=100,top=100,width=1000,height=640');
}
</script>