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
                <th height="50" colspan="9" class="judul">DETAIL SERTIFIKASI</th>
            </tr>
        </table>
        <table align="center">            
            <tr>
                <th>NIP:</th>
                <td><?php echo $data_pegawai->nip; ?></td>

                <th>Nama Pegawai:</th>
                <td><?php echo $data_pegawai->nama_lengkap; ?></td>
            </tr>
        </table>

<?php }else { $style=''; } ?>
<table <?php echo $style; ?> class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Sertifikasi</th>
            <th>Penyelenggara</th>
            <th>Skor</th>
            <?php if(!isset($_GET['caraPrint'])){ ?>
            <th>Unduh File</th>
            <?php } ?>
        </tr>
        <tr>
            
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; if(count($detail) > 0){ ?>
        <?php foreach($detail as $key => $v){ ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $v->nama_jenis_sertifikasi; ?></td>
                <td><?php echo $v->penyelenggara; ?> </td>
                <td><?php echo $v->skor; ?></td>
                <?php if(!isset($_GET['caraPrint'])){ ?>
                  <td><?php echo ($v->upload == '') ? "File belum diupload" : "<a href='javascript:prd_download('<?php echo $v->upload; ?>')'></a>".$v->upload; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        <?php }else{ ?>
            <?php if(!isset($_GET['caraPrint'])){ ?>
            <tr><td colspan="5" style="text-align:left;">Data tidak ditemukan.</td></tr>
            <?php }else{ ?>
            <tr><td colspan="4" style="text-align:left;">Data tidak ditemukan.</td></tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<?php if(!isset($_GET['caraPrint'])){ ?>
<a href='javascript:void(0);' onclick="print('PRINT',<?php echo $id_pegawai; ?>);" class="btn btn-small btn-info"><i class="fa fa-print"> </i> Print</a> 

<script type="text/javascript">
function print(caraPrint,id_pegawai)
{
    var id_pegawai = id_pegawai;
    window.open('<?php echo base_url('pegawai/DataPegawai/printDetailSertifikasi'); ?>/'+id_pegawai+'?caraPrint=PRINT','printwin','left=100,top=100,width=1000,height=640');
}

function prd_download(file)
{   
    file_name = file;
    window.location.href =  "<?php echo site_url('pegawai/DataPegawai/file_download') ?>?file_name="+ file_name;
}
</script>
<?php }else{ ?>
<script type="text/javascript">
  window.print();
</script>
<?php } ?>