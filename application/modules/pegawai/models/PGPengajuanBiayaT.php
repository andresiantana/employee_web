<?php
$obj = &get_instance();
$obj->load->model('PengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class PGPengajuanBiayaT extends PengajuanBiayaT {
	public function tampilDataPengajuan($semester = null ,$id_kategori_biaya = null ,$tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		$this->db->from('pengajuan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengajuan_biaya.id_pegawai');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = pengajuan_biaya.id_kategori_biaya','left');
		$this->db->where('pegawai.id_user',$this->session->userdata('id_user'));
		if($semester != ''){
			$this->db->where('semester', $semester);
		}
		if($id_kategori_biaya != ''){
			$this->db->where('id_kategori_biaya', $id_kategori_biaya);
		}
		if($tanggal_awal != ''){
			$this->db->where('tanggal', $tanggal_awal);
		}
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PGPengajuanBiayaT.php */
/* Location: ./application/modules/pegawai/models/PGPengajuanBiayaT.php */