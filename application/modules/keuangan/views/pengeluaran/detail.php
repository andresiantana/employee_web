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
        <?php $total = 0; if(count($detail) > 0){ ?>
        <?php foreach($detail as $key => $v){ ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo date('d M Y',strtotime($v->tanggal_pencairan)); ?></td>
                <td><?php echo $v->kode_pencairan; ?></td>
                <td><?php echo $v->nama_kategori; ?></td>
                <td style="text-align:right;"><?php echo $v->nominal; ?></td>
                <td style="text-align:right;"><?php echo $v->nominal_disetujui; ?></td>
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