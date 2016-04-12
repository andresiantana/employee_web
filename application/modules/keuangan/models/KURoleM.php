<?php
$obj = &get_instance();
$obj->load->model('RoleM');
defined('BASEPATH') OR exit('No direct script access allowed');

class KURoleM extends RoleM {

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