<div class="span12">
<div class="widget widget-table action-table">
    <!-- /widget-header -->
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

      <table  style="float:right;margin-right:30px;">
            <tr>
              <td>Bandung, <?php echo date('d M Y',strtotime($datapencairan->tanggal_pencairan)); ?><td>
            </tr>
          </table>
          <table style="float:left; margin-left:30px;" width="900px;">
            <tr>
              <td>
                <p>
                  Dengan surat ini, kami menyampaikan bahwa pengajuan biaya yang diajukan oleh : </br>
                  
                  <table>
                    <tr>
                      <td>Nama Pemohon</td>
                      <td>:</td>
                      <td><?php echo $datapencairan->nama_lengkap; ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengajuan </td>
                      <td>:</td>
                      <td><?php echo date('d M Y',strtotime($datapencairan->tanggal)); ?></td>
                    </tr>
                    <tr>
                      <td>Kode Pengajuan </td>
                      <td>:</td>
                      <td><?php echo $datapencairan->kode_pengajuan; ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Biaya</td>
                      <td>:</td>
                      <td><i><b>Rp. <?php echo number_format($datapencairan->jumlah_nominal,0,'',','); ?></b></i></td>
                    </tr>
                    <tr>
                      <td>Semester</td>
                      <td>:</td>
                      <td><?php echo $datapencairan->semester; ?></td>
                    </tr>
                  </table>
                  <br/>
                  Bahwa pengajuan biaya yang telah dilampirkan sudah di setujui oleh Bagian Keuangan. Dengan Jumlah Nominal <i><b>Rp. <?php echo number_format($datapencairan->berhasil_transfer); ?>,- . </b></i>
                  <br>Untuk keterangan lebih lanjut dapat menghubungi Bagian Keuangan. <br/><br/>
                </p>
              <td>
            </tr>
            <tfooter >
              <tr>
                <td style="float:right;margin-right:30px;">
                  <div style="text-align:center;">Hormat Kami,<br/>
                  Bagian Keuangan</div><br/><br/>
                  
                  <div style="text-align:center;"><u><b><?php echo $nama_role; ?></b></u></div>
                </td>
              </tr>
            </tfooter>
          </table> 
  </div>
</div>

<script type="text/javascript">
  window.print();
</script>