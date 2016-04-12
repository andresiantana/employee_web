<?php
$obj = &get_instance();
$obj->load->model('Pegawai');
defined('BASEPATH') OR exit('No direct script access allowed');

class PGPegawai extends Pegawai {
	public function tampilDataPegawai(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->where('pegawai.id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PGPegawai.php */
/* Location: ./application/modules/pegawai/models/PGPegawai.php */