<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CabangBankM extends CI_Model {

	public function tampilData(){
		return $this->db->get('cabang_bank');
	}

	public function insert($data){
		return $this->db->insert('cabang_bank', $data);
	}
	
	public function delete($id){
		return $this->db->delete('cabang_bank', array('id_cabang_bank'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_cabang', $nama);
        $query = $this->db->get("cabang_bank");
        return $query;
    }

    public function dd_cabang(){
		// ambil data dari db
		$this->db->order_by('cabang_bank','asc');
		$result = $this->db->get('cabang_bank');

		// membuat array
		$dd[''] = '--Pilih Cabang Bank--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_cabang_bank] = $row->nama_cabang;
			}
		}
		return $dd;
	}
}

/* End of file CabangBankM.php */
/* Location: ./application/models/CabangBankM.php */