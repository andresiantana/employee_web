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

	public function dd_coa(){
		// ambil data dari db
		$this->db->order_by('nama_akun','asc');
		$result = $this->db->get('coa');

		// membuat array
		$dd[''] = '--Pilih Akun--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->no_akun] = $row->nama_akun;
			}
		}
		return $dd;
	}
}

/* End of file CoaM.php */
/* Location: ./application/models/CoaM.php */