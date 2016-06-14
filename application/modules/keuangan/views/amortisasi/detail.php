<?php 
    if(isset($_GET['caraPrint'])){ 
    $style = "border=1 align=center cellpadding=0 cellspacing=0 width=50%";
?>
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
      <table align="center">
        <tr>
            <th height="50" colspan="9" class="judul">AMORTISASI</th>
        </tr>
    </table>

<?php }else { $style=''; } ?>
<table <?php echo $style; ?> class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Bulan Ke-</th>
            <th>Amortisasi</th>
            <th>Nilai Sisa</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:right;"><?php echo number_format($amortisasi); ?></td>
        </tr>
        <?php 
            $jml_amortisasi = $amortisasi; $total = 0; $jumlah = 0; 
            if(count($detail) > 0){ 
        ?>
        <?php foreach($detail as $key => $v){ 
                $jumlah = ($jml_amortisasi - $v->biaya);
                $jml_amortisasi = $jumlah;
                if($jumlah < 0){
                  $jumlah = 0;
                }
        ?>
            <tr>
                <td style="text-align:center;"><?php echo $key+1; ?></td>
                <td style="text-align:right;"><?php echo number_format($v->biaya); ?></td>
                <td style="text-align:right;"><?php echo number_format($jumlah); ?></td>
            </tr>
        <?php $total = $jml_amortisasi;
              if($total < 0){
                $total = 0;
              }

        } ?>
        <?php }else{ ?>
            <tr><td colspan="3" style="text-align:left;">Data tidak ditemukan.</td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align:right;"><b><i>Total</i></b></td>
            <td style="text-align:right;"><?php echo number_format($total); ?></td>
        </tr>
    </tfoot>
</table>
<?php if(!isset($_GET['caraPrint'])){ ?>
<a href='javascript:void(0);' onclick="print('PRINT',<?php echo $id_pegawai;?>);" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a> 

<script type="text/javascript">
function print(caraPrint,id_pegawai)
{
    var id_pegawai = id_pegawai
    window.open('<?php echo base_url('keuangan/Amortisasi/printDetail'); ?>/'+id_pegawai+'?caraPrint=PRINT','printwin','left=100,top=100,width=1000,height=640');
}
</script>
<?php }else{ ?>
<script type="text/javascript">
  window.print();
</script>
<?php } ?>