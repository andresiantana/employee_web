<style>
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
<div class="content-depan">
    <div class="pegawai">
        <!-- <div class="data"> -->
            <table>
              <tr>
                <td><b>NIDN</b></td>
                <td>:</td>
                <td><?php echo $detail->nidn; ?></td>
              </tr>
              <tr>
                <td><b>NIP</b></td>
                <td>:</td>
                <td><?php echo $detail->nip; ?></td>
              </tr>
              <tr>
                <td><b>Nama</b></td>
                <td>:</td>
                <td><?php echo $detail->nama_lengkap; ?></td>
              </tr>
              <tr>
                <td><b>Tempat/Tgl. Lahir</b></td>
                <td>:</td>
                <td><?php echo date('d-m-Y',strtotime($detail->tanggal_lahir)); ?></td>
              </tr>
              <tr>
                <td><b>Fakultas</b></td>
                <td>:</td>
                <td><?php echo $detail->fakultas; ?></td>
              </tr>
              <tr>
                <td><b>Prodi</b></td>
                <td>:</td>
                <td><?php echo $detail->prodi; ?></td>
              </tr>              
            </table>
        <!-- </div> -->
    </div>
</div><br>
<script type="text/javascript">
  window.print();
</script>