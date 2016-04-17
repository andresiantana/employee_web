<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiPendidikanM extends CI_Model {

	public function tampilData($lokasi = null){
		if($lokasi != ''){
			$this->db->like('nama_lokasi', $lokasi);
        	$query = $this->db->get("lokasi_pendidikan");
		}else{
			$query = $this->db->get("lokasi_pendidikan");
		}
		return $query;
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