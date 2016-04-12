<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleM extends CI_Model {

	public function index(){

	}

	public function tampilData(){
		return $this->db->get('role');
	}

	public function insert($data){
		return $this->db->insert('role', $data);
	}
	
	public function delete($id){
		return $this->db->delete('role', array('id_role'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_role', $nama);
        $query = $this->db->get("role");
        return $query;
    }

 	public function select_role_pegawai() {
 		$nama = "Pegawai";
		$this->db->select('id_role,nama_role');
        $this->db->like('nama_role', $nama);
        $this->db->limit(1);
        $query = $this->db->get("role");
        return $query;
    }

    public function dd_role(){
		// ambil data dari db
		$this->db->order_by('nama_role','asc');
		$result = $this->db->get('role');

		// membuat array
		$dd[''] = '--Pilih Role--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_role] = $row->nama_role;
			}
		}
		return $dd;
	}

	public function dd_role_user()
    {
		// ambil data dari db
		$names = 'Pegawai';
		$admin = 'Admin';
		$this->db->order_by('nama_role','asc');
		// $this->db->not_like('nama_role', $names);
		// $this->db->not_like('nama_role', $admin);
		$result = $this->db->get('role');

		// membuat array
		$dd[''] = '--Pilih Role--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_role] = $row->nama_role;
			}
		}
		return $dd;
	}
}

/* End of file Role.php */
/* Location: ./application/models/Role.php */