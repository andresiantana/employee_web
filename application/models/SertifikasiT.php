<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SertifikasiT extends CI_Model {
	public function insert($data){
		return $this->db->insert('sertifikasi', $data);
	}

	public function tampilUraianSertifikasi($id_pegawai){
		$this->db->select('*');
		$this->db->from('sertifikasi');
		$this->db->join('jenis_sertifikasi', 'jenis_sertifikasi.id_jenis_sertifikasi = sertifikasi.id_jenis_sertifikasi');
		$this->db->join('pegawai', 'pegawai.id_pegawai = sertifikasi.id_pegawai','left');
		$this->db->where('sertifikasi.id_pegawai',$id_pegawai);
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PengajuanBiayaT.php */
/* Location: ./application/models/PengajuanBiayaT.php */