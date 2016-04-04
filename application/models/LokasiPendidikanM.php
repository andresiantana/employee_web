<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiPendidikanM extends CI_Model {

	public function tampilData(){
		return $this->db->get('lokasi_pendidikan');
	}

    public function insert($data){
		return $this->db->insert('lokasi_pendidikan', $data);	
	}

	public function delete($id){
		return $this->db->delete('lokasi_pendidikan', array('id_lokasi'=>$id));	
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */