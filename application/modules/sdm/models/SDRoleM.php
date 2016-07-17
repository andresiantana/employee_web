<?php
$obj = &get_instance();
$obj->load->model('RoleM');
defined('BASEPATH') OR exit('No direct script access allowed');
class SDRoleM extends RoleM {

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

/* End of file SDRoleM.php */
/* Location: ./application/modules/sdm/models/SDRoleM.php */