<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdiM extends CI_Model {

	public function tampilData(){
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas','Left');
		$query = $this->db->get();
        return $query;
	}

	public function insert($data){
		return $this->db->insert('prodi', $data);
	}
	
	public function delete($id){
		return $this->db->delete('prodi', array('id_prodi'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_prodi', $nama);
        $query = $this->db->get("prodi");
        return $query;
    }

    public function dd_prodi(){
		// ambil data dari db
		$this->db->order_by('nama_prodi','asc');
		$result = $this->db->get('prodi');

		// membuat array
		$dd[''] = '--Pilih Prodi--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_prodi] = $row->nama_prodi;
			}
		}
		return $dd;
	}
}

/* End of file ProdiM.php */
/* Location: ./application/models/ProdiM.php */