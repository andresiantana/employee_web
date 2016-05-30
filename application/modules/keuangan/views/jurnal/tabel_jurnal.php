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
?>
<div class="row">
    <div style='text-align:center;'>
      <h3>Jurnal Umum</h3><br/>
      <h3>Periode <?php echo $bl; ?> <?php echo $tahun; ?></h3>
    </div>
    <br/>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Tabel Jurnal
            </div>
            <br/>
            <div class="panel-body">
                <div class="table-responsive">                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th rowspan="2" style="text-align:center;">Tanggal</th>
                              <th rowspan="2" style="text-align:center;">Keterangan</th>
                              <th rowspan="2" style="text-align:center;">Ref</th>
                              <th colspan="2" style="text-align:center;">Jumlah</th>
                            </tr>
                            <tr>
                              <th style="text-align:center;">Debit</th>
                              <th style="text-align:center;">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total_debit = 0;
                                $total_kredit = 0;
                                if(count($data) > 0){            
                                  foreach($data as $v): 
                                      if($v->status == 'D'){
                                          $total_debit += $v->biaya;
                                      }else{
                                          $total_kredit += $v->biaya;
                                      }
                              ?>
                                <tr>
                                    <td><?php echo isset($v->tanggal_jurnal) ? date('d M Y',strtotime($v->tanggal_jurnal)) : null; ?></td>
                                    <td><?php echo $v->nama_akun; ?></td>
                                    <td style="text-align:center;"><?php echo $v->no_akun; ?></td>
                                    <td style="text-align:right;">
                                      <?php
                                        if($v->status == 'D'){
                                          echo number_format($v->biaya);
                                        }else{
                                          echo 0;
                                        }
                                      ?>
                                    </td>
                                    <td style="text-align:right;">
                                      <?php
                                        if($v->status == 'K'){
                                          echo number_format ($v->biaya);
                                        }else{
                                          echo 0;
                                        }
                                      ?>
                                    </td>
                                </tr>
                              <?php endforeach; ?>
                              <?php }else{ ?>
                              <tr>
                                  <td colspan="5">Data tidak ditemukan.</td>
                              </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                  <td colspan="3">Total (Rp.)</td>
                                  <td style="text-align:right;"><?php echo number_format($total_debit); ?></td>
                                  <td style="text-align:right;"><?php echo number_format($total_kredit); ?></td>
                              </tr>
                            </tfoot>
                    </table>
                </div><br><br>
                <a class="btn btn-danger" href="<?php echo base_url('keuangan/Jurnal'); ?>"><< Kembali</a>
            </div>            
        </div>
    </div>
</div>