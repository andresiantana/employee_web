<style>
    p {
        color:#000099;
        font-family: verdana;
    }
    body{
        background-color: #ffffff;
    }
    table{
        margin:0 auto;
        width: 50%;
        border-collapse: collapse;
        background-color: #ecf3eb;
    }
    th, td{
        border:1px solid #999;
    }
    th{
        padding: 8px 0;
        background: #0fc;
        font-size: 30px;
    }
    td{
        padding: 4px; 4px;
    }
    .content-depan{
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);    
        color:#000000;
        width:8.6cm;
        /*width:18.6cm;*/
        height:5.5cm;
        border:0px solid;
        margin: 0px 0px 0px 0px;
        position:absolute;
    }
    .pegawai{
        font-weight: bold;
        width:100%;
        left:2%;
        text-align: left;
        position:relative;
        border:1px solid;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .data{
        width:200%;
        top:28px;
        margin-left:3px;
        z-index: 1;
        position: relative;
        font-size: 9px;
    }
</style>
<table align="center">
    <tr>
        <th height="50" colspan="2">KARTU PID</th>
    </tr>
    <tr>
        <td>
            <p><blockquote><pre>
                <?php 
                    print '<br>';
                    print 'NIDN :';
                    print $detail->nidn;
                    print '<br>';

                    print 'NIP :';
                    print $detail->nip;
                    print '<br>';

                    print 'Nama :';
                    print $detail->nama_lengkap;
                    print '<br>';

                    print 'Tempat, Tgl Lahir :';
                    print ",". date('d-m-Y',strtotime($detail->tanggal_lahir));
                    print '<br>';

                    print 'E-mail :';
                    print $detail->email;
                    print '<br>';

                    print 'No. Telp :';
                    print $detail->no_telp;
                    print '<br>';

                    print 'Fakultas :';
                    print $detail->nama_fakultas;
                    print '<br>';

                    print 'Prodi :';
                    print $detail->nama_prodi;
                    print '<br>';
                ?>
            </pre></blockquote></p>
        </td>
        <td>
            <blockquote>
                <img src="<?php echo base_url().'data/images/pegawai/'.$detail->foto; ?>" width="100px" height="100px">
            </blockquote>
        </td>
    </tr>
    <tr>
        <th colspan="2">Rincian Pengajuan Biaya</th>
    </tr>
    <tr>
        <td colspan="2">
            <table align="center">
                <tr>
                    <td>No.</td>
                    <td>Nama Uraian</td>
                    <td>Nominal</td>
                </tr>
                <?php 
                    $total = 0;
                    foreach($detail_rincian as $key => $v){ 
                    $total += $v->nominal;
                ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $v->nama_kategori; ?></td>
                        <td style='text-align:right;'><?php echo number_format($v->nominal,0,'',','); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align:right;">Total</td>
                    <td style='text-align:right;'><?php echo number_format($total,0,'',','); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script type="text/javascript">
  window.print();
</script>