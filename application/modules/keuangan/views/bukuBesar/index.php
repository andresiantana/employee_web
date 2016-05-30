<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Laporan Buku Besar
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('keuangan/BukuBesar/laporanBukuBesar');  ?>
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-warning">
                                <strong><?php echo validation_errors(); ?></strong>
                            </div>              
                            <?php } ?>  
                            <legend> Data Pencarian </legend>
                            <table style="width:100%;">
                            	<tr>
		                            <td style="width:10%"><label>Akun</label></td>
		                            <td style="width:1%;"></td>
		                            <td style="width:30%"> 
		                            	<?php
							                $dd_coa_attributes = 'name="kode_akun" class="form-control" requied';
							                echo form_dropdown('kode_akun', $coa, '', $dd_coa_attributes);
						                ?>
		                            </td>

		                            <td style="width:9%"></td>

		                            <td><label></label></td>
		                            <td style="width:1%;"></td>
		                            <td></td>
		                        </tr>
		                        <tr>
		                        	<td colspan="3">&nbsp;</td>
		                        </tr>
		                        <tr>
		                            <td style="width:10%"><label>Bulan</label></td>
		                            <td style="width:1%;"></td>
		                            <td style="width:30%">
		                            	<select id="bulan" name="bulan" class="form-control" required>
			                                <?php
												if (isset($_POST['bulan'])){
													$bln = $_POST['bulan'];
													switch ($bln){
													case 01: $bl="Januari";break;
													case 02: $bl="Februari";break;
													case 03: $bl="Maret";break;
													case 04: $bl="April";break;
													case 05: $bl="Mei";break;
													case 06: $bl="Juni";break;
													case 07: $bl="Juli";break;
													case 08: $bl="Agustus";break;
													case 09: $bl="September";break;
													case 10: $bl="Oktober";break;
													case 11: $bl="November";break;
													case 12: $bl="Desember";break;
												}
												?>
												<option value="<?php echo $bln;?>"><?php echo $bl;?></option>
												<?php
												}
												?>
												
												<option value="">--Pilih--</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
										</select>
		                            </td>

		                            <td style="width:9%"></td>

		                            <td><label></label></td>
		                            <td style="width:1%;"></td>
		                            <td></td>
		                        </tr>
		                        <tr>
		                        	<td colspan="3">&nbsp;</td>
		                        </tr>
		                        <tr>
		                            <td><label>Tahun</label></td>
		                            <td style="width:1%;"></td>
		                            <td> <input type="text" class="form-control" id="tahun" name="tahun" required></td>

		                            <td style="width:9%"></td>

		                            <td><label></label></td>
		                            <td style="width:1%;"></td>
		                            <td></td>
		                        </tr>
		                    </table>
		                    <br>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        	<button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Ulang </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>