<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UraianPengajuanBiayaT extends CI_Model {
	public function insert($data){
		return $this->db->insert('uraian_pengajuan_biaya', $data);
	}
}

/* End of file UraianPengajuanBiayaT.php */
/* Location: ./application/models/UraianPengajuanBiayaT.php */