  <table width="100%">
      <tr>
          <td width="25%" align="center">
              <img src="<?php echo base_url().'data/images/logo.png'; ?>" width="50px" height="50px">
          </td>
          <td align="center">
              <div>
                  <b>TELKOM UNIVERSITY</b>
              </div>
              <div>
                  Jl. Telekomunikasi No. 1, Bandung
              </div>
          </td>
      </tr>
      <tr>
          <td colspan="3" style="border-bottom: 2px solid #000000">&nbsp;</td>
      </tr>
  </table>
  <center><b>PENGELUARAN BIAYA</b></center><br/>
  <table>
      <tr>
          <td>NIP</td>
          <td>:</td>
          <td><?php echo $datapegawai->nip; ?></td>
      </tr>
      <tr>
          <td>Nama</td>
          <td>:</td>
          <td><?php echo $datapegawai->nama_lengkap; ?></td>
      </tr>
</table><br/>
<table border="1" width="100%" cellpadding="0" cellspacing="0">
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
        <?php $total = 0; $nominal_pengajuan = 0; $nominal_disetujui = 0; if(count($detail) > 0){ ?>
        <?php foreach($detail as $key => $v){ ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td style="text-align:center;"><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
                <td><?php echo $v->kode_pencairan; ?></td>
                <td><?php echo $v->nama_kategori; ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal,0,'',','); ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal_disetujui,0,'',','); ?></td>
            </tr>
        <?php $total += $v->nominal_disetujui;
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
<script type="text/javascript">
  window.print();
</script>