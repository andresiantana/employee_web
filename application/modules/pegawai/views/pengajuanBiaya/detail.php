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
                <th height="50" colspan="9" class="judul">DETAIL PENGAJUAN</th>
            </tr>
        </table>
<?php }else { $style=''; } ?>
<table <?php echo $style; ?> class="table table-striped table-bordered table-hover">            
  <tr>
      <th>Nama Pegawai:</th>
      <td><?php echo $data_pegawai->nama_lengkap; ?></td>

      <th>Semester:</th>
      <td><?php echo $data_row->semester; ?></td>
  </tr>
  <tr>
      <th>NIP:</th>
      <td><?php echo $data_pegawai->nip; ?></td>

      <th>NIDN:</th>
      <td><?php echo $data_pegawai->nidn; ?></td>      
  </tr>
</table>
<table <?php echo $style; ?> class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal Pengajuan</th>
            <th>Kode Pengajuan</th>
            <th>Kategori Biaya</th>
            <th>Nominal Pengajuan</th>
            <th>Nominal Disetujui</th>
        </tr>
        <tr>
            
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; if(count($detail) > 0){ ?>
        <?php foreach($detail as $key => $v){ ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo date('d M Y',strtotime($v->tanggal)); ?></td>
                <td><?php echo $v->kode_pengajuan; ?></td>
                <td><?php echo $v->nama_kategori; ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal); ?></td>
                <td style="text-align:right;"><?php echo number_format($v->nominal_disetujui); ?></td>
            </tr>
        <?php $total += $v->nominal_disetujui;} ?>
        <?php }else{ ?>
            <tr><td colspan="5" style="text-align:left;">Data tidak ditemukan.</td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5"><b><i>Total</i></b></td>
            <td style="text-align:right;"><?php echo number_format($total); ?></td>
        </tr>
        <tr>
            <td colspan="5"><b><i>Total Gagal Di Transfer</i></b></td>
            <td style="text-align:right;"><?php echo number_format($data_row->gagal_transfer); ?></td>
        </tr>
        <tr>
            <td colspan="5"><b><i>Total Berhasil Di Transfer</i></b></td>
            <td style="text-align:right;"><?php echo number_format($data_row->berhasil_transfer); ?></td>
        </tr>
    </tfoot>
</table>
<?php if(!isset($_GET['caraPrint'])){ ?>
<a href='javascript:void(0);' onclick="print('PRINT',<?php echo $id_pengajuan_biaya; ?>);" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a> 

<script type="text/javascript">
function print(caraPrint,id_pengajuan_biaya)
{
    var id_pengajuan_biaya = id_pengajuan_biaya;
    window.open('<?php echo base_url('pegawai/PengajuanBiaya/printDetail'); ?>/'+id_pengajuan_biaya+'?caraPrint=PRINT','printwin','left=100,top=100,width=1000,height=640');
}
</script>
<?php }else{ ?>
<script type="text/javascript">
  window.print();
</script>
<?php } ?>