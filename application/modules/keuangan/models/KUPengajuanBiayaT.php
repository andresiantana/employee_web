<?php
$obj = &get_instance();
$obj->load->model('PengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class KUPengajuanBiayaT extends PengajuanBiayaT {
	public function tampilData($nip = null , $kode_pengajuan = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('pengajuan_biaya.id_pengajuan_biaya,pengajuan_biaya.id_pegawai,pengajuan_biaya.tanggal,pengajuan_biaya.kode_pengajuan,pegawai.nama_lengkap,pengajuan_biaya.semester,sum(uraian_pengajuan_biaya.nominal_disetujui) as jumlah_nominal, pengajuan_biaya.id_pencairan_biaya');
		$this->db->from('pengajuan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengajuan_biaya.id_pegawai');
		$this->db->join('uraian_pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->like('pengajuan_biaya.status_pengajuan', 'Approved');
		if($nip != ''){
			$this->db->like('pegawai.nip', $nip);
		}
		if($kode_pengajuan != ''){
			$this->db->like('pengajuan_biaya.kode_pengajuan', $kode_pengajuan);
		}
		if($tanggal_awal != '' && $tanggal_akhir != ''){
			$this->db->where("pengajuan_biaya.tanggal BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ");
		}		
		$this->db->group_by('pengajuan_biaya.id_pengajuan_biaya');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file KUPengajuanBiayaT.php */
/* Location: ./application/modules/keuangan/models/KUPengajuanBiayaT.php */