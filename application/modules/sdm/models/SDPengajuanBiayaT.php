<?php
$obj = &get_instance();
$obj->load->model('PengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class SDPengajuanBiayaT extends PengajuanBiayaT {
	public function tampilData($nip = null , $kode_pengajuan = null, $id_kategori_biaya = null , $status_pengajuan = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		$this->db->from('pengajuan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengajuan_biaya.id_pegawai');
		if($nip != ''){
			$this->db->like('pegawai.nip', $nip);
		}
		if($kode_pengajuan != ''){
			$this->db->like('pengajuan_biaya.kode_pengajuan', $kode_pengajuan);
		}
		if($status_pengajuan != ''){
			$this->db->like('pengajuan_biaya.status_pengajuan', $status_pengajuan);
		}
		if($id_kategori_biaya != ''){
			$this->db->where('pengajuan_biaya.id_kategori_biaya', $id_kategori_biaya);
		}
		if($tanggal_awal != ''){
			$this->db->where("pengajuan_biaya.tanggal BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'");
			// $this->db->where('pengajuan_biaya.tanggal', $tanggal_awal);
		}
		$query = $this->db->get();
		return $query;
	}
}

/* End of file SDPengajuanBiayaT.php */
/* Location: ./application/modules/pegawai/models/SDPengajuanBiayaT.php */