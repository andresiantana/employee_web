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
    .judul{
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
        <th height="50" colspan="9" class="judul">KARTU PID</th>
    </tr>
    <tr>
        <td>Pegawai</td>
        <td>:</td>
        <td><?php echo $detail->nama_lengkap; ?></td>

        <td>Status Pegawai</td>
        <td>:</td>
        <td><?php echo $detail->nip; ?></td>

        <td>Tempat Studi</td>
        <td>:</td>
        <td><?php echo $detail->nama_universitas; ?></td>
    </tr>
    <tr>
        <td>NIP</td>
        <td>:</td>
        <td><?php echo $detail->nip; ?></td>

        <td>Fakultas/Prodi</td>
        <td>:</td>
        <td><?php echo $detail->nama_fakultas; ?> / <?php echo $detail->nama_prodi; ?></td>

        <td>Jenjang</td>
        <td>:</td>
        <td><?php echo $detail->jenjang; ?></td>
    </tr>
</table>
<table align="center">
    <tr>
        <th height="50" colspan="9" class="judul">Rincian Biaya</th>
    </tr>
    <tr>
        <th>Semester</th>
        <th colspan="3">Rincian Biaya</th>        
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<script type="text/javascript">
  window.print();
</script>