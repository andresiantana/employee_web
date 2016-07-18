<?php
$obj = &get_instance();
$obj->load->model('RoleM');
defined('BASEPATH') OR exit('No direct script access allowed');
class ADRoleM extends RoleM {

	public function tampilDataPemakai(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('role', 'role.id_role = user.id_role','Left');
		$this->db->not_like('nama_role', 'Admin');
		$query = $this->db->get();
        return $query;
	}

	public function dd_role_user()
    {
		// ambil data dari db
		$names = 'Pegawai';
		$admin = 'Admin';
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
}

/* End of file ADRoleM.php */
/* Location: ./application/modules/admin/models/ADRoleM.php */