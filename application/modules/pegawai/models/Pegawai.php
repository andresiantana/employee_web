<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Model {
	
	public function index(){

	}

	public function tampilData(){
		return $this->db->get('pegawai');
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