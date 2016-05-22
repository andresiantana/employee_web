<?php
$obj = &get_instance();
$obj->load->model('Pegawai');
defined('BASEPATH') OR exit('No direct script access allowed');

class SDPegawai extends Pegawai {
	public function tampilDataPegawai(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PGPegawai.php */
/* Location: ./application/modules/pegawai/models/PGPegawai.php */