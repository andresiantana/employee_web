<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasM extends CI_Model {

	public function tampilData(){
		return $this->db->get('fakultas');
	}

	public function insert($data){
		return $this->db->insert('fakultas', $data);
	}
	
	public function delete($id){
		return $this->db->delete('fakultas', array('id_fakultas'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_fakultas', $nama);
        $query = $this->db->get("fakultas");
        return $query;
    }

    public function dd_fakultas(){
		// ambil data dari db
		$this->db->order_by('nama_fakultas','asc');
		$result = $this->db->get('fakultas');

		// membuat array
		$dd[''] = '--Pilih Fakultas--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_fakultas] = $row->nama_fakultas;
			}
		}
		return $dd;
	}
}

/* End of file FakultasM.php */
/* Location: ./application/models/FakultasM.php */