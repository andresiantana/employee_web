<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Model {
	
	public function index(){

	}

	public function tampilData(){
		return $this->db->get('pegawai');
	}

	public function tampilDataPegawai(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$query = $this->db->get();
		return $query;
	}

	public function insert($data){
		return $this->db->insert('pegawai', $data);
	}
	
	public function delete($id){
		return $this->db->delete('pegawai', array('id_pegawai'=>$id));	
	}
}

/* End of file Pegawai.php */
/* Location: ./application/modules/pegawai/models/Pegawai.php */