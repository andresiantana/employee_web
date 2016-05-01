<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBiayaM extends CI_Model {

	public function tampilData(){
		return $this->db->get('kategori_biaya');
	}

	public function insert($data){
		return $this->db->insert('kategori_biaya', $data);
	}
	
	public function delete($id){
		return $this->db->delete('kategori_biaya', array('id_kategori_biaya'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_kategori', $nama);
        $query = $this->db->get("kategori_biaya");
        return $query;
    }

    public function dd_kategori(){
		// ambil data dari db
		$this->db->order_by('nama_kategori','asc');
		$result = $this->db->get('kategori_biaya');

		// membuat array
		$dd[''] = '--Pilih Kategori--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_kategori_biaya] = $row->nama_kategori;
			}
		}
		return $dd;
	}
}

/* End of file KategoriBiayaM.php */
/* Location: ./application/models/KategoriBiayaM.php */