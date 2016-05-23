<?php
  $bl = '';
  if($bulan == 01){
    $bl = "Januari";
  }else if($bulan == 02){
    $bl = "Februari";
  }else if($bulan == 03){
    $bl = "Maret";
  }else if($bulan == 04){
    $bl = "April";
  }else if($bulan == 05){
    $bl = "Mei";
  }else if($bulan == 06){
    $bl = "Juni";
  }else if($bulan == 07){
    $bl = "Juli";
  }else if($bulan == 08 || $bulan == 8){
    $bl = "Agustus";
  }else if($bulan == 09 || $bulan == 9){
    $bl = "September";
  }else if($bulan == 10){
    $bl = "Oktober";
  }else if($bulan == 11){
    $bl = "Nopember";
  }else if($bulan == 12){
    $bl = "Desember";
  }
  $jumlah_hari = null;

  if($saldo_awal->biaya > 0){
      $saldo_awal  = $saldo_awal->biaya;
    }else{
      $saldo_awal  = 0;
    }

    if($saldo_debit->biaya  > 0){
      $saldo_debit = $saldo_debit->biaya ;
    }else{
      $saldo_debit  = 0;
    }

    if($saldo_kredit->biaya  > 0){
      $saldo_kredit  = $saldo_kredit->biaya ;
    }else{
      $saldo_kredit  = 0;
    }

?>
<div class="row">
    <div style='text-align:center;'>
      <h3>Laporan Buku Besar</h3><br/>
      <h3>Periode 01 <?php echo $bl; ?> <?php echo $tahun; ?> s.d <?php echo $jumlah_hari; ?> <?php echo $bl; ?> <?php echo $tahun; ?></h3>
    </div>
    <br/>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Laporan Buku Besar
            </div>
            <br/>
            <div class="panel-body">
                <div class="table-responsive"> 
                    <table class="table">
                      <tr>
                        <td width="83%">Akun : <?php echo $akun->nama_akun; ?><br/>
                        Akun No : <?php echo $kode_akun; ?></td>              
                      </tr>
                    </table>                   
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th style="text-align:center;">Tanggal</th>
                              <th style="text-align:center;">Akun</th>
                              <th style="text-align:center;">Ref</th>
                              <th style="text-align:center;">Debit (Rp.)</th>
                              <th style="text-align:center;">Kredit (Rp.)</th>
                              <th style="text-align:center;">Saldo (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
          $akun = (substr($kode_akun,0,1));   
          $total_debit = 0;
          $total_kredit = 0;
          $total1 = 0;
          $total2 = 0;
          $total = 0;
          $total_saldoawal = 0;
            if(($akun == 1) OR ($akun ==5)){
              $total_saldoawal=$saldo_awal + ($saldo_debit - $saldo_kredit);
            }else{
              $total_saldoawal=$saldo_awal + ($saldo_kredit - $saldo_debit);
            }

            if($total_saldoawal <= 0){
              $total_saldoawal = $total_saldoawal * (-1);
            }

          echo "<tr>";                
          echo '<td></td>';
          echo "<td><b><i>Saldo Awal :</i></b></td>";
          echo "<td></td>";
          echo "<td style='text-align:right;'>";  
                 
          if( ($akun == 1) OR ($akun ==5)){
            //echo "<b>".number_format($total_saldoawal,0,'','.')."</b>";
          }               
          echo "</td>";
          echo "<td style='text-align:right;'>";
          if( ($akun != 1) OR ($akun !=5)){
            //echo "<b>".number_format($total_saldoawal,0,'','.')."</b>";
          }
          echo "</td>";
          echo "<td style='text-align:right;'><b>".number_format($total_saldoawal,0,'','.')."</b></td>";
          echo "</tr>";

          $total_saldo = 0;

          if(count($data) > 0){            
            foreach($data as $v): 
                if($v->status == 'D'){
                    $total_debit += $v->biaya;
                }else{
                    $total_kredit += $v->biaya;
                }
          ?>
            <tr>
                <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
                <td><?php echo $v->nama_akun; ?></td>
                <td style="text-align:center;">JU1</td>
                <td style="text-align:right;">
                  <?php
                    if($v->status == 'D'){
                      echo number_format($v->biaya,0,'','.');
                      $total1 += $v->biaya;
                    }else{
                      echo 0;
                    }
                  ?>
                </td>
                <td style="text-align:right;">
                  <?php
                    if($v->status == 'K'){
                      echo number_format($v->biaya,0,'','.');
                      $total2 += $v->biaya;
                    }else{
                      echo 0;
                    }
                  ?>
                </td>
                <td style="text-align:right;">
                  <?php
                    if((substr($kode_akun,0,1))==1 OR (substr($kode_akun,0,1))==5){
                  //$total=($total2-$total1)+$total2;
                      $total = $total_saldoawal + ($total1-$total2);
                    }else{
                      $total= $total_saldoawal + ($total1-$total2);
                    }
                    if($total>0){
                      echo number_format($total,0,'','.');
                    }else{
                      echo number_format(-$total,0,'','.');
                    }
                  ?>
                </td>
            </tr>
          <?php endforeach; ?>
          <?php }else{ ?>
          <tr>
              <td colspan="6">Data tidak ditemukan.</td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
              <td colspan="5">Total (Rp.)</td>
              <td style="text-align:right;">
                <?php 
                  if($total>0){
                      echo number_format($total,0,'','.');
                    }else{
                      echo number_format(-$total,0,'','.');
                    }
                ?>
              </td>
          </tr>
        </tfoot>
                    </table>
                </div><br><br>
            </div>            
        </div>
    </div>
</div>