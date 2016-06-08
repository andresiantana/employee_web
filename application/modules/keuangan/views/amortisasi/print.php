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
      <center>AMORTISASI</center><br/>
      <table>
          <tr>
              <td>NIP</td>
              <td>:</td>
              <td><?php echo $detail->nip; ?></td>
          </tr>
          <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?php echo $detail->nama_lengkap; ?></td>
          </tr>
      </table><br/>
      <b>Rincian :</b>
      <div class="detail-amortisasi" style="margin-left:40px;">
          <p>
            = Nilai Pokok - Nilai Sisa / (2n + 12)
          </p>
          <p>
            = <?php echo $detail->biaya; ?> - 0 / ((2 * <?php echo $detail->lama_bulan_studi; ?>) + 12
          </p>
          <p>
            = <b>Rp. <?php echo number_format(round($detail->biaya/((2*$detail->lama_bulan_studi)+12))); ?>,00 </b>
          </p>
      </div>
     <p> Dengan ini menyatakan bahwa rincian amortisasi diatas dihasilkan dengan sebenar-benarnya. </p>
     <br/><br/><br/>
     <div style="text-align:center;">Hormat Kami,</div><br/><br/>   
     <div style="text-align:center;"><u><b><?php echo $nama_role; ?></b></u></div>
  </div>
</div>

<script type="text/javascript">
  window.print();
</script>