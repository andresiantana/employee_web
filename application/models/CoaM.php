<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoaM extends CI_Model {

	public function tampilData(){
		return $this->db->get('coa');
	}

	public function insert($data){
		return $this->db->insert('coa', $data);
	}
	
	public function delete($id){
		return $this->db->delete('coa', array('no_akun'=>$id));	
	}
}

/* End of file CoaM.php */
/* Location: ./application/models/CoaM.php */