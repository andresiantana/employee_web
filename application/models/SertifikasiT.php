<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SertifikasiT extends CI_Model {
	public function insert($data){
		return $this->db->insert('sertifikasi', $data);
	}
}

/* End of file PengajuanBiayaT.php */
/* Location: ./application/models/PengajuanBiayaT.php */